<?php

class Banks extends Admin_Controller {

    function __construct() {
        parent::__construct();

        /*if (!$this->acl->hasPermission("admin","banks") ) {
            $this->session->set_flashdata('message', "对不起，您没有权限进入这个页面。");
            redirect('/admin/dashboard', 'refresh');
        }*/

        $this->load->model(array('admin/bank'));
    }

    public function index() {
        $banks = $this->bank->get_all();

        $data['banks'] = $banks;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "banks_list";
        $this->load->view($this->_container, $data);
    }

    public function create() {
        if ($this->input->post('bank_name')) {
            $data['bank_name'] = $this->input->post('bank_name');
            $data['bank_account_no'] = $this->input->post('bank_account_no');
            $data['balance'] = $this->input->post('balance');
            $data['basic_balance'] = $this->input->post('basic_balance');
            $data['bank_account_type'] = $this->input->post('bank_account_type');
            $data['reg_date'] = date("Y-m-d H:i:s");
            $this->bank->insert($data);

            redirect('/admin/banks/list', 'refresh');
        }

        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "banks_create";
        $this->load->view($this->_container, $data);
    }

    public function edit($id) {
        if ($this->input->post('bank_name')) {
            $data['bank_name'] = $this->input->post('bank_name');
            $data['bank_account_no'] = $this->input->post('bank_account_no');
            $data['balance'] = $this->input->post('balance');
            $data['basic_balance'] = $this->input->post('basic_balance');
            $data['bank_account_type'] = $this->input->post('bank_account_type');
            $this->bank->update($data, $id);

            redirect('/admin/banks/list', 'refresh');
        }

        $bank = $this->bank->get($id);
        if(is_null($bank) || !is_numeric($id))
            redirect('/admin/banks/list', 'refresh');

        $data['bank'] = $bank;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "banks_edit";
        $this->load->view($this->_container, $data);
    }

    public function delete($id) {
        if(!is_numeric($id))
            redirect('/admin/banks/list', 'refresh');

        $this->bank->delete($id);

        redirect('/admin/banks/list', 'refresh');
    }

}
