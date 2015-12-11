<?php

class Pegawai extends CI_Controller {

    function __construct() {
        parent::__construct();
        
        //Load Model
        $this->load->model('master/m_pegawai');
    }

    function index(){
        if ($this->session->userdata('is_log') != "") {
            
            //Isi Data
            $d['listPegawai'] = $this->m_pegawai->getListPegawai();
            //include content
            $d['content'] = 'master/pegawai';
            $this->load->view('template',$d);
            
        } else {
            header('location:' . base_url() . '');
        }
    }
    
    function getDataPegawai(){
        $this->datatables
                ->from('ms_pegawai');
        echo $this->datatables->generate();
    }

    /*
     * Fungsi untuk mendapatkan data pegawai saat akan melakukan edit
     */
    function getPegawai() {
       $result = $this->m_pegawai->getPegawai();
       echo json_encode(['data'=>$result]);
    }

    /*
     * Fungsi untuk save atau edit data pegawai
     */

    function saved() {
        if ($result = $this->m_pegawai->saved()) {
            echo json_encode(array('success' => $result));
        }
    }
    
    function delete(){
        if($this->m_pegawai->deleted()){
            echo json_encode(['success'=>true]);
        }
    }
    
}
