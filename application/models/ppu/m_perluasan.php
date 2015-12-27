<?php

class M_perluasan extends CI_Model {

    function listPerluasan($tgl1,$tgl2) {
        $tgl_awal = convert_tgl($tgl1);
        $tgl_akhir = convert_tgl($tgl2);
        if($tgl_awal<>'' && $tgl_akhir<>''){
            $query_tgl = 'AND tgl_pembuatan >= "'.$tgl_awal.'" AND tgl_pembuatan <="'.$tgl_akhir.'" ';
        } else {
            $query_tgl = '';
        }
        
        $query = $this->db->query('SELECT * FROM ppu_perluasan WHERE id_perluasan<>0 ' . $query_tgl . '  ORDER BY tgl_pembuatan DESC');
        return $query->result_array();
    }

    function getPerluasan() {
        $id_perluasan = $this->input->post('id_perluasan');
        $results = $this->db->query("SELECT * FROM ppu_perluasan WHERE id_perluasan=" . $id_perluasan)->result_array();
        $data = array();
        foreach($results as $r){
            $r['tgl_pembuatan'] = tgl_convert($r['tgl_pembuatan']);
            $r['tgl_penetapan'] = tgl_convert($r['tgl_penetapan']);
            $r['tgl_bap'] = tgl_convert($r['tgl_bap']);
            $r['tgl_permohonan'] = tgl_convert($r['tgl_permohonan']);
            $data = $r;
        }
        
        return $data;
    }

    function saved() {
        $data = array(
            'tgl_bap' => convert_tgl($this->input->post('tgl_bap')),
            'jenis_perizinan' => $this->input->post('jenis_perizinan'),
            'tgl_pembuatan' => convert_tgl($this->input->post('tgl_pembuatan')),
            'no_pelayanan' => $this->input->post('no_pelayanan'),
            'keterangan' => $this->input->post('keterangan'),
            'type_prinsip' => $this->input->post('type_prinsip'),
            'nama_perusahaan' => $this->input->post('nama_perusahaan'),
            'npwp' => $this->input->post('npwp'),
            'jenis_industri' => $this->input->post('jenis_industri'),
            'alamat' => $this->input->post('alamat'),
            'kota' => $this->input->post('kota'),
            'kecamatan' => $this->input->post('kecamatan'),
            'kelurahan' => $this->input->post('kelurahan'),
            'alamat_usaha' => $this->input->post('alamat_usaha'),
            'nama_pemohon' => $this->input->post('nama_pemohon'),
            'jabatan_pemohon' => $this->input->post('jabatan_pemohon'),
            'no_surat' => $this->input->post('no_surat'),
            'tgl_permohonan' => convert_tgl($this->input->post('tgl_permohonan')),
            'komoditi_industri' => $this->input->post('komoditi_industri'),
            'kapasitas' => $this->input->post('kapasitas'),
            'total_investasi' => $this->input->post('total_investasi'),
            'modal_mesin' => $this->input->post('modal_mesin'),
            'modal_kerja' => $this->input->post('modal_kerja'),
            'tki' => $this->input->post('tki'),
            'tka' => $this->input->post('tka'),
            'type_merk' => $this->input->post('type_merk'),
            'nama_merk' => $this->input->post('nama_merk'),
            'tgl_penetapan' => convert_tgl($this->input->post('tgl_penetapan')),
            'no_registrasi' => $this->input->post('no_registrasi'),
            'nama_pejabat' => $this->input->post('nama_pejabat'),
            'jabatan' => $this->input->post('jabatan'),
            'nip' => $this->input->post('nip'),
            'jumlah_retribusi' => str_replace(",", "", $this->input->post('jumlah_retribusi'))
        );
        
        $form_status = $this->input->post('form_status');
        $id_perluasan = $this->input->post('id_perluasan');

        $this->db->trans_begin();

            if ($form_status == 'edit') {
                $this->db->where('id_perluasan', $id_perluasan);
                $this->db->update('ppu_perluasan', $data);
            } else {
                $this->db->insert('ppu_perluasan', $data);
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
        $id_perluasan = $this->input->post('id_perluasan');
        $this->db->trans_begin();

        $this->db->query('update ppu_perluasan set status="1" where id_perluasan=' . $id_perluasan);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return true;
        }
    }


}
