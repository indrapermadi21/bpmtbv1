<?php

class Menu extends CI_Controller {

    function __Construct() {
        parent::__Construct();
        $this->load->model('administrasi/m_menu');
    }

    function index() {
        if ($this->session->userdata('is_log') != "") {
            $d['list_menu'] = $this->m_menu->list_menu();
            $d['list_menu_group'] = $this->m_menu->list_menu_group();
            $d['content'] = 'administrasi/menu';
            $this->load->view('template', $d);
        } else {
            header('location:' . base_url() . '');
        }
    }

    function get_menu() {
        $menu_id = $this->input->post('menu_id');

        $results = $this->m_menu->get_menu($menu_id);
        foreach ($results as $r) {
            $row['data'] = array(
                'menu_id' => $r->menu_id,
                'name' => $r->name,
                'description' => $r->description,
                'url' => $r->url,
                'menu_group_id' => $r->menu_group_id
            );
        }
        echo json_encode($row);
    }

    function save() {
        $data = array(
            'name' => $this->input->post('menu_name'),
            'description' => md5($this->input->post('menu_desc')),
            'url' => $this->input->post('path'),
            'menu_group_id' => $this->input->post('menu_group_id'),
        );

        if ($this->m_menu->is_saved($data)) {
            echo json_encode(array('success' => 'berhasil'));
        }
    }

    function edit() {
        $data = array(
            'name' => $this->input->post('menu_name'),
            'description' => $this->input->post('menu_desc'),
            'url' => $this->input->post('path'),
            'menu_group_id' => $this->input->post('menu_group_id'),
        );
        $menu_id = $this->input->post('menu_id');

        if ($this->m_menu->is_edited($data, $menu_id)) {
            echo json_encode(array('success' => 'berhasil'));
        }
    }
    
    function delete(){
        $menu_id = $this->input->post('menu_id');

        $result = $this->m_menu->delete($menu_id);
    }

}

?>