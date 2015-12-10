<?php

class Login extends CI_Controller {

    function __Construct() {
        parent::__Construct();
        $this->load->model('m_cek');
    }

    function index() {
        if ($this->session->userdata('is_log') == "") {
            $this->form_validation->set_rules('username', 'trim|required');
            $this->form_validation->set_rules('password', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('login/v_login');
            } else {
                $d['username'] = $this->input->post('username');
                $d['password'] = $this->input->post('password');
                $this->m_cek->cek_login($d);
                //$sess_log['is_log'] = 'imlog';
                //$sess_log['username'] = $d['username'];
                //$this->session->set_userdata($sess_log);

                redirect('dashboard', 'refresh');
            }
        } elseif ($this->session->userdata('is_log') != "") {
            redirect('dashboard', 'refresh');
        } else {
            header('location:' . base_url() . '');
        }
    }
    
    function logout(){
        $this->session->sess_destroy();
        header('location:'.  base_url().'');
    }

}

?>