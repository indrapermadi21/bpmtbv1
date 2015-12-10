<?php

class Dashboard extends CI_Controller {

    function __Construct() {
        parent::__Construct();
        $this->load->model('m_global');
    }

    function index() {
        if ($this->session->userdata('is_log') != "") {

            $d['content'] = 'dashboard/home';

            $d['auth_group'] = $this->m_global->get_group();
            $d['auth_menu'] = $this->m_global->get_menu();
            $this->load->view('template', $d);
        } else {
            header('location:' . base_url() . '');
        }
    }

}

?>