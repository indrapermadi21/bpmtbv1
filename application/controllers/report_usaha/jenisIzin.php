<?php

class JenisIzin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('report_usaha/m_jenisizin');
    }

    function index() {
        $d['content'] = 'report_usaha/filter_report';
        $this->load->view('template',$d);
    }
    
    function getJenisIzin(){
        $data['jenis_perizinan'] = $this->input->post('jenis_perizinan');
        $data['tgl_awal'] = convert_tgl($this->input->post('tgl_awal'));
        $data['tgl_akhir'] = convert_tgl($this->input->post('tgl_akhir'));
        $data['type']  = '';
        switch ($data['jenis_perizinan']){
            case 'siup' : 
                $data['results']  = $this->m_jenisizin->getSiup($data['tgl_awal'],$data['tgl_akhir']);
                //debugy('tes');
                $html =  $this->load->view('report_usaha/v_jenisizinusaha',$data,true);
                break;
            default :
                $data['results'] = "";
                //debugy('cek');
                $html =  $this->load->view('report_usaha/v_jenisizinusaha',$data,true);
        };
        
        
        echo json_encode(['html'=> $html]);
        
    }
    
    function preview(){
        $data['tgl_awal'] = convert_tgl($this->input->get('awal'));
        $data['tgl_akhir'] = convert_tgl($this->input->get('akhir'));
        $data['jenis_perizinan'] = $this->input->get('jp');
        $ex = $this->input->get('ex');
        if($ex=='yes'){
            header("Content-Type: application/vnd.ms-word");
            header("Expires: 0");
            header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
            header("Content-disposition: attachment; filename=" .$data['jenis_perizinan'].'_'.date('Y-m-d') . ".doc");
        }
        $data['results']  = $this->m_jenisizin->getSiup($data['tgl_awal'],$data['tgl_akhir']);
        $data['type'] ='prev'; 
        $this->load->view('report_usaha/v_jenisizinusaha',$data);
    }

    

}
