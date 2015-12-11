<?php
Class Ilok extends CI_Controller{
    
    function index(){
        if ($this->session->userdata('is_log') != "") {
            
            //$d['list_ippt'] = $this->m_ippt->list_ippt();
            
            $d['content'] = 'ppnu/izin_lokasi/lf_ilok';
            $this->load->view('template',$d);
        } else {
            header('location:' . base_url() . '');
        }
    }
    
}
