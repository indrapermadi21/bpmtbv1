<?php

class M_tdi extends CI_Model {

    function listTdi($tgl1,$tgl2) {
        $tgl_awal = convert_tgl($tgl1);
        $tgl_akhir = convert_tgl($tgl2);
        if($tgl_awal<>'' && $tgl_akhir<>''){
            $query_tgl = 'AND tgl_pembuatan >= "'.$tgl_awal.'" AND tgl_pembuatan <="'.$tgl_akhir.'" ';
        } else {
            $query_tgl = '';
        }
        
        $query = $this->db->query('SELECT * FROM ppu_tdi WHERE id_tdi<>0 ' . $query_tgl . '  ORDER BY tgl_pembuatan DESC');
        return $query->result_array();
    }

    function getTdi() {
        $id_tdi = $this->input->post('id_tdi');
        $results = $this->db->query("SELECT * FROM ppu_tdi WHERE id_tdi=" . $id_tdi)->result_array();
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
            'alamat_notelp' => $this->input->post('alamat_notelp'),
            'kota' => $this->input->post('kota'),
            'kecamatan' => $this->input->post('kecamatan'),
            'kelurahan' => $this->input->post('kelurahan'),
            'kodepos' => $this->input->post('kodepos'),
            'npwp' => $this->input->post('npwp'),
            'nipik' => $this->input->post('nipik'),
            'nama_pemilik' => $this->input->post('nama_pemilik'),
            'alamat_pemilik' => $this->input->post('alamat_pemilik'),
            'no_telp' => $this->input->post('no_telp'),
            'jenis_industri' => $this->input->post('jenis_industri'),
            'komoditi_industri' => $this->input->post('komoditi_industri'),
            'modal' => $this->input->post('modal'),
            'lokasi_prov' => $this->input->post('lokasi_prov'),
            'lokasi_kota' => $this->input->post('lokasi_kota'),
            'lokasi_kec' => $this->input->post('lokasi_kec'),
            'lokasi_kel' => $this->input->post('lokasi_kel'),
            'p_utama' => $this->input->post('p_utama'),
            'p_pembantu' => $this->input->post('p_pembantu'),
            'tenaga_penggerak' => $this->input->post('tenaga_penggerak'),
            'kap_terpasang' => $this->input->post('kap_terpasang'),
            'tkw' => $this->input->post('tkw'),
            'tkp' => $this->input->post('tkp'),
            'no_hilang' => $this->input->post('no_hilang'),
            'tgl_penetapan' => convert_tgl($this->input->post('tgl_penetapan')),
            'no_registrasi' => $this->input->post('no_registrasi'),
            'nama_pejabat' => $this->input->post('nama_pejabat'),
            'jabatan' => $this->input->post('jabatan'),
            'nip' => $this->input->post('nip'),
            'jumlah_retribusi' => str_replace(",", "", $this->input->post('jumlah_retribusi')),
            'status' => $this->input->post('status'),
        );

        $form_status = $this->input->post('form_status');
        $id_tdi = $this->input->post('id_tdi');

        $this->db->trans_begin();

            if ($form_status == 'edit') {
                $this->db->where('id_tdi', $id_tdi);
                $this->db->update('ppu_tdi', $data);
            } else {
                $this->db->insert('ppu_tdi', $data);
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
        $id_tdi = $this->input->post('id_tdi');
        $this->db->trans_begin();

        $this->db->query('update ppu_tdi set status="1" where id_tdi=' . $id_tdi);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    /*function getTdp($id_tdi) {
        $query = $this->db->query('select * from ppu_tdi where id_tdi=' . $id_tdi);
        return $query->result();
    }

    function getDataTdp($id_tdi) {
        $query = $this->db->query('select * from ppu_tdi where id_tdi=' . $id_tdi);
        return $query->row();
    }*/

}
