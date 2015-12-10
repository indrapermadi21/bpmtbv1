<?php

class M_ho extends CI_Model {

    function listHo($tgl1, $tgl2) {
        $tgl_awal = convert_tgl($tgl1);
        $tgl_akhir = convert_tgl($tgl2);
        if ($tgl_awal <> '' && $tgl_akhir <> '') {
            $query_tgl = 'AND tgl_pembuatan >= "' . $tgl_awal . '" AND tgl_pembuatan <="' . $tgl_akhir . '" ';
        } else {
            $query_tgl = '';
        }

        $query = $this->db->query('SELECT * FROM ppu_ho WHERE id_ho<>0 ' . $query_tgl . '  ORDER BY tgl_pembuatan DESC');
        return $query->result_array();
    }

    function getHo() {
        $id_ho = $this->input->post('id_ho');
        $results = $this->db->query("SELECT * FROM ppu_ho WHERE id_ho=" . $id_ho)->result_array();
        $data = array();
        foreach ($results as $r) {
            $r['tgl_pembuatan'] = tgl_convert($r['tgl_pembuatan']);
            $r['tgl_penetapan'] = tgl_convert($r['tgl_penetapan']);
            $r['tgl_berlaku'] = tgl_convert($r['tgl_berlaku']);
            $r['tgl_imb'] = tgl_convert($r['tgl_imb']);
            $r['tgl_tdp'] = tgl_convert($r['tgl_tdp']);
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
            'type_ho' => $this->input->post('type_ho'),
            'nama_perusahaan' => $this->input->post('nama_perusahaan'),
            'alamat' => $this->input->post('alamat'),
            'kota' => $this->input->post('kota'),
            'kecamatan' => $this->input->post('kecamatan'),
            'kelurahan' => $this->input->post('kelurahan'),
            'bidang_usaha' => $this->input->post('bidang_usaha'),
            'nama_pemohon' => $this->input->post('nama_pemohon'),
            'no_imb' => $this->input->post('no_imb'),
            'tgl_imb' => convert_tgl($this->input->post('tgl_imb')),
            'no_tdp' => $this->input->post('no_tdp'),
            'tgl_tdp' => convert_tgl($this->input->post('tgl_tdp')),
            'dba_malam' => $this->input->post('dba_malam'),
            'dba_siang' => $this->input->post('dba_siang'),
            'dba_pagisore' => $this->input->post('dba_pagisore'),
            'dba_ruang' => $this->input->post('dba_ruang'),
            'tgl_penetapan' => convert_tgl($this->input->post('tgl_penetapan')),
            'tgl_berlaku' => convert_tgl($this->input->post('tgl_berlaku')),
            'no_registrasi' => $this->input->post('no_registrasi'),
            'nama_pejabat' => $this->input->post('nama_pejabat'),
            'jabatan' => $this->input->post('jabatan'),
            'nip' => $this->input->post('nip'),
            'jumlah_retribusi' => str_replace(",", "", $this->input->post('jumlah_retribusi'))
        );

        $form_status = $this->input->post('form_status');
        $id_ho = $this->input->post('id_ho');

        $this->db->trans_begin();

        if ($form_status == 'edit') {
            $this->db->where('id_ho', $id_ho);
            $this->db->update('ppu_ho', $data);
        } else {
            $this->db->insert('ppu_ho', $data);
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
        $id_ho = $this->input->post('id_ho');
        $this->db->trans_begin();

        $this->db->query('update ppu_ho set status="1" where id_ho=' . $id_ho);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

}
