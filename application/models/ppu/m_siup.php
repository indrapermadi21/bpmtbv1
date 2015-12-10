<?php

class M_siup extends CI_Model {

    function getListSiup($tgl1,$tgl2) {
        $tgl_awal = convert_tgl($tgl1);
        $tgl_akhir = convert_tgl($tgl2);
        if($tgl_awal<>'' && $tgl_akhir<>''){
            $query_tgl = 'AND tgl_pembuatan >= "'.$tgl_awal.'" AND tgl_pembuatan <="'.$tgl_akhir.'" ';
        } else {
            $query_tgl = '';
        }
        
        $results = $this->db->query("SELECT * FROM ppu_siup WHERE id_siup<>0 ".$query_tgl." ORDER BY tgl_pembuatan DESC ")->result_array();
        return $results;
    }

    function saved() {
        $data = array(
            'jenis_perizinan' => $this->input->post('jenis_perizinan'),
            'tgl_pembuatan' => convert_tgl($this->input->post('tgl_pembuatan')),
            'no_pelayanan' => $this->input->post('no_pelayanan'),
            'keterangan' => $this->input->post('keterangan'),
            'type_siup' => $this->input->post('type_siup'),
            'nama_perusahaan' => $this->input->post('nama_perusahaan'),
            'status_milik' => $this->input->post('status_milik'),
            'rtrw' => $this->input->post('rtrw'),
            'alamat' => $this->input->post('alamat'),
            'provinsi' => $this->input->post('provinsi'),
            'kota' => $this->input->post('kota'),
            'kecamatan' => $this->input->post('kecamatan'),
            'kelurahan' => $this->input->post('kelurahan'),
            'kodepos' => $this->input->post('kodepos'),
            'no_telp' => $this->input->post('no_telp'),
            'fax' => $this->input->post('fax'),
            'penanggung_jawab' => $this->input->post('penanggung_jawab'),
            'modal' => $this->input->post('modal'),
            'kbli' => $this->input->post('kbli'),
            'keg_up' => $this->input->post('keg_up'),
            'tgl_penetapan' => convert_tgl($this->input->post('tgl_penetapan')),
            'tgl_berlaku' => convert_tgl($this->input->post('tgl_berlaku')),
            'no_registrasi' => $this->input->post('no_registrasi'),
            'nama_pejabat' => $this->input->post('nama_pejabat'),
            'jabatan' => $this->input->post('jabatan'),
            'nip' => $this->input->post('nip'),
            'jumlah_retribusi' => str_replace(",", "", $this->input->post('jumlah_retribusi'))
        );
        
        $form_status = $this->input->post('form_status');
        $id_siup = $this->input->post('id_siup');
        
        $this->db->trans_begin();

        if($form_status=='edit'){
            $this->db->where('id_siup',$id_siup);
            $this->db->update('ppu_siup',$data);
        } else {
            $this->db->insert('ppu_siup',$data);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    
    function getSiup(){
        $id_siup = $this->input->post('id_siup');
        $results = $this->db->query("SELECT * FROM ppu_siup WHERE id_siup=".$id_siup)->result_array();
        $data = array();
        foreach($results as $r){
            $r['tgl_pembuatan'] = tgl_convert($r['tgl_pembuatan']);
            $r['tgl_penetapan'] = tgl_convert($r['tgl_penetapan']);
            $r['tgl_berlaku'] = tgl_convert($r['tgl_berlaku']);
            $data = $r;
        }
        
        return $data;
    }
    
    function deleted() {
        $id_siup = $this->input->post('id_siup');
        $this->db->trans_begin();

        $this->db->query('update ppu_siup set status="1" where id_siup=' . $id_siup);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

}
