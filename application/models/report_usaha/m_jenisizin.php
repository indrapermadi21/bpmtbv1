<?php

class M_jenisizin extends MY_Model {

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
    
	/*function getSiup($tgl_awal, $tgl_akhir) {

        if ($tgl_awal <> '' && $tgl_akhir <> '') {
            $query_tgl = 'AND tgl_pembuatan >= "' . $tgl_awal . '" AND tgl_pembuatan <="' . $tgl_akhir . '" ';
        } else {
            $query_tgl = '';
        }

        $query = $this->db->query('SELECT * FROM ppu_siup WHERE id_siup<>0 ' . $query_tgl . ' AND status<>1  ORDER BY tgl_pembuatan DESC');
        return $query->result_array();
    }*/
    
    public function getSiup($page, $limit, $tgl_awal, $tgl_akhir)
    {
    	$param = array();
    	$param['id_siup <>'] = 0;
    	$param['status <>'] = 1;
    	if (!is_null($tgl_awal)) $param['tgl_pembuatan >='] = $tgl_awal;
    	if (!is_null($tgl_akhir)) $param['tgl_pembuatan <='] = $tgl_akhir;
    	 
    	$select = $this->db->where($param)
    		->order_by('tgl_pembuatan', 'desc')
	    	->limit($limit, $this->start($page, $limit))
	    	->get('ppu_siup');
    	 
    	if ($select->num_rows() > 0)
    	{
    		$result = $select->result_array();
    		$select->free_result();
    		return $result;
    	}
    	else
    	{
    		return array();
    	}
    }
    
    public function getAllSiup($tgl_awal, $tgl_akhir)
    {
    	$param = array();
    	$param['id_siup <>'] = 0;
    	$param['status <>'] = 1;
    	if (!is_null($tgl_awal)) $param['tgl_pembuatan >='] = $tgl_awal;
    	if (!is_null($tgl_akhir)) $param['tgl_pembuatan <='] = $tgl_akhir;
    	 
    	$select = $this->db->where($param)
    		->order_by('tgl_pembuatan', 'desc')
	    	->get('ppu_siup');
    	 
    	if ($select->num_rows() > 0)
    	{
    		$result = $select->result_array();
    		$select->free_result();
    		return $result;
    	}
    	else
    	{
    		return array();
    	}
    }
    
    public function countSiup($tgl_awal, $tgl_akhir)
    {
    	$param = array();
    	$param['id_siup <>'] = 0;
    	$param['status <>'] = 2;
    	if (!is_null($tgl_awal)) $param['tgl_pembuatan >='] = $tgl_awal;
    	if (!is_null($tgl_akhir)) $param['tgl_pembuatan <='] = $tgl_akhir;
    	 
    	return $this->db->where($param)
    		->order_by('tgl_pembuatan', 'desc')
	    	->count_all_results('ppu_siup');
    }
    
    function get_user($kd_user) {
        $query = $this->db->query('select username from user where kd_user="' . $kd_user . '"');
        return $query->row()->username;
    }

}

?>