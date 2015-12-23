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
    	
    	$page = intval($this->input->post('page'));
    	$limit = MAX_ROW_PER_PAGE;
    	
        $data['jenis_perizinan'] = $this->input->post('jenis_perizinan');
        $data['tgl_awal'] = convert_tgl($this->input->post('tgl_awal'));
        $data['tgl_akhir'] = convert_tgl($this->input->post('tgl_akhir'));
        $data['type']  = '';
        switch ($data['jenis_perizinan']){
            case 'siup' : 
                $data['results']  = $this->m_jenisizin->getSiup($page, $limit, $data['tgl_awal'], $data['tgl_akhir']);
                $data['row_total']  = $this->m_jenisizin->countSiup($data['tgl_awal'], $data['tgl_akhir']);
                $data['row_start']  = (($page-1)*$limit)+1;
                
                //debugy('tes');
                $html =  $this->load->view('report_usaha/v_jenisizinusaha',$data,true);
                break;
            default :
                $data['results'] = "";
                //debugy('cek');
                $html =  $this->load->view('report_usaha/v_jenisizinusaha',$data,true);
        };
        
        $result = array();
        $result['html'] = $html;
        $result['row_total'] = $data['row_total'];
        $result['row_start']  = $data['row_start'];
        
        $result['row_end']  = ($result['row_start']-1)+count($data['results']);
		$result['page_total']  = ceil($data['row_total']/$limit);
        $result['page_current']  = $page;
        
        header('Content-Type: application/json');
        
        echo json_encode($result);
    }
    
    function getReport($jenis) {
//     	if (ajax()) {
    	if (TRUE) {
    		header('Content-Type: application/json');
    	
    		$data['jenis_perizinan'] = $this->input->post('jenis_perizinan');
    		$data['tgl_awal'] = convert_tgl($this->input->post('tgl_awal'));
    		$data['tgl_akhir'] = convert_tgl($this->input->post('tgl_akhir'));
    		
    		
    	} else {
    		redirect('report_usaha/jenisIzin');
    	}
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

    function downloadPDF($jp){
    	$data['tgl_awal'] = convert_tgl($this->input->get('awal'));
    	$data['tgl_akhir'] = convert_tgl($this->input->get('akhir'));
    	$data['jenis_perizinan'] = $jp;
    	
    	$data['results']  = $this->m_jenisizin->getAllSiup($data['tgl_awal'],$data['tgl_akhir']);
    	$data['tgl_awal'] = convert_tgl($this->input->get('awal'));
    	$data['tgl_akhir'] = convert_tgl($this->input->get('akhir'));
    	$data['jenis_perizinan'] = $this->input->get('jp');
    	
    	$filename = strtoupper($jp).'_'.date('Y-m-d');
    	
    	$data['row_total'] = count($data['results']);
    	$data['filename'] = $filename;
    	
//     	$html = $this->load->view('report_usaha/v_jenisizinusaha_pdf',$data);

    	$html = $this->load->view('report_usaha/v_jenisizinusaha_pdf',$data,TRUE);
    	print_pdf($filename, $html, FALSE, 'A4', 'landscape');
    }
    
    function downloadWord($jp){
    	$data['tgl_awal'] = convert_tgl($this->input->get('awal'));
    	$data['tgl_akhir'] = convert_tgl($this->input->get('akhir'));
    	$data['jenis_perizinan'] = $jp;
    	
    	$data['results']  = $this->m_jenisizin->getAllSiup($data['tgl_awal'],$data['tgl_akhir']);
    	
    	switch ($jp){
            case 'siup' 	: $jenis_izin = 'SURAT IZIN USAHA PERDAGANGAN'; break;
            default 		: $jenis_izin = '-';
        };
        
        $this->load->library('word');
        
        $templateProcessor = new \PhpOffice\PhpWord\Template('./templates/Report_Template.docx');
        $templateProcessor->setValue('bidang', 'PERIZINAN USAHA');
        $templateProcessor->setValue('periode', convert_to_id($data['tgl_awal'], FALSE).' sampai '.convert_to_id($data['tgl_akhir'], FALSE));
        $templateProcessor->setValue('jenis_izin', $jenis_izin);
        
        $count_row = count($data['results']);
        
        $templateProcessor->setValue('jumlah_pelayanan', $count_row);
        $templateProcessor->cloneRow('no', $count_row);
        
        $index = 1;
        foreach ($data['results'] as $row){
        	$templateProcessor->setValue('no#'.$index, $index);
        	$templateProcessor->setValue('tanggal#'.$index, convert_to_id($row['tgl_pembuatan'], FALSE));
        	$templateProcessor->setValue('nomor#'.$index, $row['no_pelayanan']);
        	$templateProcessor->setValue('perusahaan#'.$index, $row['nama_perusahaan']);
        	$templateProcessor->setValue('pemohon#'.$index, $row['penanggung_jawab']);
        	$templateProcessor->setValue('alamat#'.$index, $row['alamat']);
        	$templateProcessor->setValue('kota#'.$index, $row['kota']);
        	$templateProcessor->setValue('kecamatan#'.$index, $row['kecamatan']);
        	$templateProcessor->setValue('keterangan#'.$index, 'Non Retribusi');
        	$index++;
        }
        
    	$templateProcessor->saveAs('./templates/Report_Temp.docx');
    	
    	// Saving the document as OOXML file...
    	//$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($templateProcessor, 'Word2007');
    	header('Pragma: public');     // required
    	header('Expires: 0');         // no cache
    	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    	header('Last-Modified: '.gmdate ('D, d M Y H:i:s', now()).' GMT');
    	header('Cache-Control: private',false);
    	header("Content-Type: application/vnd.ms-word");
    	header("Content-disposition: attachment; filename=" .strtoupper($data['jenis_perizinan']).'_'.date('Y-m-d') . ".docx");
    	header('Content-Transfer-Encoding: binary');
    	header('Connection: close');
    	//$objWriter->save('php://output');
    	
    	readfile('./templates/Report_Temp.docx');
    	unlink('./templates/Report_Temp.docx');
    }

}
