<?php


class M_Global extends CI_Model{
    
    function __construct() {
        parent::__construct();
    }
    
    function get_group(){
        $query = $this->db->query('select * from auth_menu_group');
        return $query->result();
    }
    
    function get_menu(){
        $query = $this->db->query('select * from auth_menu');
        return $query->result();
    }
    
    function getJenisPerusahaan($id){
        if(!empty($id)){
            $this->db->where('id_jenis',$id);
        }
        $query = $this->db->get('ms_jenis_perusahaan');
        if(!empty($id)){
            return $query->row();
        } else {
            return $query->result();
        }
        
    }
    
    function getTypePerusahaan($id){
        if(!empty($id)){
            $this->db->where('id_tipe',$id);
        }
        $query = $this->db->get('ms_tipe_perusahaan');
        if(!empty($id)){
            return $query->row();
        } else {
            return $query->result();
        }
    }
    
    function getStatusPerusahaan($id){
        if(!empty($id)){
            $this->db->where('id_status',$id);
        }
        $query = $this->db->get('ms_status_perusahaan');
        if(!empty($id)){
            return $query->row();
        } else {
            return $query->result();
        }
    }
    
    function getKecamatan(){
        return $this->db->get('ms_kecamatan')->result_array();
    }
    
    function getKelurahan(){
        return $this->db->get('ms_kelurahan')->result_array();
    }
    
    function getRefKelurahan($kd_kecamatan){
        
        $results = $this->db->query("SELECT * FROM ms_kelurahan WHERE kd_kecamatan = '".$kd_kecamatan."'")->result_array();
        return $results;
    }
}


?>