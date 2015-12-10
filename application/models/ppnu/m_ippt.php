<?php

class M_ippt extends CI_Model{
    
    function list_ippt(){
        $query = $this->db->get('ppnu_ippt');
        return $query->result();
    }
    
    function get_ippt($id){
        
    }
}
