<?php

class Globals extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    // Mendapatkan data dropdown kelurahan berdasarkan kode kecamatan
    // $kecamatan disini berisi kode kecamatan
    function getRefKelurahan() {
        $tmp = "";
        $kd_kecamatan = $this->input->post('kd_kecamatan');
        $data = $this->m_global->getRefKelurahan($kd_kecamatan);
        if (!empty($data)) {
            $tmp .= "<option value=''></option>";
            foreach ($data as $row) {
                $tmp .= "<option value='" . $row['kd_kelurahan'] . "'>" . $row['kelurahan'] . "</option>";
            }
        } else {
            $tmp .= "<option value=''>-- Pilih Kelurahan --</option>";
        }
        die($tmp);
    }

}
