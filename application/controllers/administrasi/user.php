<?php

class User extends CI_Controller {

    function __Construct() {
        parent::__Construct();
        $this->load->model('administrasi/m_user');
    }

    function index() {
        if ($this->session->userdata('is_log') != "") {
            $d['listUser'] = $this->m_user->listUser();
            $d['content'] = 'administrasi/user';
            $this->load->view('template', $d);
        } else {
            header('location:' . base_url() . '');
        }
    }

    function save() {

        if ($this->m_user->is_saved()) {
             echo json_encode(array('success'=>true));
        }
    }

    function getUser() {
        $result = $this->m_user->getUser();
        echo json_encode(array('success'=>true,'data'=>$result));
    }

    function delete() {
        
        if($this->m_user->delete_user()){
            echo json_encode(array('success'=>true));
        }
        
    }

}

?>