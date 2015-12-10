<?php

class Siup extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model('ppu/m_siup');
    }
    
    function index(){
        if ($this->session->userdata('is_log') != "") {
            $d['tgl_awal'] = $this->session->userdata('tgl_awal');
            $d['tgl_akhir'] = $this->session->userdata('tgl_akhir');
            
            $d['listSiup'] = $this->m_siup->getListSiup($d['tgl_awal'],$d['tgl_akhir']);
            $d['content'] = 'ppu/siup/lf_siup';
            $this->load->view('template',$d);
        } else {
            header('location:' . base_url() . '');
        }
    }
    
    function save(){
        if($this->m_siup->saved()){
            echo json_encode(['success'=>true]);
        }
    }
    
    function getSiup(){
        $result = $this->m_siup->getSiup();
        echo json_encode(['success'=>true,'data'=>$result]);
    }
    
    function delete(){
        if($this->m_siup->deleted()){
            echo json_encode(['success'=>true]);
        }
    }
}
