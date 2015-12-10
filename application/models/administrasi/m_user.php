<?php

class M_user extends CI_Model {

    function listUser() {
        $query = $this->db->get('auth_user');
        return $query->result_array();
    }

    function is_saved() {
        $data = array(
            'username' => $this->input->post('username'),
            'fullname' => $this->input->post('fullname'),
            'password' => md5($this->input->post('password')),
            'email' => $this->input->post('email'),
            'role' => $this->input->post('role')
        );

        $form_status = $this->input->post('form_status');
        $id_user = $this->input->post('id_user');

        $this->db->trans_begin();
            if ($form_status == 'edit') {
                if (!$this->input->post('password')) {
                    $this->db->query('UPDATE auth_user SET username="' . $data['username'] . '",fullname="' . $data['fullname'] . '",email="' . $data['email'] . '",role="' . $data['role'] . '"
                            WHERE id_user='.$id_user);
                } else {
                    $this->db->where('id_user', $id_user);
                    $this->db->update('auth_user', $data);
                }
            } else {
                $this->db->insert('auth_user', $data);
            }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function delete_user() {
        $id_user = $this->input->post('id_user');
        $this->db->where('id_user', $id_user);
        $this->db->delete('auth_user');
        return true;
    }

    function getUser() {
        $id_user = $this->input->post('id_user');
        $query = $this->db->query('SELECT * FROM auth_user WHERE id_user=' . $id_user);
        return $query->row();
    }

}

?>