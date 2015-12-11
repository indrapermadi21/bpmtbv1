<?php

class Retribusi extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        //Load Model
        $this->load->model('master/m_retribusi');
    }
    
    function index(){
        
        if ($this->session->userdata('is_log') != "") {
            //Isi Data
            $d['listRetribusi'] = $this->m_retribusi->getListRetribusi();
            //include content
            $d['content'] = 'master/retribusi';
            $this->load->view('template',$d);
        } else {
            header('location:' . base_url() . '');
        }
    }
    
    function getDataRetribusi(){
        $this->datatables
                ->from('ms_retribusi');
        echo $this->datatables->generate();
    }

    /*
     * Fungsi untuk mendapatkan data retribusi saat akan melakukan edit
     */
    function getRetribusi() {
       $result = $this->m_retribusi->getRetribusi();
       echo json_encode(['data'=>$result]);
    }

    /*
     * Fungsi untuk save atau edit data retribusi
     */

    function saved() {
        if ($result = $this->m_retribusi->saved()) {
            echo json_encode(array('success' => $result));
        }
    }
    
    function delete(){
        if($this->m_retribusi->deleted()){
            echo json_encode(['success'=>true]);
        }
    }
    
}