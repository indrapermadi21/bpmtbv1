<?php

class Kursus extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('ppnu/m_kursus');
    }

    function index() {
        if ($this->session->userdata('is_log') != "") {
            $d['tgl_awal'] = $this->session->userdata('tgl_awal');
            $d['tgl_akhir'] = $this->session->userdata('tgl_akhir');
            $d['listKursus'] = $this->m_kursus->listKursus($d['tgl_awal'], $d['tgl_akhir']);
            $d['listKecamatan'] = $this->m_global->getKecamatan();
            //$d['listKelurahan'] = $this->m_global->getKelurahan();
            $d['content'] = 'ppnu/kursus/lf_kursus';
            $this->load->view('template', $d);
        } else {
            header('location:' . base_url() . '');
        }
    }

    function getKursus() {
        $result = $this->m_kursus->getKursus();
        echo json_encode(['data' => $result, 'success' => true]);
    }

    function save() {

        if ($this->m_kursus->saved()) {
            echo json_encode(['success' => true]);
        }
    }

    function delete() {
        if ($this->m_kursus->is_deleted()) {
            echo json_encode(['success' => TRUE]);
        }
    }

}
