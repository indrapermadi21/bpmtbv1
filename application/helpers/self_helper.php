<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

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