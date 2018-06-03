<?php

class Shops extends Admin_Controller {

    function __construct() {
        parent::__construct();

       /* if (!$this->acl->hasPermission("admin","shops") ) {
            $this->session->set_flashdata('message', "对不起，您没有权限进入这个页面。");
            redirect('/admin/dashboard', 'refresh');
        }*/

        $this->load->model(array('admin/shop'));
    }

    public function index() {
        $shops = $this->shop->get_all();

        $data['shops'] = $shops;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "shops_list";
        $this->load->view($this->_container, $data);
    }

    public function create() {
        if ($this->input->post('name')) {
            $data['shop_name'] = $this->input->post('name');
            $data['address'] = $this->input->post('address');
            $data['contact_person'] = $this->input->post('contact_person');
            $data['contact_phone'] = $this->input->post('contact_phone');
            $data['reg_date'] = date("Y-m-d H:i:s");
            $this->shop->insert($data);

            redirect('/admin/shops', 'refresh');
        }

        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "shops_create";
        $this->load->view($this->_container, $data);
    }

    public function edit($id) {
        if ($this->input->post('name')) {
            $data['shop_name'] = $this->input->post('name');
            $data['address'] = $this->input->post('address');
            $data['contact_person'] = $this->input->post('contact_person');
            $data['contact_phone'] = $this->input->post('contact_phone');
            $this->shop->update($data, $id);

            redirect('/admin/shops', 'refresh');
        }

        $shop = $this->shop->get($id);
        if(is_null($shop) || !is_numeric($id))
            redirect('/admin/shops', 'refresh');

        $data['shop'] = $shop;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "shops_edit";
        $this->load->view($this->_container, $data);
    }

    public function delete($id) {
        if(!is_numeric($id))
            redirect('/admin/shops', 'refresh');

        $this->shop->delete($id);

        redirect('/admin/shops', 'refresh');
    }

}
