<?php

class M_jenisizin extends MY_Model {

    function __Construct() {
        parent::__construct();
    }
    
// 	function getData($table, $tgl_awal, $tgl_akhir, $tgl_bulan,$filter_type) {
//         if ($filter_type == 'bulan') {
//             $query_tgl = 'AND tgl_pembuatan LIKE "SUBSTR(' . $tgl_bulan . ',0,6)%"';
//         } else {
//             $query_tgl = 'AND tgl_pembuatan >= "' . $tgl_awal . '" AND tgl_pembuatan <="' . $tgl_akhir . '" ';
//         }
//         $result = $this->db->query("
//                     SELECT * FROM " . $table . " WHERE jenis_perizinan <> '' " . $query_tgl . "
//                 ")->result_array();

//         return $result;
//     }
    
	/*function getSiup($tgl_awal, $tgl_akhir) {

        if ($tgl_awal <> '' && $tgl_akhir <> '') {
            $query_tgl = 'AND tgl_pembuatan >= "' . $tgl_awal . '" AND tgl_pembuatan <="' . $tgl_akhir . '" ';
        } else {
            $query_tgl = '';
        }

        $query = $this->db->query('SELECT * FROM ppu_siup WHERE id_siup<>0 ' . $query_tgl . ' AND status<>1  ORDER BY tgl_pembuatan DESC');
        return $query->result_array();
    }*/
    
    public function getData($table, $page, $limit, $columns, $tgl_awal, $tgl_akhir, $tgl_bulan, $filter_type, $per_type, $per_kec)
    {
    	$param = array();
    	$param[$columns[KEY_COLUMN_ID].' <>'] = 0;
    	$param['status <>'] = 1;
    	
    	if ($filter_type == FILTER_TYPE_PERIOD)
    	{
	    	if (!is_null($tgl_awal)) $param['tgl_pembuatan >='] = $tgl_awal;
	    	if (!is_null($tgl_akhir)) $param['tgl_pembuatan <='] = $tgl_akhir;
    	}
    	else 
    	{
    		$tgl_bulan = explode('-', $tgl_bulan);
    		if (count($tgl_bulan)==2)
    		{
    			if (!is_null($tgl_bulan[0]) && $tgl_bulan[0] != '') $param["MONTH(tgl_pembuatan)"] = $tgl_bulan[0];
    			if (!is_null($tgl_bulan[1]) && $tgl_bulan[1] != '') $param["YEAR(tgl_pembuatan)"] = $tgl_bulan[1];
    		}
    		else
    		{
    			return array();
    		}
    	}
    	
    	
    	$select = $this->db->select($table.'.*, ms_kecamatan.kecamatan AS nama_kecamatan')
    		->from($table)
    		->join('ms_kecamatan', $table.'.kecamatan = ms_kecamatan.kd_kecamatan', 'left')
    		->where($param);
    	
    	if ($per_type == YES && $per_kec == NO){
    		$select = $select->order_by("{$columns[KEY_COLUMN_TYPE]} ASC, tgl_pembuatan DESC");
    	} else if ($per_type == NO && $per_kec == YES){
    		$select = $select->order_by("kecamatan ASC, tgl_pembuatan DESC");
    	} else if ($per_type == YES && $per_kec == YES){
    		$select = $select->order_by("{$columns[KEY_COLUMN_TYPE]} ASC, kecamatan ASC, tgl_pembuatan DESC");
    	} else {
    		$select = $select->order_by("tgl_pembuatan DESC");
    	}
    	
	    $select = $select->limit($limit, $this->start($page, $limit))->get();
    	
// 	    echo $this->db->last_query();
// 	    exit;
	    
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
    
    public function getAllData($table, $columns, $tgl_awal, $tgl_akhir, $tgl_bulan, $filter_type, $per_type, $per_kec)
    {
    	$param = array();
    	$param[$columns[KEY_COLUMN_ID].' <>'] = 0;
    	$param['status <>'] = 1;
    	
    	if ($filter_type == FILTER_TYPE_PERIOD)
    	{
	    	if (!is_null($tgl_awal)) $param['tgl_pembuatan >='] = $tgl_awal;
	    	if (!is_null($tgl_akhir)) $param['tgl_pembuatan <='] = $tgl_akhir;
    	}
    	else 
    	{
    		$tgl_bulan = explode('-', $tgl_bulan);
    		if (count($tgl_bulan)==2)
    		{
    			if (!is_null($tgl_bulan[0]) && $tgl_bulan[0] != '') $param["MONTH(tgl_pembuatan)"] = $tgl_bulan[0];
    			if (!is_null($tgl_bulan[1]) && $tgl_bulan[1] != '') $param["YEAR(tgl_pembuatan)"] = $tgl_bulan[1];
    		}
    		else
    		{
    			return array();
    		}
    	}
    	 
    	$select = $this->db->select($table.'.*, ms_kecamatan.kecamatan AS nama_kecamatan')
    		->from($table)
    		->join('ms_kecamatan', $table.'.kecamatan = ms_kecamatan.kd_kecamatan', 'left')
    		->where($param);
    	
    	if ($per_type == YES && $per_kec == NO){
    		$select = $select->order_by("{$columns[KEY_COLUMN_TYPE]} ASC, tgl_pembuatan DESC");
    	} else if ($per_type == NO && $per_kec == YES){
    		$select = $select->order_by("kecamatan ASC, tgl_pembuatan DESC");
    	} else if ($per_type == YES && $per_kec == YES){
    		$select = $select->order_by("{$columns[KEY_COLUMN_TYPE]} ASC, kecamatan ASC, tgl_pembuatan DESC");
    	} else {
    		$select = $select->order_by("tgl_pembuatan DESC");
    	}
    	
	    $select = $select->get();
    	 
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
    
    public function countData($table, $columns, $tgl_awal, $tgl_akhir, $tgl_bulan, $filter_type, $per_type, $per_kec)
    {
    	$param = array();
    	$param[$columns[KEY_COLUMN_ID].' <>'] = 0;
    	$param['status <>'] = 1;
    	
    	if ($filter_type == FILTER_TYPE_PERIOD)
    	{
	    	if (!is_null($tgl_awal)) $param['tgl_pembuatan >='] = $tgl_awal;
	    	if (!is_null($tgl_akhir)) $param['tgl_pembuatan <='] = $tgl_akhir;
    	}
    	else 
    	{
    		$tgl_bulan = explode('-', $tgl_bulan);
    		if (count($tgl_bulan)==2)
    		{
    			if (!is_null($tgl_bulan[0]) && $tgl_bulan[0] != '') $param["MONTH(tgl_pembuatan)"] = $tgl_bulan[0];
    			if (!is_null($tgl_bulan[1]) && $tgl_bulan[1] != '') $param["YEAR(tgl_pembuatan)"] = $tgl_bulan[1];
    		}
    		else
    		{
    			return 0;
    		}
    	}
    	 
    	return $this->db->where($param)->count_all_results($table);
    }
    
    function get_user($kd_user) {
        $query = $this->db->query('select username from user where kd_user="' . $kd_user . '"');
        return $query->row()->username;
    }

}

?>