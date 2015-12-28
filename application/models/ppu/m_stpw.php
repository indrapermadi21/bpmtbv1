<?php

class M_stpw extends CI_Model {

    function listStpw($tgl1,$tgl2) {
        $tgl_awal = convert_tgl($tgl1);
        $tgl_akhir = convert_tgl($tgl2);
        if($tgl_awal<>'' && $tgl_akhir<>''){
            $query_tgl = 'AND tgl_pembuatan >= "'.$tgl_awal.'" AND tgl_pembuatan <="'.$tgl_akhir.'" ';
        } else {
            $query_tgl = '';
        }
        
        $query = $this->db->query('SELECT * FROM ppu_stpw WHERE id_stpw<>0 ' . $query_tgl . '  ORDER BY tgl_pembuatan DESC');
        return $query->result_array();
    }

    function getStpw() {
        $id_stpw = $this->input->post('id_stpw');
        $results = $this->db->query("SELECT * FROM ppu_stpw WHERE id_stpw=" . $id_stpw)->result_array();
        $data = array();
        foreach($results as $r){
            $r['tgl_pembuatan'] = tgl_convert($r['tgl_pembuatan']);
            $r['tgl_penetapan'] = tgl_convert($r['tgl_penetapan']);
            $r['berlaku_awal'] = tgl_convert($r['berlaku_awal']);
            $r['berlaku_akhir'] = tgl_convert($r['berlaku_akhir']);
            $r['tgl_perjanjian'] = tgl_convert($r['tgl_perjanjian']);
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
            'berlaku_awal' => convert_tgl($this->input->post('berlaku_awal')),
            'berlaku_akhir' => convert_tgl($this->input->post('berlaku_akhir')),
            'type_waralaba' => $this->input->post('type_waralaba'),
            'nama_perusahaan' => $this->input->post('nama_perusahaan'),
            'alamat' => $this->input->post('alamat'),
            'kota' => $this->input->post('kota'),
            'kecamatan' => $this->input->post('kecamatan'),
            'kelurahan' => $this->input->post('kelurahan'),
            'no_telp' => $this->input->post('no_telp'),
            'email' => $this->input->post('email'),
            'penanggung_jawab' => $this->input->post('penanggung_jawab'),
            'jabatan_pj' => $this->input->post('jabatan_pj'),
            'objek_waralaba' => $this->input->post('objek_waralaba'),
            'merk' => $this->input->post('merk'),
            'negara_asal' => $this->input->post('negara_asal'),
            'pemberi_waralaba' => $this->input->post('pemberi_waralaba'),
            'alamat_pw' => $this->input->post('alamat_pw'),
            'no_telp_pw' => $this->input->post('no_telp_pw'),
            'fax' => $this->input->post('fax'),
            'email_pw' => $this->input->post('email_pw'),
            'penanggung_jawab_pw' => $this->input->post('penanggung_jawab_pw'),
            'no_perjanjian' => $this->input->post('no_perjanjian'),
            'tgl_perjanjian' => convert_tgl($this->input->post('tgl_perjanjian')),
            'pemasaran' => $this->input->post('pemasaran'),
            'tgl_penetapan' => convert_tgl($this->input->post('tgl_penetapan')),
            'no_registrasi' => $this->input->post('no_registrasi'),
            'nama_pejabat' => $this->input->post('nama_pejabat'),
            'jabatan' => $this->input->post('jabatan'),
            'nip' => $this->input->post('nip'),
            'jumlah_retribusi' => str_replace(",", "", $this->input->post('jumlah_retribusi'))
        );
        
        $form_status = $this->input->post('form_status');
        $id_stpw = $this->input->post('id_stpw');

        $this->db->trans_begin();

            if ($form_status == 'edit') {
                $this->db->where('id_stpw', $id_stpw);
                $this->db->update('ppu_stpw', $data);
            } else {
                $this->db->insert('ppu_stpw', $data);
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
        $id_stpw = $this->input->post('id_stpw');
        $this->db->trans_begin();

        $this->db->query('update ppu_stpw set status="1" where id_stpw=' . $id_stpw);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return true;
        }
    }


}
