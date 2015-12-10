<?php

class Retribusi extends CI_Controller{
    
    function __construct() {
        parent::__construct();
    }
    
    function index(){
        if ($this->session->userdata('is_log') != "") {
            $d['content'] = 'master/retribusi';
            $this->load->view('template',$d);
        } else {
            header('location:' . base_url() . '');
        }
    }
}