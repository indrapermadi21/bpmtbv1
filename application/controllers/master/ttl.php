<?php

class Ttl extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        //Load Model
        $this->load->model('master/m_ttl');
    }
    
   function index(){
        if ($this->session->userdata('is_log') != "") {
            
            //Isi Data
            $d['listPegawai'] = $this->m_ttl->getListPegawai();
            //include content
            $d['content'] = 'master/ttl';
            $this->load->view('template',$d);
            
        } else {
            header('location:' . base_url() . '');
        }
    }
    
    function getDataPegawai(){
        $this->datatables
                ->from('ms_ttl');
        echo $this->datatables->generate();
    }

    /*
     * Fungsi untuk mendapatkan data pegawai saat akan melakukan edit
     */
    function getPegawai() {
       $result = $this->m_ttl->getPegawai();
       echo json_encode(['data'=>$result]);
    }

    /*
     * Fungsi untuk save atau edit data pegawai
     */

    function saved() {
        if ($result = $this->m_ttl->saved()) {
            echo json_encode(array('success' => $result));
        }
    }
    
    function delete(){
        if($this->m_ttl->deleted()){
            echo json_encode(['success'=>true]);
        }
    }
    
}