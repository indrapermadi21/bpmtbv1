<?php

class Pppm extends CI_Controller
{
    function __construct() {
        parent::__construct();
    }
    
    function index()
    {
    	$d['content'] = 'pppm/v_pppm';
        $this->load->view('template',$d);
    }
}
