<?php

class Pegawai extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        if ($this->session->userdata('is_log') != "") {
            $d['content'] = 'master/pegawai';
            $this->load->view('template', $d);
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
        if ($result = $this->m_pegawai->save()) {
            echo json_encode(array('success' => $result));
        }
    }

}
