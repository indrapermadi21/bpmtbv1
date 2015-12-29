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
        case 'ppu_imb' :
            $data = array(
                '01' => 'Rumah Tinggal',
                '02' => 'KPR-BTN',
                '03' => 'Ruko',
                '04' => 'Kantor',
                '05' => 'Pasar',
                '06' => 'Rumah Kontrakan',
                '07' => 'Tower Biasa',
                '08' => 'Tower Telekomunikasi',
                '09' => 'Bengkel',
                '10' => 'Jasa',
                '11' => 'Lain-lain',
            );
            break;
        case 'ppu_iujk' :
            $data = array(
                '01' => 'Global',
                '02' => 'Khusus'
            );
            break;
        case 'ppu_siup' :
            $data = array(
                '01' => 'Kecil',
                '02' => 'Menengah',
                '03' => 'Besar',
            );
            break;
        case 'ppu_ho' :
            $data = array(
                '01' => 'Kantor',
                '02' => 'Gudang',
                '03' => 'Tempat Hiburan',
                '04' => 'Rumah Makan'
            );
            break;
        case 'ppu_ipr' :
            $data = array(
                '01' => 'Billboard',
                '02' => 'Neon Box',
                '03' => 'Papan Nama',
                '04' => 'Bando',
                '05' => 'Wall Sign',
                '06' => 'Shop Sign',
                '07' => 'Building Sign'
            );
            break;
        case 'ppu_perluasan' :
            $data = array(
                '01' => 'Izin Perluasan (Melalui Persetujuan Prinsip)',
                '02' => 'Izin Perluasan (Tanpa Melalui Persetujuan Prinsip)'
            );
            break;
        case 'ppu_stpw' :
            $data = array(
                '01' => 'Pemberi Waralaba Berasal Dari Dalam Negeri',
                '02' => 'Penerima Waralaba Lanjutan Berasal Dari Waralaba Dalam Negeri',
                '03' => 'Penerima Waralaba Lanjutan Berasal Dari Waralaba Luar Negeri'
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
