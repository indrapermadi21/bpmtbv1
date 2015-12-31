<?php

class M_salon extends CI_Model {

    function listSalon($tgl1, $tgl2) {
        $tgl_awal = convert_tgl($tgl1);
        $tgl_akhir = convert_tgl($tgl2);
        if ($tgl_awal <> '' && $tgl_akhir <> '') {
            $query_tgl = 'AND tgl_pembuatan >= "' . $tgl_awal . '" AND tgl_pembuatan <="' . $tgl_akhir . '" ';
        } else {
            $query_tgl = '';
        }

        $query = $this->db->query('SELECT * FROM ppnu_salon WHERE id_salon<>0 ' . $query_tgl . '  ORDER BY tgl_pembuatan DESC');
        return $query->result_array();
    }

    function getSalon() {
        $id_salon = $this->input->post('id_salon');
        $results = $this->db->query("SELECT * FROM ppnu_salon WHERE id_salon=" . $id_salon)->result_array();
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
            'lokasi' => $this->input->post('lokasi'),
            'penanggung_jawab' => $this->input->post('penanggung_jawab'),
            'tgl_penetapan' => convert_tgl($this->input->post('tgl_penetapan')),
            'tgl_berlaku' => convert_tgl($this->input->post('tgl_berlaku')),
            'no_registrasi' => $this->input->post('no_registrasi'),
            'nama_pejabat' => $this->input->post('nama_pejabat'),
            'jabatan' => $this->input->post('jabatan'),
            'nip' => $this->input->post('nip'),
            'jumlah_retribusi' => str_replace(",", "", $this->input->post('jumlah_retribusi'))
        );

        $form_status = $this->input->post('form_status');
        $id_salon = $this->input->post('id_salon');

        $this->db->trans_begin();

        if ($form_status == 'edit') {
            $this->db->where('id_salon', $id_salon);
            $this->db->update('ppnu_salon', $data);
        } else {
            $this->db->insert('ppnu_salon', $data);
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
        $id_salon = $this->input->post('id_salon');
        $this->db->trans_begin();

        $this->db->query('update ppnu_salon set status="1" where id_salon=' . $id_salon);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

}
