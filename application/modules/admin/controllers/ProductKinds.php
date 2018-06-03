<?php

class ProductKinds extends Admin_Controller {

    function __construct() {
        parent::__construct();

        /*if (!$this->acl->hasPermission("admin","product_kinds") ) {
            $this->session->set_flashdata('message', "对不起，您没有权限进入这个页面。");
            redirect('/admin/dashboard', 'refresh');
        }*/

        $this->load->model(array('admin/productkind'));
    }

    public function index() {
        $product_kinds = $this->productkind->get_all();

        $data['product_kinds'] = $product_kinds;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "product_kinds_list";
        $this->load->view($this->_container, $data);
    }

    public function create() {
        if ($this->input->post('name')) {
            $data['kind_name'] = $this->input->post('name');
            $this->productkind->insert($data);

            redirect('/admin/product_kinds', 'refresh');
        }

        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "product_kinds_create";
        $this->load->view($this->_container, $data);
    }

    public function edit($id) {
        if ($this->input->post('name')) {
            $data['kind_name'] = $this->input->post('name');
            $this->productkind->update($data, $id);

            redirect('/admin/product_kinds', 'refresh');
        }

        $product_kind = $this->productkind->get($id);
        if(is_null($product_kind) || !is_numeric($id))
            redirect('/admin/product_kinds', 'refresh');

        $data['product_kind'] = $product_kind;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "product_kinds_edit";
        $this->load->view($this->_container, $data);
    }

    public function delete($id) {
        if(!is_numeric($id))
            redirect('/admin/product_kinds', 'refresh');

        $this->productkind->delete($id);

        redirect('/admin/product_kinds', 'refresh');
    }

}
