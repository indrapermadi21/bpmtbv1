<?php
Class M_retribusi extends CI_Model{
    
    function saved() {
        $form_status = $this->input->post('form_status');

        $data = array(
            'id_retribusi' => $this->input->post('id_retribusi'),
            'kategori' => $this->input->post('kategori'),
            'nama' => $this->input->post('nama'),
            'jumlah_retribusi' => $this->input->post('jumlah_retribusi')
        );
        $this->db->trans_begin();

        if ($form_status == 'add') {
            $this->db->insert('ms_retribusi',$data);
        } else {
            $this->db->query('UPDATE ms_retribusi SET kategori="'.$data['kategori'].'",nama="'.$data['nama'].'"
                    ,jumlah_retribusi="'.$data['jumlah_retribusi'].'"
                    WHERE id_retribusi="'.$data['id_retribusi'].'"');
        }

        $this->db->query('UPDATE ms_pegawai SET nama_pegawai="'.$data['nama_pegawai'].'",jabatan="'.$data['jabatan'].'"
                    WHERE nip="'.$data['nip'].'"');
        
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    
    function getRetribusi(){
        $id_retribusi  = $this->input->post('id_retribusi');
        return $this->db->query("SELECT * FROM ms_retribusi WHERE id_retribusi='".$id_retribusi."'")->row();
    }
    
    function getListRetribusi(){
        $results = $this->db->query("SELECT * FROM ms_retribusi")->result_array();
        return $results;
        
    }
     
    function deleted(){
        $id_retribusi = $this->input->post('id_retribusi');
        $this->db->query("UPDATE ms_retribusi SET status='1' where id_retribusi='".$id_retribusi."'");
        return true;
    }
    
}