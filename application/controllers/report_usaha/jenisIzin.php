<?php

class JenisIzin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('report_usaha/m_jenisizin');
    }

    function index() {
        $d['jenisPerizinan'] = getTabelJenisPerizinan();
        //debugy($d['jenisPerizinan']);
        $d['content'] = 'report_usaha/filter_report';
        $this->load->view('template', $d);
    }

    function getJenisIzin() {

        $data['jenis_perizinan'] = $this->input->post('jenis_perizinan');
        $data['tgl_bulan'] = convert_tgl($this->input->post('tgl_bulan'));
        $data['tgl_awal'] = convert_tgl($this->input->post('tgl_awal'));
        $data['tgl_akhir'] = convert_tgl($this->input->post('tgl_akhir'));
        $data['per_type'] = $this->input->post('per_type');
        $data['per_kec'] = $this->input->post('per_kec');
        $data['filter_type'] = $this->input->post('filter_type');
        
        $data['results'] = $this->m_jenisizin->getData($data['jenis_perizinan'], $data['tgl_awal'], $data['tgl_akhir'], $data['tgl_bulan'],$data['filter_type']);
        $data['typeIzin'] = getTypeIzin($data['jenis_perizinan']);
        $data['listKecamatan'] = $this->m_global->getKecamatan();
        //debugy($data);
        $data['type'] = '';
        if ($data['per_type'] == 'yes' && $data['per_kec'] == 'no') {
            $view = 'v_jenisizin_t';
        } elseif ($data['per_type'] == 'no' && $data['per_kec'] == 'yes') {
            $view = 'v_jenisizin_k';
        } elseif ($data['per_type'] == 'yes' && $data['per_kec'] == 'yes') {
            $view = 'v_jenisizin_tk';
        } else {
            $view = 'v_jenisizinusaha';
        }
        $html = $this->load->view('report_usaha/'.$view, $data, true);



        echo json_encode(['html' => $html]);
    }

    function preview() {
        $data['tgl_awal'] = convert_tgl($this->input->get('awal'));
        $data['tgl_akhir'] = convert_tgl($this->input->get('akhir'));
        $data['jenis_perizinan'] = $this->input->get('jp');
        $ex = $this->input->get('ex');
        if ($ex == 'yes') {
            header("Content-Type: application/vnd.ms-word");
            header("Expires: 0");
            header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
            header("Content-disposition: attachment; filename=" . $data['jenis_perizinan'] . '_' . date('Y-m-d') . ".doc");
        }
        $data['results'] = $this->m_jenisizin->getSiup($data['tgl_awal'], $data['tgl_akhir']);
        $data['type'] = 'prev';
        $this->load->view('report_usaha/v_jenisizinusaha', $data);
    }

}
