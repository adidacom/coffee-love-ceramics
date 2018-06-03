<?php

class Stores extends Admin_Controller {

    function __construct() {
        parent::__construct();

        /*if (!$this->acl->hasPermission("admin","stores") ) {
            $this->session->set_flashdata('message', "对不起，您没有权限进入这个页面。");
            redirect('/admin/dashboard', 'refresh');
        }*/

        $this->load->model(array('admin/store'));
    }

    public function index() {
        $stores = $this->store->get_all();

        $data['stores'] = $stores;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "stores_list";
        $this->load->view($this->_container, $data);
    }

    public function create() {
        if ($this->input->post('name')) {
            $data['store_name'] = $this->input->post('name');
            $this->store->insert($data);

            redirect('/admin/stores', 'refresh');
        }

        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "stores_create";
        $this->load->view($this->_container, $data);
    }

    public function edit($id) {
        if ($this->input->post('name')) {
            $data['store_name'] = $this->input->post('name');
            $this->store->update($data, $id);

            redirect('/admin/stores', 'refresh');
        }

        $store = $this->store->get($id);
        if(is_null($store) || !is_numeric($id))
            redirect('/admin/stores', 'refresh');

        $data['store'] = $store;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "stores_edit";
        $this->load->view($this->_container, $data);
    }

    public function delete($id) {
        if(!is_numeric($id))
            redirect('/admin/stores', 'refresh');

        $this->store->delete($id);

        redirect('/admin/stores', 'refresh');
    }

}
