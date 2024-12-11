<?php
class User_model extends CI_Model
{

    public function register_user($data)
    {
        return $this->db->insert('users', $data);
    }

    public function get_user_by_email($email)
    {
        return $this->db->get_where('users', ['email' => $email])->row();
    }

    public function update_verification_status($email)
    {
        $this->db->where('email', $email);
        $this->db->update('users', ['is_verified' => 1, 'verification_code' => null]); // Clear verification code after successful verification
    }


    public function login_user($email, $password)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        $user = $query->row();

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return false;
    }


    public function get_user_by_token($token)
    {
        $this->db->where('reset_token', $token);
        $this->db->where('token_created_at >=', date('Y-m-d H:i:s', strtotime('-1 hour')));
        $query = $this->db->get('users');

        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return null;
    }


    public function store_reset_token($email, $token)
    {
        $this->db->where('email', $email);
        $this->db->update('users', [
            'reset_token' => $token,
            'token_created_at' => date('Y-m-d H:i:s')
        ]);
    }


    public function update_password($user_id, $new_password)
    {
        $this->db->where('id', $user_id);
        $this->db->update('users', [
            'password' => $new_password,
            'reset_token' => null,
            'token_created_at' => null
        ]);
    }

    public function get_user($id)
    {
        return $this->db->get_where('users', ['id' => $id])->row();
    }

    public function update_user($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    public function delete_user($id)
    {
        return $this->db->delete('users', ['id' => $id]);
    }


    public function is_duplicate_username($username, $user_id)
    {
        $this->db->where('username', $username);
        $this->db->where('id !=', $user_id); // Exclude the current user's ID
        $query = $this->db->get('users');
        return $query->num_rows() > 0;
    }

    public function is_duplicate_email($email, $user_id)
    {
        $this->db->where('email', $email);
        $this->db->where('id !=', $user_id); // Exclude the current user's ID
        $query = $this->db->get('users');
        return $query->num_rows() > 0;
    }

}
?>