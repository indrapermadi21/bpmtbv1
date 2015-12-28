<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function collapse_indong($item1, $item2) {

	if (($item1 == $item2)) {
		$hasil = 'collapse in';
	} else {
		$hasil = 'collapse';
	}

	return $hasil;
}
	
if (!function_exists('ajax')) {
	function ajax() {
		$CI =& get_instance();
		return $CI->input->is_ajax_request();
	}
}

if ( ! function_exists('now'))
{
	/**
	 * Get "now" time
	 *
	 * Returns time() based on the timezone parameter or on the
	 * "time_reference" setting
	 *
	 * @param	string
	 * @return	int
	 */
	function now($timezone = NULL)
	{
		if (empty($timezone))
		{
			$timezone = config_item('time_reference');
		}

		if ($timezone === 'local' OR $timezone === date_default_timezone_get())
		{
			return time();
		}

		$datetime = new DateTime('now', new DateTimeZone($timezone));
		sscanf($datetime->format('j-n-Y G:i:s'), '%d-%d-%d %d:%d:%d', $day, $month, $year, $hour, $minute, $second);

		return mktime($hour, $minute, $second, $month, $day, $year);
	}
}

if(!function_exists('startsWith'))
{
	function startsWith($haystack, $needle)
	{
		$return = strncmp($haystack, $needle, strlen($needle));
		if($return===0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}

if(!function_exists('endsWith'))
{
	function endsWith($haystack, $needle)
	{
		$length = strlen($needle);
		if ($length == 0)
		{
			return true;
		}
		return (substr($haystack, -$length) === $needle);
	}
}

function get_month($index, $long = FALSE) {
	if ($long)
		$months = get_months_long();
	else
		$months = get_months();
	return $months[$index-1];
}

function get_months() {
	return array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
}

function print_pdf($filename, $html, $force_download, $paper_size = "A4", $orientation = "portrait")
{
	//$CI =& get_instance();
	//$CI->load->library('Pdflib');

	require_once APPPATH."/third_party/dompdf/dompdf_config.inc.php";
	ob_start();
	$dompdf = new DOMPDF();
	$dompdf->load_html($html);
	$dompdf->set_base_path(base_url() . 'inc/css/');
	$dompdf->set_paper($paper_size, $orientation);
	$dompdf->render();
	if ($force_download) {
		$dompdf->stream($filename.".pdf");
	} else {
		$dompdf->stream($filename.".pdf", array('Attachment'=>0));
	}
}

function convert_to_id($date, $readable = TRUE, $with_time = TRUE)
{
	if (!is_null($date) && !startsWith(trim($date), '0000-00-00'))
	{
		$day = substr($date, 8, 2);
		$month = substr($date, 5, 2);
		$year = substr($date, 0, 4);
		if ($readable)
		{
			//$months = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
			$months = get_months();
			$month = (int) $month - 1;
			$month = $months[$month];
			 
			if (strlen($date) > 10 && $with_time){
				$hour = substr($date, 11, 2);
				$min = substr($date, 14, 2);
				return $day . ' ' . $month . ', ' . $year . ' ' . $hour . ':' . $min;
			} else {
				return $day . ' ' . $month . ', ' . $year;
			}
		}
		else
		{
			if (strlen($date) > 10 && $with_time){
				$hour = substr($date, 11, 2);
				$min = substr($date, 14, 2);
				return $day . '-' . $month . '-' . $year . ' ' . $hour . ':' .$min;
			} else {
				return $day . '-' . $month . '-' . $year;
			}
		}
	}
	else
	{
		return '';
	}
}

if (!function_exists('collapse_indong')) {

    function collapse_indong($item1, $item2) {

        if (($item1 == $item2)) {
            $hasil = 'collapse in';
        } else {
            $hasil = 'collapse';
        }

        return $hasil;
    }

    // fungsi untuk merubah format yyyy-mm-dd
    function convert_tgl($tgl) {
        if (!empty($tgl) && $tgl <> '//') {
            $tgl_convert = substr($tgl, -4) . '-' . substr($tgl, 0, 2) . '-' . substr($tgl, 3, 2);
            return $tgl_convert;
        } else {
            $tgl_convert = NULL;
            return $tgl_convert;
        }
    }

    //fungsi untuk mengembalikan tanggal ke format mm/dd/yyyy
    function tgl_convert($tgl) {
        $tgl_convert = substr($tgl, 5, 2) . '/' . substr($tgl, -2) . '/' . substr($tgl, 0, 4);
        return $tgl_convert;
    }

    function debugy($array) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
        die();
    }

    //fungsi untuk merubah nilai contract jadi 0 jika tidak diisi >> catatan : hanya digunakan untuk report dan sementara
    function is_contract($contract) {
        if (!$contract) {
            $t_cont = '-';
        } else {
            $t_cont = $contract;
        }
        return $t_cont;
    }

    //untuk mendaptkan tgl expired contract
    function expire($date, $contract) {
        if (!$contract) {
            $date_expired = '-';
        } else {
            $plus_month = date('Y-m-d', strtotime('+' . $contract . ' month', strtotime($date)));
            $date_expired = date('Y-m-d', strtotime('-1 days', strtotime($plus_month)));
        }

        return $date_expired;
    }
    
    function roleDesc($role){
        if($role==1){
            $value = 'Administrator';
        } elseif($role==2){
            $value = 'Back Office';
        } elseif($role==3){
            $value = 'Front Office';
        } elseif($role==4){
            $value = 'Supervisor';
        } else {
            $value = '-';
        }
        return $value;
    }

}

//fungsi untuk merubah nilai contract jadi 0 jika tidak diisi >> catatan : hanya digunakan untuk report dan sementara
function is_contract($contract) {
	if (!$contract) {
		$t_cont = '-';
	} else {
		$t_cont = $contract;
	}
	return $t_cont;
}

//untuk mendaptkan tgl expired contract
function expire($date, $contract) {
	if (!$contract) {
		$date_expired = '-';
	} else {
		$plus_month = date('Y-m-d', strtotime('+' . $contract . ' month', strtotime($date)));
		$date_expired = date('Y-m-d', strtotime('-1 days', strtotime($plus_month)));
	}

	return $date_expired;
}

function roleDesc($role) {
	if ($role == 1) {
		$value = 'Administrator';
	} elseif ($role == 2) {
		$value = 'Back Office';
	} elseif ($role == 3) {
		$value = 'Front Office';
	} elseif ($role == 4) {
		$value = 'Supervisor';
	} else {
		$value = '-';
	}
	return $value;
}

//mendapatkan format tanggal dengan nama bulan ex: 01 Januari 2015
function getTglBulan($tgl) {
	$namaBulan = namaBulan();
	return substr($tgl, -2) . ' ' . $namaBulan[substr($tgl, 5, 2)] . ' ' . substr($tgl, 0, 4);
}

function getBulan($tgl){
	$namaBulan = namaBulan();
	return $namaBulan[substr($tgl, 5, 2)] . ' ' . substr($tgl, 0, 4);
}

//mendapatkan nama izin
function getNamaIzin($jenisIzin) {
	$tabel = getTabelJenisPerizinan();
	return $tabel[$jenisIzin];
}

// array untuk pengisian combo box
function getTabelJenisPerizinan() {
	$data = array(
			'ppu_siup' => 'Surat Izin Usaha Perdagangan',
			'ppu_imb' => 'Izin Mendirikan Bangungan',
			'ppu_perluasan' => 'Izin Perluasan',
			'ppu_iujk' => 'Izin Usaha Jasa Konstruksi',
			'ppu_ipr' => 'Izin Pemasangan Reklame',
			'ppu_tdi' => 'Tanda Daftar Industri',
			'ppu_iuimpp' => 'Izin Usaha Industri Melalui Persetujuan Prinsip',
			'ppu_iuitpp' => 'Izin Usaha Industri Tanpa Persetujuan Prinsip',
			'ppu_ho' => 'Izin Gangguan',
			'ppu_tdp' => 'Tanda Daftar Perusahaan',
			'ppu_stpw' => 'Surat Tanda Pendaftaran Waralaba',
			'ppu_tdg' => 'Tanda Daftar Gudang',
			'ppu_situ' => 'Surat Izin Tempat Usaha',
			'ppu_idamiu' => 'Izin Depot Air Minum',
			'ppu_tdup' => 'Tanda Daftar Usaha Pariwisata',
			'ppu_ipbu' => 'Izin Usaha Penyelenggaraan Bengkel Umum',
			'ppu_iua' => 'Izin Usaha Angkutan'
	);

	return $data;
}

// array untuk type izin usaha
function getTypeIzin($jenisIzin) {
	switch ($jenisIzin) {
		case 'ppu_tdp' :
			$data = array(
			'koperasi' => 'Koperasi',
			'po' => 'Perusahaan Perorangan (PO)',
			'cv' => 'Persekutuan Komanditer (PO)',
			'pt' => 'Perseroan Terbatas (PT)',
			'pd' => 'Perusahaan Daerah (PD)',
			);
			break;
		default :
			$data = array(
			'-' => '-'
					);
					break;
	}

	return $data;
}

function namaBulan() {
	$bulan = array(
			'01' => 'Januari',
			'02' => 'Februari',
			'03' => 'Maret',
			'04' => 'April',
			'05' => 'Mei',
			'06' => 'Juni',
			'07' => 'Juli',
			'08' => 'Agustus',
			'09' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember'
	);
	return $bulan;
}