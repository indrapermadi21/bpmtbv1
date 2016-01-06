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
        $this->load->view('template',$d);
    }
    
    function getJenisIzin(){
    	
    	$page = intval($this->input->post('page'));
    	$limit = MAX_ROW_PER_PAGE;
    	
        $data['jenis_perizinan'] = $this->input->post('jenis_perizinan');
        $data['tgl_awal'] = convert_tgl($this->input->post('tgl_awal'));
        $data['tgl_akhir'] = convert_tgl($this->input->post('tgl_akhir'));
        $data['tgl_bulan'] = $this->input->post('tgl_bulan');
        
        $data['per_type'] = $this->input->post('per_type');
        $data['per_kec'] = $this->input->post('per_kecamatan');
        $data['filter_type'] = $this->input->post('filter_type');
        
        //$data['results'] = $this->m_jenisizin->getData($data['jenis_perizinan'], $data['tgl_awal'], $data['tgl_akhir'], $data['tgl_bulan'],$data['filter_type']);
        $data['typeIzin'] = getTypeIzin($data['jenis_perizinan']);
        $data['nameIzin'] = getTabelJenisPerizinan()[$data['jenis_perizinan']];
        $data['listKecamatan'] = $this->m_global->getKecamatan();
        //debugy($data);
		
        $columns = array();
        $columns[KEY_COLUMN_ID] = getColumnNameID($data['jenis_perizinan']);
        $columns[KEY_COLUMN_TYPE] = getColumnNameType($data['jenis_perizinan']);
        
        $data['type']  = '';
        $data['results']  = $this->m_jenisizin->getData($data['jenis_perizinan'], $page, $limit, $columns, $data['tgl_awal'], $data['tgl_akhir'], $data['tgl_bulan'], $data['filter_type'], $data['per_type'], $data['per_kec']);
        $data['row_total']  = $this->m_jenisizin->countData($data['jenis_perizinan'], $columns, $data['tgl_awal'], $data['tgl_akhir'], $data['tgl_bulan'], $data['filter_type'], $data['per_type'], $data['per_kec']);
        $data['row_start']  = (($page-1)*$limit)+1;
        
        $data['results_count'] = count($data['results']);
        
        $data = mergeReportData($data, $columns);
        
        $html =  $this->load->view('report_usaha/'.$data['view'], $data, true);
        
        $result = array();
        $result['html'] = $html;
        $result['row_total'] = $data['row_total'];
        $result['row_start']  = $data['row_start'];
        
        $result['row_end']  = ($result['row_start']-1)+$data['results_count'];
		$result['page_total']  = ceil((($data['row_total'])/$limit));
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
    	$data['jenis_perizinan'] = $jp;
        $data['tgl_awal'] = convert_tgl($this->input->get('tgl_awal'));
        $data['tgl_akhir'] = convert_tgl($this->input->get('tgl_akhir'));
        $data['tgl_bulan'] = $this->input->get('tgl_bulan');
        
        $data['per_type'] = $this->input->get('per_type');
        $data['per_kec'] = $this->input->get('per_kecamatan');
        $data['filter_type'] = $this->input->get('filter_type');
        
        //$data['results'] = $this->m_jenisizin->getData($data['jenis_perizinan'], $data['tgl_awal'], $data['tgl_akhir'], $data['tgl_bulan'],$data['filter_type']);
        $data['typeIzin'] = getTypeIzin($data['jenis_perizinan']);
        $data['nameIzin'] = getTabelJenisPerizinan()[$data['jenis_perizinan']];
        $data['listKecamatan'] = $this->m_global->getKecamatan();
        //debugy($data);
		
        $columns = array();
        $columns[KEY_COLUMN_ID] = getColumnNameID($data['jenis_perizinan']);
        $columns[KEY_COLUMN_TYPE] = getColumnNameType($data['jenis_perizinan']);
        
        $data['type']  = '';
        $data['results']  = $this->m_jenisizin->getAllData($data['jenis_perizinan'], $columns, $data['tgl_awal'], $data['tgl_akhir'], $data['tgl_bulan'], $data['filter_type'], $data['per_type'], $data['per_kec']);
        $data['row_total']  = count($data['results']);
        $data['row_start']  = 1;
        
        $data = mergeReportData($data, $columns, '_pdf');
        
    	$filename = strtoupper($jp).'_'.date('Y-m-d');
    	
    	$data['filename'] = $filename;

    	$html =  $this->load->view('report_usaha/'.$data['view'], $data, true);
//     	$html = $this->load->view('report_usaha/v_jenisizinusaha_pdf',$data,TRUE);
    	print_pdf($filename, $html, FALSE, 'A4', 'landscape');
    }
    
    function downloadWord($jp){
    	$data['jenis_perizinan'] = $jp;
        $data['tgl_awal'] = convert_tgl($this->input->get('tgl_awal'));
        $data['tgl_akhir'] = convert_tgl($this->input->get('tgl_akhir'));
        $data['tgl_bulan'] = $this->input->get('tgl_bulan');
        
        $data['per_type'] = $this->input->get('per_type');
        $data['per_kec'] = $this->input->get('per_kecamatan');
        $data['filter_type'] = $this->input->get('filter_type');
        
        //$data['results'] = $this->m_jenisizin->getData($data['jenis_perizinan'], $data['tgl_awal'], $data['tgl_akhir'], $data['tgl_bulan'],$data['filter_type']);
        $data['typeIzin'] = getTypeIzin($data['jenis_perizinan']);
        $data['nameIzin'] = getTabelJenisPerizinan()[$data['jenis_perizinan']];
        $data['listKecamatan'] = $this->m_global->getKecamatan();
        //debugy($data);
		
        $columns = array();
        $columns[KEY_COLUMN_ID] = getColumnNameID($data['jenis_perizinan']);
        $columns[KEY_COLUMN_TYPE] = getColumnNameType($data['jenis_perizinan']);
        
        $data['type']  = '';
        $data['results']  = $this->m_jenisizin->getAllData($data['jenis_perizinan'], $columns, $data['tgl_awal'], $data['tgl_akhir'], $data['tgl_bulan'], $data['filter_type'], $data['per_type'], $data['per_kec']);
        $data['row_total']  = count($data['results']);
        $data['row_start']  = 1;
        
        $data = mergeReportData($data, $columns);
        
        $this->load->library('word');
        
        // prepare template
        if ($data['per_type'] == 'yes' && $data['per_kec'] == 'yes')
        	$templateProcessor = new \PhpOffice\PhpWord\Template('./templates/Report_Per_Type_Template.docx');
//         	$templateProcessor = new \PhpOffice\PhpWord\Template('./templates/Report_Per_Type_Per_Kec_Template.docx');
        else if ($data['per_type'] == 'yes' || $data['per_kec'] == 'yes')
        	$templateProcessor = new \PhpOffice\PhpWord\Template('./templates/Report_Per_Type_Template.docx');
//         	$templateProcessor = new \PhpOffice\PhpWord\Template('./templates/sample.docx');
        else 
        	$templateProcessor = new \PhpOffice\PhpWord\Template('./templates/Report_Template.docx');
        
        // fill header
        $templateProcessor->setValue('bidang', 'PERIZINAN USAHA');
        $templateProcessor->setValue('periode_title', strtoupper($data['filter_type']));
        if ($data['filter_type'] == 'bulan') {
        	$templateProcessor->setValue('periode', convert_to_id_month($data['tgl_bulan']));
        } else {
        	$templateProcessor->setValue('periode', convert_to_id($data['tgl_awal']).' s/d '.convert_to_id($data['tgl_akhir']));
        }
        $templateProcessor->setValue('jenis_izin', $data['nameIzin']);
        
        $templateProcessor->setValue('jumlah_pelayanan_all', $data['row_total']);
        
        //write report
        if ($data['per_type'] == 'yes' && $data['per_kec'] == 'yes'){
        	$templateProcessor->cloneBlock('CLONEME', count($data['results']));
        	$parent_index = 1;
        	foreach ($data['results'] as $result) {
        		//add index on cloned var
        		$templateProcessor->setValue('block_name', '${block_name#'.($parent_index).'}', 1);
        		$templateProcessor->setValue('block_title', '${block_title#'.($parent_index).'}', 1);
        		$templateProcessor->setValue('jumlah_pelayanan', '${jumlah_pelayanan#'.($parent_index).'}', 1);
        	
        		$templateProcessor->setValue('kecamatan_title', '${kecamatan_title#'.($parent_index).'}', 1);
        		$templateProcessor->setValue('no', '${no#'.($parent_index).'}', 1);
        		$templateProcessor->setValue('tanggal', '${tanggal#'.($parent_index).'}', 1);
        		$templateProcessor->setValue('nomor', '${nomor#'.($parent_index).'}', 1);
        		$templateProcessor->setValue('perusahaan', '${perusahaan#'.($parent_index).'}', 1);
        		$templateProcessor->setValue('pemohon', '${pemohon#'.($parent_index).'}', 1);
        		$templateProcessor->setValue('alamat', '${alamat#'.($parent_index).'}', 1);
        		$templateProcessor->setValue('kota', '${kota#'.($parent_index).'}', 1);
        		$templateProcessor->setValue('kecamatan', '${kecamatan#'.($parent_index).'}', 1);
        		$templateProcessor->setValue('keterangan', '${keterangan#'.($parent_index).'}', 1);
        	
        		//fill data on cloned var
        		$templateProcessor->setValue('block_title#'.$parent_index, $data['title']);
        		$templateProcessor->setValue('block_name#'.$parent_index, $result['name']);
        		$templateProcessor->setValue('jumlah_pelayanan#'.$parent_index, $result['count']);
        		
//         		$templateProcessor->cloneRow('kecamatan_title#'.$parent_index, $result['count']);
        		$templateProcessor->cloneRow('no#'.$parent_index, $result['count']+count($result['data']));
        		
        		$parent_kec_index = 1;
        		$index_row = 1;
        		foreach ($result['data'] as $child){
        			$templateProcessor->setValue('no#'.$parent_index.'#'.$index_row, $child['name']);
        			$templateProcessor->setValue('tanggal#'.$parent_index.'#'.$index_row, '');
        			$templateProcessor->setValue('nomor#'.$parent_index.'#'.$index_row, '');
        			$templateProcessor->setValue('perusahaan#'.$parent_index.'#'.$index_row, '');
        			$templateProcessor->setValue('pemohon#'.$parent_index.'#'.$index_row, '');
        			$templateProcessor->setValue('alamat#'.$parent_index.'#'.$index_row, '');
        			$templateProcessor->setValue('kota#'.$parent_index.'#'.$index_row, '');
        			$templateProcessor->setValue('kecamatan#'.$parent_index.'#'.$index_row, '');
        			$templateProcessor->setValue('keterangan#'.$parent_index.'#'.$index_row, '');
        			
	        		$index = 1;
	        		$index_row++;
	        		foreach ($child['data'] as $row) {
	        			$templateProcessor->setValue('no#'.$parent_index.'#'.$index_row, $index);
	        			$templateProcessor->setValue('tanggal#'.$parent_index.'#'.$index_row, convert_to_id($row['tgl_pembuatan'], FALSE));
	        			$templateProcessor->setValue('nomor#'.$parent_index.'#'.$index_row, $row['no_pelayanan']);
	        			$templateProcessor->setValue('perusahaan#'.$parent_index.'#'.$index_row, $row['nama_perusahaan']);
	        			$templateProcessor->setValue('pemohon#'.$parent_index.'#'.$index_row, $row['penanggung_jawab']);
	        			$templateProcessor->setValue('alamat#'.$parent_index.'#'.$index_row, $row['alamat']);
	        			$templateProcessor->setValue('kota#'.$parent_index.'#'.$index_row, $row['kota']);
	        			$templateProcessor->setValue('kecamatan#'.$parent_index.'#'.$index_row, $row['nama_kecamatan']);
	        			$templateProcessor->setValue('keterangan#'.$parent_index.'#'.$index_row, 'Non Retribusi');
	        			$index++;
	        			$index_row++;
	        		}
	        		$parent_kec_index++;
        		}
        		$parent_index++;
        	}
//         	break;
        } else if ($data['per_type'] == 'yes' || $data['per_kec'] == 'yes'){
        	$templateProcessor->cloneBlock('CLONEME', count($data['results']));
        	$parent_index = 1;
        	foreach ($data['results'] as $result) {
        		//add index on cloned var
        		$templateProcessor->setValue('block_name', '${block_name#'.($parent_index).'}', 1);
        		$templateProcessor->setValue('block_title', '${block_title#'.($parent_index).'}', 1);
        		$templateProcessor->setValue('jumlah_pelayanan', '${jumlah_pelayanan#'.($parent_index).'}', 1);
        		
        		$templateProcessor->setValue('no', '${no#'.($parent_index).'}', 1);
        		$templateProcessor->setValue('tanggal', '${tanggal#'.($parent_index).'}', 1);
        		$templateProcessor->setValue('nomor', '${nomor#'.($parent_index).'}', 1);
        		$templateProcessor->setValue('perusahaan', '${perusahaan#'.($parent_index).'}', 1);
        		$templateProcessor->setValue('pemohon', '${pemohon#'.($parent_index).'}', 1);
        		$templateProcessor->setValue('alamat', '${alamat#'.($parent_index).'}', 1);
        		$templateProcessor->setValue('kota', '${kota#'.($parent_index).'}', 1);
        		$templateProcessor->setValue('kecamatan', '${kecamatan#'.($parent_index).'}', 1);
        		$templateProcessor->setValue('keterangan', '${keterangan#'.($parent_index).'}', 1);
        		
        		//fill data on cloned var
        		$templateProcessor->setValue('block_title#'.$parent_index, $data['title']);
        		$templateProcessor->setValue('block_name#'.$parent_index, $result['name']);
        		$templateProcessor->setValue('jumlah_pelayanan#'.$parent_index, $result['count']);
        		$templateProcessor->cloneRow('no#'.$parent_index, $result['count']);
	        	$index = 1;
	        	foreach ($result['data'] as $row){
	        		$templateProcessor->setValue('no#'.$parent_index.'#'.$index, $index);
	        		$templateProcessor->setValue('tanggal#'.$parent_index.'#'.$index, convert_to_id($row['tgl_pembuatan'], FALSE));
	        		$templateProcessor->setValue('nomor#'.$parent_index.'#'.$index, $row['no_pelayanan']);
	        		$templateProcessor->setValue('perusahaan#'.$parent_index.'#'.$index, $row['nama_perusahaan']);
	        		$templateProcessor->setValue('pemohon#'.$parent_index.'#'.$index, $row['penanggung_jawab']);
	        		$templateProcessor->setValue('alamat#'.$parent_index.'#'.$index, $row['alamat']);
	        		$templateProcessor->setValue('kota#'.$parent_index.'#'.$index, $row['kota']);
	        		$templateProcessor->setValue('kecamatan#'.$parent_index.'#'.$index, $row['nama_kecamatan']);
	        		$templateProcessor->setValue('keterangan#'.$parent_index.'#'.$index, 'Non Retribusi');
	        		$index++;
	        	}
	        	$parent_index++;
        	}
        } else {
        	$templateProcessor->cloneRow('no', $data['row_total']);
        	$index = 1;
        	foreach ($data['results'] as $row){
        		$templateProcessor->setValue('no#'.$index, $index);
        		$templateProcessor->setValue('tanggal#'.$index, convert_to_id($row['tgl_pembuatan'], FALSE));
        		$templateProcessor->setValue('nomor#'.$index, $row['no_pelayanan']);
        		$templateProcessor->setValue('perusahaan#'.$index, $row['nama_perusahaan']);
        		$templateProcessor->setValue('pemohon#'.$index, $row['penanggung_jawab']);
        		$templateProcessor->setValue('alamat#'.$index, $row['alamat']);
        		$templateProcessor->setValue('kota#'.$index, $row['kota']);
        		$templateProcessor->setValue('kecamatan#'.$index, $row['nama_kecamatan']);
        		$templateProcessor->setValue('keterangan#'.$index, 'Non Retribusi');
        		$index++;
        	}
        }
        
        $file_temp = './templates/Report_Temp_'.round(microtime(true) * 1000).'.docx';
        
    	$templateProcessor->saveAs($file_temp);
    	
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
    	
    	readfile($file_temp);
    	unlink($file_temp);
    }

}
