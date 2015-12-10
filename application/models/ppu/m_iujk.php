<?php

class M_iujk extends CI_Model {

    function listIujk($tgl1,$tgl2) {
        $tgl_awal = convert_tgl($tgl1);
        $tgl_akhir = convert_tgl($tgl2);
        if($tgl_awal<>'' && $tgl_akhir<>''){
            $query_tgl = 'AND tgl_pembuatan >= "'.$tgl_awal.'" AND tgl_pembuatan <="'.$tgl_akhir.'" ';
        } else {
            $query_tgl = '';
        }
        
        $query = $this->db->query('SELECT * FROM ppu_iujk WHERE id_iujk<>0 ' . $query_tgl . '  ORDER BY tgl_pembuatan DESC');
        return $query->result_array();
    }

    function getIujk() {
        $id_iujk = $this->input->post('id_iujk');
        $results = $this->db->query("SELECT * FROM ppu_iujk WHERE id_iujk=" . $id_iujk)->result_array();
        $data = array();
        foreach($results as $r){
            $r['tgl_pembuatan'] = tgl_convert($r['tgl_pembuatan']);
            $r['tgl_penetapan'] = tgl_convert($r['tgl_penetapan']);
            $r['tgl_berlaku'] = tgl_convert($r['tgl_berlaku']);
            $data = $r;
        }
        
        return $data;
    }

    function saved() {
        $data = array(
            'jenis_perizinan' => $this->input->post('jenis_perizinan'),
            'tgl_pembuatan' => convert_tgl($this->input->post('tgl_pembuatan')),
            'no_pelayanan' => $this->input->post('no_pelayanan'),
            'keterangan' => $this->input->post('keterangan'),
            'type_iujk' => $this->input->post('type_iujk'),
            'nama_perusahaan' => $this->input->post('nama_perusahaan'),
            'alamat_perusahaan' => $this->input->post('alamat_perusahaan'),
            'rtrw' => $this->input->post('rtrw'),
            'provinsi' => $this->input->post('provinsi'),
            'kota' => $this->input->post('kota'),
            'kecamatan' => $this->input->post('kecamatan'),
            'kelurahan' => $this->input->post('kelurahan'),
            'kodepos' => $this->input->post('kodepos'),
            'no_telp' => $this->input->post('no_telp'),
            'fax' => $this->input->post('fax'),
            'penanggung_jawab' => $this->input->post('penanggung_jawab'),
            'npwp' => $this->input->post('npwp'),
            'bidang1' => $this->input->post('bidang1'),
            'bidang2' => $this->input->post('bidang2'),
            'bidang3' => $this->input->post('bidang3'),
            'tgl_penetapan' => convert_tgl($this->input->post('tgl_penetapan')),
            'tgl_berlaku' => convert_tgl($this->input->post('tgl_berlaku')),
            'no_registrasi' => $this->input->post('no_registrasi'),
            'nama_pejabat' => $this->input->post('nama_pejabat'),
            'jabatan' => $this->input->post('jabatan'),
            'nip' => $this->input->post('nip'),
            'jumlah_retribusi' => str_replace(",", "", $this->input->post('jumlah_retribusi'))
        );

        $form_status = $this->input->post('form_status');
        $id_iujk = $this->input->post('id_iujk');

        $this->db->trans_begin();

            if ($form_status == 'edit') {
                $this->db->where('id_iujk', $id_iujk);
                $this->db->update('ppu_iujk', $data);
            } else {
                $this->db->insert('ppu_iujk', $data);
            }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return $data['no_pelayanan'];
        }
    }

    function is_deleted() {
        $id_iujk = $this->input->post('id_iujk');
        $this->db->trans_begin();

        $this->db->query('update ppu_iujk set status="1" where id_iujk=' . $id_iujk);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    /*function getTdp($id_tdp) {
        $query = $this->db->query('select * from ppu_tdp where id_tdp=' . $id_tdp);
        return $query->result();
    }

    function getDataTdp($id_tdp) {
        $query = $this->db->query('select * from ppu_tdp where id_tdp=' . $id_tdp);
        return $query->row();
    }*/

}
