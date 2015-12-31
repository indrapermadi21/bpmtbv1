<?php

class M_kursus extends CI_Model {

    function listKursus($tgl1, $tgl2) {
        $tgl_awal = convert_tgl($tgl1);
        $tgl_akhir = convert_tgl($tgl2);
        if ($tgl_awal <> '' && $tgl_akhir <> '') {
            $query_tgl = 'AND tgl_pembuatan >= "' . $tgl_awal . '" AND tgl_pembuatan <="' . $tgl_akhir . '" ';
        } else {
            $query_tgl = '';
        }

        $query = $this->db->query('SELECT * FROM ppnu_kursus WHERE id_kursus<>0 ' . $query_tgl . '  ORDER BY tgl_pembuatan DESC');
        return $query->result_array();
    }

    function getKursus() {
        $id_kursus = $this->input->post('id_kursus');
        $results = $this->db->query("SELECT * FROM ppnu_kursus WHERE id_kursus=" . $id_kursus)->result_array();
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
            'penanggung_jawab' => $this->input->post('penanggung_jawab'),
            'alamat_pj' => $this->input->post('alamat_pj'),
            'jenis_kursus' => $this->input->post('jenis_kursus'),
            'tgl_penetapan' => convert_tgl($this->input->post('tgl_penetapan')),
            'tgl_berlaku' => convert_tgl($this->input->post('tgl_berlaku')),
            'no_registrasi' => $this->input->post('no_registrasi'),
            'nama_pejabat' => $this->input->post('nama_pejabat'),
            'jabatan' => $this->input->post('jabatan'),
            'nip' => $this->input->post('nip'),
            'jumlah_retribusi' => str_replace(",", "", $this->input->post('jumlah_retribusi'))
        );

        $form_status = $this->input->post('form_status');
        $id_kursus = $this->input->post('id_kursus');

        $this->db->trans_begin();

        if ($form_status == 'edit') {
            $this->db->where('id_kursus', $id_kursus);
            $this->db->update('ppnu_kursus', $data);
        } else {
            $this->db->insert('ppnu_kursus', $data);
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
        $id_kursus = $this->input->post('id_kursus');
        $this->db->trans_begin();

        $this->db->query('update ppnu_kursus set status="1" where id_kursus=' . $id_kursus);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

}
