<?php

class TileCategorys extends Admin_Controller {

    function __construct() {
        parent::__construct();

        /*if (!$this->acl->hasPermission("admin","tile_category") ) {
            $this->session->set_flashdata('message', "对不起，您没有权限进入这个页面。");
            redirect('/admin/dashboard', 'refresh');
        }*/

        $this->load->model(array('admin/tilecategory'));
    }

    public function index() {
        $categories = $this->tilecategory->get_all();

        $data['categories'] = $categories;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "tile_category_list";
        $this->load->view($this->_container, $data);
    }

    public function create() {
        if ($this->input->post('name')) {
            $data['category_name'] = $this->input->post('name');
            $this->tilecategory->insert($data);

            redirect('/admin/tile_category', 'refresh');
        }

        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "tile_category_create";
        $this->load->view($this->_container, $data);
    }

    public function edit($id) {
        if ($this->input->post('name')) {
            $data['category_name'] = $this->input->post('name');
            $this->tilecategory->update($data, $id);

            redirect('/admin/tile_category', 'refresh');
        }

        $category = $this->tilecategory->get($id);
        if(is_null($category) || !is_numeric($id))
            redirect('/admin/tile_category', 'refresh');

        $data['category'] = $category;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "tile_category_edit";
        $this->load->view($this->_container, $data);
    }

    public function delete($id) {
        if(!is_numeric($id))
            redirect('/admin/tile_category', 'refresh');

        $this->tilecategory->delete($id);

        redirect('/admin/tile_category', 'refresh');
    }

}
