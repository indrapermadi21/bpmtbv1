<?php

class M_menu extends CI_Model {

    function list_menu() {
        $query = $this->db->query('select 
                am.menu_id,
                ag.name as group_name,
                am.name as menu_name,
                am.description as menu_desc,
                am.url as path
                from auth_menu am inner join auth_menu_group ag on am.menu_group_id=ag.menu_group_id');
        return $query->result();
    }
    
    function list_menu_group(){
        $query = $this->db->get('auth_menu_group');
        return $query->result();
    }

    function is_saved($data) {
        $this->db->trans_begin();

        $this->db->insert('auth_menu', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function is_edited($data, $id) {
        $this->db->trans_begin();

        $this->db->where('menu_id', $id);
        $this->db->update('auth_menu', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    
    function delete($menu_id){
        $this->db->where('menu_id',$menu_id);
        $this->db->delete('auth_menu');
        return true;
    }

    function get_menu($menu_id) {
        $query = $this->db->query('select * from auth_menu where menu_id=' . $menu_id);
        return $query->result();
    }

}

?>