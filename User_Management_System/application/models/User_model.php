<?php
class User_model extends CI_Model {

    public function register_user($data) {
        return $this->db->insert('users', $data);
    }

    public function login_user($email, $password) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        $user = $query->row();

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return false;
    }

    public function get_user($id) {
        return $this->db->get_where('users', ['id' => $id])->row();
    }

    public function update_user($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    public function delete_user($id) {
        return $this->db->delete('users', ['id' => $id]);
    }


    public function is_duplicate_username($username, $user_id) {
        $this->db->where('username', $username);
        $this->db->where('id !=', $user_id); // Exclude the current user's ID
        $query = $this->db->get('users');
        return $query->num_rows() > 0;
    }

    public function is_duplicate_email($email, $user_id) {
        $this->db->where('email', $email);
        $this->db->where('id !=', $user_id); // Exclude the current user's ID
        $query = $this->db->get('users');
        return $query->num_rows() > 0;
    }

}
?>