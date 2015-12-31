<?php

class Ppp extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('ppnu/m_ppp');
    }

    function index() {
        if ($this->session->userdata('is_log') != "") {
            $d['tgl_awal'] = $this->session->userdata('tgl_awal');
            $d['tgl_akhir'] = $this->session->userdata('tgl_akhir');
            $d['listPpp'] = $this->m_ppp->listPpp($d['tgl_awal'], $d['tgl_akhir']);
            $d['listKecamatan'] = $this->m_global->getKecamatan();
            //$d['listKelurahan'] = $this->m_global->getKelurahan();
            $d['content'] = 'ppnu/ppp/lf_ppp';
            $this->load->view('template', $d);
        } else {
            header('location:' . base_url() . '');
        }
    }

    function getPpp() {
        $result = $this->m_ppp->getPpp();
        echo json_encode(['data' => $result, 'success' => true]);
    }

    function save() {

        if ($this->m_ppp->saved()) {
            echo json_encode(['success' => true]);
        }
    }

    function delete() {
        if ($this->m_ppp->is_deleted()) {
            echo json_encode(['success' => TRUE]);
        }
    }

}
