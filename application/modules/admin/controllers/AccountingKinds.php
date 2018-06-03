<?php

class AccountingKinds extends Admin_Controller {

    function __construct() {
        parent::__construct();

        /*if (!$this->acl->hasPermission("admin","accounting_kinds") ) {
            $this->session->set_flashdata('message', "对不起，您没有权限进入这个页面。");
            redirect('/admin/dashboard', 'refresh');
        }*/

        $this->load->model(array('admin/accountingkind'));
    }

    public function index() {
        $accounting_kinds = $this->accountingkind->get_all();

        $data['accounting_kinds'] = $accounting_kinds;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "accounting_kinds_list";
        $this->load->view($this->_container, $data);
    }

    public function create() {
        if ($this->input->post('name')) {
            $data['kind_name'] = $this->input->post('name');
            $this->accountingkind->insert($data);

            redirect('/admin/accounting_kinds', 'refresh');
        }

        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "accounting_kinds_create";
        $this->load->view($this->_container, $data);
    }

    public function edit($id) {
        if ($this->input->post('name')) {
            $data['kind_name'] = $this->input->post('name');
            $this->accountingkind->update($data, $id);

            redirect('/admin/accounting_kinds', 'refresh');
        }

        $accounting_kind = $this->accountingkind->get($id);
        if(is_null($accounting_kind) || !is_numeric($id))
            redirect('/admin/accounting_kinds', 'refresh');

        $data['accounting_kind'] = $accounting_kind;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "accounting_kinds_edit";
        $this->load->view($this->_container, $data);
    }

    public function delete($id) {
        if(!is_numeric($id))
            redirect('/admin/accounting_kinds', 'refresh');

        $this->accountingkind->delete($id);

        redirect('/admin/accounting_kinds', 'refresh');
    }

}
