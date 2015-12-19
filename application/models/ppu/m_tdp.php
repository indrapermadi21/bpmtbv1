<?php

class M_tdp extends CI_Model {

    function listTdp($tgl1,$tgl2) {
        $tgl_awal = convert_tgl($tgl1);
        $tgl_akhir = convert_tgl($tgl2);
        if($tgl_awal<>'' && $tgl_akhir<>''){
            $query_tgl = 'AND tgl_pembuatan >= "'.$tgl_awal.'" AND tgl_pembuatan <="'.$tgl_akhir.'" ';
        } else {
            $query_tgl = '';
        }
        
        $query = $this->db->query('SELECT * FROM ppu_tdp WHERE id_tdp<>0 ' . $query_tgl . '  ORDER BY tgl_pembuatan DESC');
        return $query->result_array();
    }

    function saved() {

        $data = array(
            'jenis_perizinan' => $this->input->post('jenis_perizinan'),
            'tgl_pembuatan' => convert_tgl($this->input->post('tgl_pembuatan')),
            'no_pelayanan' => $this->input->post('no_pelayanan'),
            'keterangan' => $this->input->post('keterangan'),
            'type_perusahaan' => $this->input->post('type_perusahaan'),
            'jenis_perusahaan' => $this->input->post('jenis_perusahaan'),
            'perusahaan_ke' => $this->input->post('perusahaan_ke'),
            'nama_perusahaan' => $this->input->post('nama_perusahaan'),
            'status_perusahaan' => $this->input->post('status_perusahaan'),
            'npwp' => $this->input->post('npwp'),
            'alamat' => $this->input->post('alamat'),
            'kota' => $this->input->post('kota'),
            'kecamatan' => $this->input->post('kecamatan'),
            'kelurahan' => $this->input->post('kelurahan'),
            'no_telp' => $this->input->post('no_telp'),
            'penanggung_jawab' => $this->input->post('penanggung_jawab'),
            'keg_up' => $this->input->post('keg_up'),
            'kbli' => $this->input->post('kbli'),
            'tgl_penetapan' => convert_tgl($this->input->post('tgl_penetapan')),
            'tgl_berlaku' => convert_tgl($this->input->post('tgl_berlaku')),
            'no_registrasi' => $this->input->post('no_registrasi'),
            'nama_pejabat' => $this->input->post('nama_pejabat'),
            'jabatan' => $this->input->post('jabatan'),
            'nip' => $this->input->post('nip'),
            'jumlah_retribusi' => str_replace(",", "", $this->input->post('jumlah_retribusi'))
        );

        $form_status = $this->input->post('form_status');
        $id_tdp = $this->input->post('id_tdp');

        $this->db->trans_begin();
        if ($form_status === 'edit') {
            $this->db->where('id_tdp', $id_tdp);
            $this->db->update('ppu_tdp', $data);
        } else {
            $this->db->insert('ppu_tdp', $data);
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function is_deleted() {

        $id_tdp = $this->input->post('id_tdp');
        $this->db->trans_begin();

        $this->db->query('update ppu_tdp set status="1" where id_tdp=' . $id_tdp);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function getTdp() {

        $id_tdp = $this->input->post('id_tdp');
        $results = $this->db->query("SELECT * FROM ppu_tdp WHERE id_tdp=" . $id_tdp)->result_array();
        $data = array();
        foreach ($results as $r) {
            $r['tgl_pembuatan'] = tgl_convert($r['tgl_pembuatan']);
            $r['tgl_penetapan'] = tgl_convert($r['tgl_penetapan']);
            $r['tgl_berlaku'] = tgl_convert($r['tgl_berlaku']);
            $data = $r;
        }

        return $data;
    }

    function getDataTdp($id_tdp) {
        $query = $this->db->query('select * from ppu_tdp where id_tdp=' . $id_tdp);
        return $query->row();
    }

}
