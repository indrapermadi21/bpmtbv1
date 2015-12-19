<?php

class M_ipr extends CI_Model {

    function listIpr($tgl1,$tgl2) {
        $tgl_awal = convert_tgl($tgl1);
        $tgl_akhir = convert_tgl($tgl2);
        if($tgl_awal<>'' && $tgl_akhir<>''){
            $query_tgl = 'AND tgl_pembuatan >= "'.$tgl_awal.'" AND tgl_pembuatan <="'.$tgl_akhir.'" ';
        } else {
            $query_tgl = '';
        }
        
        $query = $this->db->query('SELECT * FROM ppu_ipr WHERE id_ipr<>0 ' . $query_tgl . '  ORDER BY tgl_pembuatan DESC');
        return $query->result_array();
    }

    function getIpr() {
        $id_ipr = $this->input->post('id_ipr');
        $results = $this->db->query("SELECT * FROM ppu_ipr WHERE id_ipr=" . $id_ipr)->result_array();
        $data = array();
        foreach($results as $r){
            $r['tgl_pembuatan'] = tgl_convert($r['tgl_pembuatan']);
            $r['tgl_penetapan'] = tgl_convert($r['tgl_penetapan']);
            $r['tgl_berlaku'] = tgl_convert($r['tgl_berlaku']);
            $r['tgl_tetap_pajak'] = tgl_convert($r['tgl_tetap_pajak']);
            $r['tgl_pajak_daerah'] = tgl_convert($r['tgl_pajak_daerah']);
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
            'kualifikasi' => $this->input->post('kualifikasi'),
            'nama_perusahaan' => $this->input->post('nama_perusahaan'),
            'alamat' => $this->input->post('alamat'),
            'kota' => $this->input->post('kota'),
            'kecamatan' => $this->input->post('kecamatan'),
            'kelurahan' => $this->input->post('kelurahan'),
            'penanggung_jawab' => $this->input->post('penanggung_jawab'),
            'npwp' => $this->input->post('npwp'),
            'tgl_tetap_pajak' => convert_tgl($this->input->post('tgl_tetap_pajak')),
            'tgl_pajak_daerah' => convert_tgl($this->input->post('tgl_pajak_daerah')),
            'jenis_reklame' => $this->input->post('jenis_reklame'),
            'judul_reklame' => $this->input->post('judul_reklame'),
            'ukuran' => $this->input->post('ukuran'),
            'banyak' => $this->input->post('banyak'),
            'lokasi' => $this->input->post('lokasi'),
            'tgl_penetapan' => convert_tgl($this->input->post('tgl_penetapan')),
            'tgl_berlaku' => convert_tgl($this->input->post('tgl_berlaku')),
            'no_registrasi' => $this->input->post('no_registrasi'),
            'nama_pejabat' => $this->input->post('nama_pejabat'),
            'jabatan' => $this->input->post('jabatan'),
            'nip' => $this->input->post('nip'),
            'jumlah_retribusi' => str_replace(",", "", $this->input->post('jumlah_retribusi'))
        );
        
        $form_status = $this->input->post('form_status');
        $id_ipr = $this->input->post('id_ipr');

        $this->db->trans_begin();

            if ($form_status == 'edit') {
                $this->db->where('id_ipr', $id_ipr);
                $this->db->update('ppu_ipr', $data);
            } else {
                $this->db->insert('ppu_ipr', $data);
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
        $id_ipr = $this->input->post('id_ipr');
        $this->db->trans_begin();

        $this->db->query('update ppu_ipr set status="1" where id_ipr=' . $id_ipr);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return true;
        }
    }


}
