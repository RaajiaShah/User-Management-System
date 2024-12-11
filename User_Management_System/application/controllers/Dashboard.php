<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url'); // Load URL helper
        $this->load->library('session'); // Load the session library
        $this->load->model('User_model'); // Load the model
    }

    public function index() {
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }

        $user = $this->User_model->get_user($this->session->userdata('user_id'));

       $this->load->view('auth/dashboard', ['user' => $user]);
    }

   public function edit() {
    if (!$this->session->userdata('user_id')) {
        redirect('login');
    }

    $this->load->library('form_validation');
    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

    // Get the current user ID
    $user_id = $this->session->userdata('user_id');

    if ($this->form_validation->run() === FALSE) {
        $data['user'] = $this->User_model->get_user($user_id);
        $this->load->view('auth/edit', $data);
    } else {
        $username = $this->input->post('username');
        $email = $this->input->post('email');

        // Check for duplicate username or email
        if ($this->User_model->is_duplicate_username($username, $user_id)) {
            $this->session->set_flashdata('error', 'The username is already taken.');
            $data['user'] = $this->User_model->get_user($user_id);
            $this->load->view('auth/edit', $data);
            return;
        }

        if ($this->User_model->is_duplicate_email($email, $user_id)) {
            $this->session->set_flashdata('error', 'The email address is already registered with another account.');
            $data['user'] = $this->User_model->get_user($user_id);
            $this->load->view('auth/edit', $data);
            return;
        }

        // If no duplicates, update user
        $data = [
            'username' => $username,
            'email' => $email
        ];
        $this->User_model->update_user($user_id, $data);
        redirect('dashboard');
    }
}

    public function delete() {
        if ($this->session->userdata('user_id')) {
            $this->User_model->delete_user($this->session->userdata('user_id'));
            $this->session->unset_userdata('user_id');
            redirect('register');
        }
    }
}
?>
