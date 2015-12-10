<?php

class Ppnu extends CI_Controller
{
    function __construct() {
        parent::__construct();
    }
    
    function index()
    {
        $d['content'] = 'ppnu/v_ppnu';
        $this->load->view('template',$d);
    }
    
    function report_ippt() {
        $this->load->view('ppnu/report/ippt');
    }
}
