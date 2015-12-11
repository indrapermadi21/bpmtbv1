<?php

class Ippt extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model('ppnu/m_ippt');
    }
    
    function index(){
        if ($this->session->userdata('is_log') != "") {
            
            $d['list_ippt'] = $this->m_ippt->list_ippt();
            
            $d['content'] = 'ppnu/ippt/lf_ippt';
            $this->load->view('template',$d);
        } else {
            header('location:' . base_url() . '');
        }
    }
    
    function export_doc(){
        $id_ippt = $this->uri->segment(4);
        
        $results = $this->m_ippt->get_ippt($id_ippt);
        
        header("Content-Type: application/vnd.ms-word");
        header("Expires: 0");
        header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
        header("Content-disposition: attachment; filename=export.doc");
        $this->load->view('ppnu/report/ippt');
    }
    
}
