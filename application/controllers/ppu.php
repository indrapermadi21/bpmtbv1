<?php

class Ppu extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $d['content'] = 'ppu/v_ppu';
        $this->load->view('template',$d);
    }

    

}
