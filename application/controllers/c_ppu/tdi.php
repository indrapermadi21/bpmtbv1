<?php

class Tdi extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('ppu/m_tdi');
    }

    function index() {
        if ($this->session->userdata('is_log') != "") {
            //$d['type_perusahaan'] = $this->m_global->getTypePerusahaan("");
            //$d['jenis_perusahaan'] = $this->m_global->getJenisPerusahaan("");
            //$d['getStatus'] = $this->m_global->getStatusPerusahaan("");
            $d['listKecamatan'] = $this->m_global->getKecamatan();
            //$d['listKelurahan'] = $this->m_global->getKelurahan();
            
            $d['tgl_awal'] = $this->session->userdata('tgl_awal');
            $d['tgl_akhir'] = $this->session->userdata('tgl_akhir');
            
            $d['listTdi'] = $this->m_tdi->listTdi($d['tgl_awal'],$d['tgl_akhir']);
            $d['content'] = 'ppu/tdi/lf_tdi';
            $this->load->view('template', $d);
        } else {
            header('location:' . base_url() . '');
        }
    }

    function getTdi() {
        $result = $this->m_tdi->getTdi();
        echo json_encode(array('data'=>$result,'success'=>true));
    }

    function save() {
        
        if ($result = $this->m_tdi->saved()) {
            echo json_encode(array_merge(array('success' => true,'data' => $result)));
        }
    }

    /*function export_doc() {
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
            header("Content-disposition: attachment; filename=tdp_".date('Y-m-d').".doc");
        }

        $this->load->view('ppu/tdp/report_tdp', $d);
    }*/
    
    function delete(){
        
        if($this->m_tdi->is_deleted()){
            echo json_encode(['success'=>TRUE]);
        }
        
    }

}
