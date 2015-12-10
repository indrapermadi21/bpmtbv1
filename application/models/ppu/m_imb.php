<?php

class M_imb extends CI_Model {

    function listImb($tgl1,$tgl2) {
        $tgl_awal = convert_tgl($tgl1);
        $tgl_akhir = convert_tgl($tgl2);
        if($tgl_awal<>'' && $tgl_akhir<>''){
            $query_tgl = 'AND tgl_pembuatan >= "'.$tgl_awal.'" AND tgl_pembuatan <="'.$tgl_akhir.'" ';
        } else {
            $query_tgl = '';
        }
        
        $query = $this->db->query('SELECT * FROM ppu_imb WHERE id_imb<>0 ' . $query_tgl . '  ORDER BY tgl_pembuatan DESC');
        return $query->result_array();
    }

    function getImb() {
        $id_imb = $this->input->post('id_imb');
        $results = $this->db->query("SELECT * FROM ppu_imb WHERE id_imb=" . $id_imb)->result_array();
        $data = array();
        foreach($results as $r){
            $r['tgl_pembuatan'] = tgl_convert($r['tgl_pembuatan']);
            $r['tgl_penetapan'] = tgl_convert($r['tgl_penetapan']);
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
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'kota' => $this->input->post('kota'),
            'kecamatan' => $this->input->post('kecamatan'),
            'kelurahan' => $this->input->post('kelurahan'),
            'fungsi_bangunan' => $this->input->post('fungsi_bangunan'),
            'penanggung_jawab' => $this->input->post('penanggung_jawab'),
            'alamat_bangunan' => $this->input->post('alamat_bangunan'),
            'lokasi_kota' => convert_tgl($this->input->post('lokasi_kota')),
            'lokasi_kec' => $this->input->post('lokasi_kec'),
            'lokasi_kel' => $this->input->post('lokasi_kel'),
            'sempadan' => $this->input->post('sempadan'),
            'as_jalan' => $this->input->post('as_jalan'),
            'sempadan_pagar' => $this->input->post('sempadan_pagar'),
            'as_jalan_pagar' => $this->input->post('as_jalan_pagar'),
            'luas_a' => $this->input->post('luas_a'),
            'luas_b' => $this->input->post('luas_b'),
            'luas_c' => $this->input->post('luas_c'),
            'luas_d' => $this->input->post('luas_d'),
            'sarana_a' => $this->input->post('sarana_a'),
            'sarana_b' => $this->input->post('sarana_b'),
            'sarana_c' => $this->input->post('sarana_c'),
            'sarana_d' => $this->input->post('sarana_d'),
            'tgl_penetapan' => convert_tgl($this->input->post('tgl_penetapan')),
            'no_registrasi' => $this->input->post('no_registrasi'),
            'nama_pejabat' => $this->input->post('nama_pejabat'),
            'jabatan' => $this->input->post('jabatan'),
            'nip' => $this->input->post('nip'),
            'jumlah_retribusi' => str_replace(",", "", $this->input->post('jumlah_retribusi'))
        );

        $form_status = $this->input->post('form_status');
        $id_imb = $this->input->post('id_imb');

        $this->db->trans_begin();

            if ($form_status == 'edit') {
                $this->db->where('id_imb', $id_imb);
                $this->db->update('ppu_imb', $data);
            } else {
                $this->db->insert('ppu_imb', $data);
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
        $id_imb = $this->input->post('id_imb');
        $this->db->trans_begin();

        $this->db->query('update ppu_imb set status="1" where id_imb=' . $id_imb);

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
