<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url'); // Load URL helper
        $this->load->library('session'); // Load the session library
        $this->load->model('User_model'); // Load the model
        $this->load->library('form_validation');
    }

    public function register()
    {
        // Custom validation for username starting with an alphabet
        $this->form_validation->set_rules(
            'username',
            'Username',
            'required|is_unique[users.username]|callback_username_starts_with_alpha',
            ['username_starts_with_alpha' => 'The %s must start with an alphabet.']
        );

        // Custom validation for email minimum length before '@'
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|valid_email|is_unique[users.email]|callback_email_min_length_validation',
            ['email_min_length_validation' => 'The %s must have at least 5 characters before the "@" symbol.']
        );

        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('auth/register');
        } else {
            $verification_code = random_int(100000, 999999); // Generate a random 6-digit verification code

            $data = [
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'verification_code' => $verification_code,
                'is_verified' => 0 // Mark as not verified
            ];

            $this->User_model->register_user($data); // Save user to the database

            $this->_send_verification_email($data['email'], $verification_code); // Send verification email

            $this->session->set_flashdata('success', 'Registration successful! Please verify your email before logging in.');
            redirect('auth/verify_email'); // Redirect to email verification page
        }

    }

    // Helper function to send verification email
    private function _send_verification_email($email, $verification_code)
    {
        // Load the email configuration from config/email.php
        $this->config->load('email', TRUE);
        $config = $this->config->item('email');

        // Debug: Check if the configuration is loaded correctly
        if (!$config || !is_array($config)) {
            log_message('error', 'Email configuration is missing or invalid.');
            show_error('Email configuration is missing or invalid.');
            return false;
        }

        // Initialize the email library with the updated configuration
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

        // Set email parameters
        $this->email->from('raajiashah801@gmail.com', 'Verification Email'); 
        $this->email->to($email); 
        $this->email->subject('Email Verification');
        $this->email->message("Your verification code is: $verification_code");

        // Attempt to send the email and handle errors
        if (!$this->email->send()) {
            log_message('error', 'Failed to send email: ' . $this->email->print_debugger());
            echo $this->email->print_debugger(); 
            return false;
        }

        // Email sent successfully
        return true;
    }

    public function verify_email()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('verification_code', 'Verification Code', 'required|numeric');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('auth/verify_email');
        } else {
            $email = $this->input->post('email');
            $code = $this->input->post('verification_code');

            $user = $this->User_model->get_user_by_email($email);

            if ($user && $user->verification_code == $code) {
                $this->User_model->update_verification_status($email); // Update user's verification status
                $this->session->set_flashdata('success', 'Email successfully verified! You can now log in.');
                redirect('auth/login');
            } else {
                $this->session->set_flashdata('error', 'Invalid verification code or email.');
                redirect('auth/verify_email');
            }
        }
    }

    public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            // Form validation failed; reload the login view
            $this->load->view('auth/login');
            return;
        }

        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->User_model->get_user_by_email($email);

        if ($user) {
            if ((int) $user->is_verified === 1) {
                if (password_verify($password, $user->password)) {
                    // Store user ID in session and redirect to dashboard
                    $this->session->set_userdata('user_id', $user->id);
                    redirect('dashboard');
                } else {
                    // Incorrect password
                    $this->session->set_flashdata('error', 'Invalid password.');
                    redirect('auth/login');
                }
            } else {
                // Email not verified
                $this->session->set_flashdata(
                    'error',
                    'Your email is not verified. <a href="' . site_url('auth/resend_verification') . '?email=' . urlencode($email) . '">Resend Verification Email</a>'
                );
                redirect('auth/login');
            }
        } else {
            // Email not found
            $this->session->set_flashdata('error', 'No account found with this email.');
            redirect('auth/login');
        }
    }

    public function resend_verification()
    {
        $email = $this->input->get('email'); // Get email from query string
        $user = $this->User_model->get_user_by_email($email);

        if ($user && (int) $user->is_verified === 0) {
            // Generate a new verification code
            $verification_code = random_int(100000, 999999);

            // Update the verification code in the database
            $this->db->where('email', $email);
            $this->db->update('users', ['verification_code' => $verification_code]);

            // Resend the verification email
            if ($this->_send_verification_email($email, $verification_code)) {
                $this->session->set_flashdata('success', 'A new verification code has been sent to your email.');
            } else {
                $this->session->set_flashdata('error', 'Failed to send the verification email. Please try again.');
            }

            redirect('auth/verify_email'); // Redirect to the verification page
        } else {
            // Account is already verified or invalid email
            $this->session->set_flashdata('error', 'Invalid email or the account is already verified.');
            redirect('auth/login'); // Redirect back to login
        }
    }

    public function forgot_password()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('auth/forgot_password');
        } else {
            $email = $this->input->post('email');
            $user = $this->User_model->get_user_by_email($email);

            if ($user) {
                // Generate a secure token
                $token = bin2hex(random_bytes(32));
                $this->User_model->store_reset_token($email, $token);

                // Send reset link
                $reset_link = base_url("auth/reset_password/$token");
                if ($this->_send_reset_email($email, $reset_link)) {
                    $this->session->set_flashdata('message', 'A reset link has been sent to your email.');
                } else {
                    $this->session->set_flashdata('message', 'Failed to send reset email. Please try again.');
                }
            } else {
                $this->session->set_flashdata('message', 'Email not found.');
            }

            redirect('auth/forgot_password');
        }
    }

    private function _send_reset_email($email, $reset_link)
    {
        $this->config->load('email', TRUE);
        $config = $this->config->item('email');

        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('raajiashah801@gmail.com', 'Reset Password');
        $this->email->to($email);
        $this->email->subject('Password Reset');
        $this->email->message("Click the following link to reset your password: $reset_link");

        return $this->email->send();
    }


    public function reset_password($token = null)
{
    if (!$token) {
        $this->session->set_flashdata('error', 'Missing token. Please try resetting your password again.');
        redirect('auth/forgot_password');
        return;
    }

    $user = $this->User_model->get_user_by_token($token);

    if ($user) {
        // Pass the email to the view
        $this->load->view('auth/reset_password', ['user' => $user, 'email' => $user->email]);
    } else {
        $this->session->set_flashdata('error', 'Invalid or expired token.');
        redirect('auth/forgot_password');
    }
}



    public function update_password()
    {
        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');
    
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', 'Password validation failed.');
            redirect('auth/forgot_password');
        } else {
            $token = $this->input->post('token');
            $user = $this->User_model->get_user_by_token($token);
    
            if ($user) {
                $new_password = password_hash($this->input->post('new_password'), PASSWORD_BCRYPT);
                $this->User_model->update_password($user->id, $new_password);
                $this->session->set_flashdata('message', 'Password successfully updated.');
                redirect('auth/login');
            } else {
                $this->session->set_flashdata('error', 'Invalid or expired token.');
                redirect('auth/forgot_password');
            }
        }
    }


    // Custom callback function to validate that the username starts with an alphabet
    public function username_starts_with_alpha($str)
    {
        return preg_match('/^[a-zA-Z]/', $str) ? TRUE : FALSE;
    }

    // Custom callback function to validate minimum email length before the '@' symbol
    public function email_min_length_validation($str)
    {
        $emailParts = explode('@', $str);
        if (count($emailParts) > 1) {
            $localPartLength = strlen($emailParts[0]);
            if ($localPartLength >= 5) {
                return TRUE;
            }
        }
        return FALSE;
    }

    public function logout()
    {
        $this->session->unset_userdata('user_id');
        redirect('login');
    }
}

?>
