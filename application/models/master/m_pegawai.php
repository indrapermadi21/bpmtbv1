<?php

class M_pegawai extends CI_Model {

    function save() {
        $form_status = $this->input->post('form_status');

        $data = array(
            'nip' => $this->input->post('nip'),
            'nama_pegawai' => $this->input->post('nama_pegawai'),
            'jabatan' => $this->input->post('jabatan')
        );

        $this->db->trans_begin();

        if ($form_status == 'add') {
            $this->db->insert('ms_pegawai',$data);
        } else {
            $this->db->query('UPDATE ms_pegawai SET nama_pegawai="'.$data['nama_pegawai'].'",jabatan="'.$data['jabatan'].'"
                    WHERE nip="'.$data['nip'].'"');
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    
    function getPegawai(){
        $nip  = $this->input->post('nip');
        return $this->db->query("SELECT * FROM ms_pegawai WHERE nip='".$nip."'")->result_array();
        
    }

}
