<?php

class Tdp extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('ppu/m_tdp');
    }
    
    function index() {
        if ($this->session->userdata('is_log') != "") {
            $d['jenis_perizinan'] = 'Tanda Daftar Perusahaan';

            $d['tgl_awal'] = $this->session->userdata('tgl_awal');
            $d['tgl_akhir'] = $this->session->userdata('tgl_akhir');
            //echo 'tes'.$d['tgl_awal'];
            //$d['type_perusahaan'] = $this->m_global->getTypePerusahaan("");
            $d['type_perusahaan'] = getTypeIzin('ppu_tdp');
            $d['jenis_perusahaan'] = $this->m_global->getJenisPerusahaan("");
            $d['getStatus'] = $this->m_global->getStatusPerusahaan("");
            
            $d['listKecamatan'] = $this->m_global->getKecamatan();
            //$d['listKelurahan'] = $this->m_global->getKelurahan();
            $d['listTdp'] = $this->m_tdp->listTdp($d['tgl_awal'], $d['tgl_akhir']);
            $d['content'] = 'ppu/tdp/lf_tdp';
            $this->load->view('template', $d);
        } else {
            header('location:' . base_url() . '');
        }
    }

    function getTdp() {

        $results = $this->m_tdp->getTdp();
        echo json_encode(['success'=>true,'data' => $results]);
    }

    function save() {

        if ($this->m_tdp->saved()) {
            echo json_encode(['success' => true]);
        }
    }

    function export_doc() {
        $id_tdp = $this->uri->segment(4);
        $type = $this->uri->segment(5);
        $d['results'] = $this->m_tdp->getDataTdp($id_tdp);

        if ($d['results']->perusahaan_ke == '0') {
            $d['pendaftaran'] = 'BARU';
            $d['pembaruan'] = '0';
        } else {
            $d['pendaftaran'] = '-';
            $d['pembaruan'] = $d['results']->perusahaan_ke;
        }

        $d['status'] = $this->m_global->getStatusPerusahaan($d['results']->status_perusahaan);
        $d['type'] = $this->m_global->getTypePerusahaan($d['results']->type_perusahaan);
        //$status_perusahaan = $this->m_global->getJenis();

        if ($type == "doc") {
            header("Content-Type: application/vnd.ms-word");
            header("Expires: 0");
            header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
            header("Content-disposition: attachment; filename=tdp_" . date('Y-m-d') . ".doc");
        }

        $this->load->view('ppu/tdp/report_tdp', $d);
    }

    function delete() {
        if ($this->m_tdp->is_deleted()) {
            echo json_encode(['success' => TRUE]);
        }
    }

    function setSession() {
        $sess_log['tgl_awal'] = $this->input->post('tgl_awal');
        $sess_log['tgl_akhir'] = $this->input->post('tgl_akhir');
        $this->session->set_userdata($sess_log);
        
    }
    
    function unsetSession(){
        $sess_log['tgl_awal'] = '';
        $sess_log['tgl_akhir'] = '';
        $this->session->unset_userdata($sess_log);
    }

}
