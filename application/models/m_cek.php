<?php

class M_Cek extends CI_Model
{
    function __Construct()
    {
        parent::__construct();
    }
    
    function cek_login($data)
    {
        $login['username'] = $data['username'];
        $login['password'] = md5($data['password']);
        
        $cek = $this->db->get_where('auth_user',$login);
        if($cek->num_rows()>0)
        {
            foreach($cek->result() as $row)
            {
                $sess_log['is_log'] = 'imlog';
                $sess_log['username'] = $row->username;
                $sess_log['role'] = $row->role;
                $this->session->set_userdata($sess_log);
            }//end foreach
            header('location:'.base_url());
        }
        else
        {
            $this->session->set_flashdata('result_login',"Sorry username password combination wrong");
            header('location:'.base_url());
        }
    }
    
    function get_user($kd_user)
    {
        $query = $this->db->query('select username from user where kd_user="'.$kd_user.'"');
        return $query->row()->username;
    }
}

?>