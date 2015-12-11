<?php

class M_siup extends CI_Model{
    
    function getListSiup(){
        $results = $this->db->query("Select *  From ppu_siup")->result_array();
        return $results;
    }
    
    function saved(){
        $data = array(
            'jenis_perizinan' => $this->input->post('jenis_perizinan'),
            'tgl_pembuatan' => convert_tgl($this->input->post('tgl_pembuatan')),
            'no_pelayanan' => $this->input->post('no_pelayanan'),
            'keterangan' => $this->input->post('keterangan'),
            'type_siup' => $this->input->post('type_siup'),
           );
          
          $form_status = $this->input->post('form_status');
          $id_siup = $this->input->post('id_siup');
          
          if($form_status == 'edit'){
              $this->db->where('id_siup',$id_siup);
              $this->db->update('ppu_siup',$data);
          }else{
              $this->db->insert('ppu_siup',$data);
          }
          return true;
          
         
    }
    function getSiup(){
        $id_siup = $this ->input->post('id_siup');
        $results = $this->db->query("Select * from ppu_siup where id_siup=".$id_siup)->result_array();
        $data = array();
        foreach($results as $r){
            $r['tgl_pembuatan'] = tgl_convert($r['tgl_pembuatan']);
            $r['tgl_penetapan'] = tgl_convert($r['tgl_penetapan']);
            $r['tgl_berlaku'] = tgl_convert($r['tgl_berlaku']);
            $data = $r;
           }
           return $data;
    }
    
    function deleted(){
        $id_siup = $this->input->post('id_siup');
        $this->db->query('update ppu_siup  set status="1" where id_siup='.$id_siup);
        return true;
    }
}
