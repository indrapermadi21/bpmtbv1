<?php

class M_tdg extends CI_Model {

    function listTdg($tgl1,$tgl2) {
        $tgl_awal = convert_tgl($tgl1);
        $tgl_akhir = convert_tgl($tgl2);
        if($tgl_awal<>'' && $tgl_akhir<>''){
            $query_tgl = 'AND tgl_pembuatan >= "'.$tgl_awal.'" AND tgl_pembuatan <="'.$tgl_akhir.'" ';
        } else {
            $query_tgl = '';
        }
        
        $query = $this->db->query('SELECT * FROM ppu_tdg WHERE id_tdg<>0 ' . $query_tgl . '  ORDER BY tgl_pembuatan DESC');
        return $query->result_array();
    }

    function getTdg() {
        $id_tdg = $this->input->post('id_tdg');
        $results = $this->db->query("SELECT * FROM ppu_tdg WHERE id_tdg=" . $id_tdg)->result_array();
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
            'nama_perusahaan' => $this->input->post('nama_perusahaan'),
            'alamat_perusahaan' => $this->input->post('alamat_perusahaan'),
            'kota' => $this->input->post('kota'),
            'kecamatan' => $this->input->post('kecamatan'),
            'kelurahan' => $this->input->post('kelurahan'),
            'nama_pemilik' => $this->input->post('nama_pemilik'),
            'alamat_pemilik' => $this->input->post('alamat_pemilik'),
            'no_siup' => $this->input->post('no_siup'),
            'tgl_siup' => convert_tgl($this->input->post('tgl_siup')),
            'no_tdp' => $this->input->post('no_tdp'),
            'tgl_tdp' => convert_tgl($this->input->post('tgl_tdp')),
            'tmpt_keluar' => $this->input->post('tmpt_keluar'),
            'siui' => $this->input->post('siui'),
            'lokasi_prov' => $this->input->post('lokasi_prov'),
            'lokasi_kota' => $this->input->post('lokasi_kota'),
            'lokasi_kec' => $this->input->post('lokasi_kec'),
            'lokasi_kel' => $this->input->post('lokasi_kel'),
            'luas_gudang' => $this->input->post('luas_gudang'),
            'tgl_penetapan' => convert_tgl($this->input->post('tgl_penetapan')),
            'tgl_berlaku' => convert_tgl($this->input->post('tgl_berlaku')),
            'no_registrasi' => $this->input->post('no_registrasi'),
            'nama_pejabat' => $this->input->post('nama_pejabat'),
            'jabatan' => $this->input->post('jabatan'),
            'nip' => $this->input->post('nip'),
            'jumlah_retribusi' => str_replace(",", "", $this->input->post('jumlah_retribusi'))
        );

        $form_status = $this->input->post('form_status');
        $id_tdg = $this->input->post('id_tdg');

        $this->db->trans_begin();

            if ($form_status == 'edit') {
                $this->db->where('id_tdg', $id_tdg);
                $this->db->update('ppu_tdg', $data);
            } else {
                $this->db->insert('ppu_tdg', $data);
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
        $id_tdg = $this->input->post('id_tdg');
        $this->db->trans_begin();

        $this->db->query('update ppu_tdg set status="1" where id_tdg=' . $id_tdg);

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
