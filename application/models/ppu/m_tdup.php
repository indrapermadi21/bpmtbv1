<?php

class M_tdup extends CI_Model {

    function listTdup($tgl1, $tgl2) {
        $tgl_awal = convert_tgl($tgl1);
        $tgl_akhir = convert_tgl($tgl2);
        if ($tgl_awal <> '' && $tgl_akhir <> '') {
            $query_tgl = 'AND tgl_pembuatan >= "' . $tgl_awal . '" AND tgl_pembuatan <="' . $tgl_akhir . '" ';
        } else {
            $query_tgl = '';
        }

        $query = $this->db->query('SELECT * FROM ppu_tdup WHERE id_tdup<>0 ' . $query_tgl . '  ORDER BY tgl_pembuatan DESC');
        return $query->result_array();
    }

    function getTdup() {
        $id_tdup = $this->input->post('id_tdup');
        $results = $this->db->query("SELECT * FROM ppu_tdup WHERE id_tdup=" . $id_tdup)->result_array();
        $data = array();
        foreach ($results as $r) {
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
            'nama_perusahaan' => $this->input->post('nama_perusahaan'),
            'alamat' => $this->input->post('alamat'),
            'kota' => $this->input->post('kota'),
            'kecamatan' => $this->input->post('kecamatan'),
            'kelurahan' => $this->input->post('kelurahan'),
            'no_telp' => $this->input->post('no_telp'),
            'fax' => $this->input->post('fax'),
            'nama_pemilik' => $this->input->post('nama_pemilik'),
            'penanggung_jawab' => $this->input->post('penanggung_jawab'),
            'npwp' => $this->input->post('npwp'),
            'bidang_usaha' => $this->input->post('bidang_usaha'),
            'klasifikasi' => $this->input->post('klasifikasi'),
            'tgl_penetapan' => convert_tgl($this->input->post('tgl_penetapan')),
            'tgl_berlaku' => convert_tgl($this->input->post('tgl_berlaku')),
            'no_registrasi' => $this->input->post('no_registrasi'),
            'nama_pejabat' => $this->input->post('nama_pejabat'),
            'jabatan' => $this->input->post('jabatan'),
            'nip' => $this->input->post('nip'),
            'jumlah_retribusi' => str_replace(",", "", $this->input->post('jumlah_retribusi'))
        );

        $form_status = $this->input->post('form_status');
        $id_tdup = $this->input->post('id_tdup');

        $this->db->trans_begin();

        if ($form_status == 'edit') {
            $this->db->where('id_tdup', $id_tdup);
            $this->db->update('ppu_tdup', $data);
        } else {
            $this->db->insert('ppu_tdup', $data);
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
        $id_tdup = $this->input->post('id_tdup');
        $this->db->trans_begin();

        $this->db->query('update ppu_tdup set status="1" where id_tdup=' . $id_tdup);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

}
