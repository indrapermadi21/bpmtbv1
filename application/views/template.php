<?php 
    $this->load->view('head');    
    $this->load->view('header');
    $this->load->view('side_userpanel');
    if($this->session->userdata('role')==1){
        $this->load->view('side_menu');
    } else {
        $this->load->view('side_menu2');
    }
    $this->load->view('content_head');
    $this->load->view($content);
    $this->load->view('footer');
?>    