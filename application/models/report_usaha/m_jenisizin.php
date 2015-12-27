<?php

class M_jenisizin extends CI_Model {

    function __Construct() {
        parent::__construct();
    }

    function getData($table, $tgl_awal, $tgl_akhir, $tgl_bulan,$filter_type) {
        if ($filter_type == 'bulan') {
            $query_tgl = 'AND tgl_pembuatan LIKE "SUBSTR(' . $tgl_bulan . ',0,6)%"';
        } else {
            $query_tgl = 'AND tgl_pembuatan >= "' . $tgl_awal . '" AND tgl_pembuatan <="' . $tgl_akhir . '" ';
        }
        $result = $this->db->query("
                    SELECT * FROM " . $table . " WHERE jenis_perizinan <> '' " . $query_tgl . "
                ")->result_array();

        return $result;
    }

    function getSiup($tgl_awal, $tgl_akhir) {

        if ($tgl_awal <> '' && $tgl_akhir <> '') {
            $query_tgl = 'AND tgl_pembuatan >= "' . $tgl_awal . '" AND tgl_pembuatan <="' . $tgl_akhir . '" ';
        } else {
            $query_tgl = '';
        }

        $query = $this->db->query('SELECT * FROM ppu_siup WHERE id_siup<>0 ' . $query_tgl . ' AND status<>1  ORDER BY tgl_pembuatan DESC');
        return $query->result_array();
    }

    function get_user($kd_user) {
        $query = $this->db->query('select username from user where kd_user="' . $kd_user . '"');
        return $query->row()->username;
    }

}

?>