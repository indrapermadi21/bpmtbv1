<?php

class Salon extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('ppnu/m_salon');
    }

    function index() {
        if ($this->session->userdata('is_log') != "") {
            $d['tgl_awal'] = $this->session->userdata('tgl_awal');
            $d['tgl_akhir'] = $this->session->userdata('tgl_akhir');
            $d['listSalon'] = $this->m_salon->listSalon($d['tgl_awal'], $d['tgl_akhir']);
            $d['listKecamatan'] = $this->m_global->getKecamatan();
            //$d['listKelurahan'] = $this->m_global->getKelurahan();
            $d['content'] = 'ppnu/salon/lf_salon';
            $this->load->view('template', $d);
        } else {
            header('location:' . base_url() . '');
        }
    }

    function getSalon() {
        $result = $this->m_salon->getSalon();
        echo json_encode(['data' => $result, 'success' => true]);
    }

    function save() {

        if ($this->m_salon->saved()) {
            echo json_encode(['success' => true]);
        }
    }

    function delete() {
        if ($this->m_salon->is_deleted()) {
            echo json_encode(['success' => TRUE]);
        }
    }

}
