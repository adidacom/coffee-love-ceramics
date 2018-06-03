<?php

class Colors extends Admin_Controller {

    function __construct() {
        parent::__construct();

        /*if (!$this->acl->hasPermission("admin","colors") ) {
            $this->session->set_flashdata('message', "对不起，您没有权限进入这个页面。");
            redirect('/admin/dashboard', 'refresh');
        }*/

        $this->load->model(array('admin/color'));
    }

    public function index() {
        $colors = $this->color->get_all();

        $data['colors'] = $colors;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "colors_list";
        $this->load->view($this->_container, $data);
    }

    public function create() {
        if ($this->input->post('name')) {
            $data['name'] = $this->input->post('name');
            $this->color->insert($data);

            redirect('/admin/colors', 'refresh');
        }

        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "colors_create";
        $this->load->view($this->_container, $data);
    }

    public function edit($id) {
        if ($this->input->post('name')) {
            $data['name'] = $this->input->post('name');
            $this->color->update($data, $id);

            redirect('/admin/colors', 'refresh');
        }

        $color = $this->color->get($id);
        if(is_null($color) || !is_numeric($id))
            redirect('/admin/colors', 'refresh');

        $data['color'] = $color;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "colors_edit";
        $this->load->view($this->_container, $data);
    }

    public function delete($id) {
        if(!is_numeric($id))
            redirect('/admin/colors', 'refresh');

        $this->color->delete($id);

        redirect('/admin/colors', 'refresh');
    }

}
