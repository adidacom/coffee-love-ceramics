<?php

class Units extends Admin_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->acl->hasPermission("admin","units") ) {
            $this->session->set_flashdata('message', "对不起，您没有权限进入这个页面。");
            redirect('/admin/dashboard', 'refresh');
        }

        $this->load->model(array('admin/unit'));
    }

    public function index() {
        $units = $this->unit->get_all();

        $data['units'] = $units;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "units_list";
        $this->load->view($this->_container, $data);
    }

    public function create() {
        if ($this->input->post('name')) {
            $data['unit_name'] = $this->input->post('name');
            $this->unit->insert($data);

            redirect('/admin/units', 'refresh');
        }

        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "units_create";
        $this->load->view($this->_container, $data);
    }

    public function edit($id) {
        if ($this->input->post('name')) {
            $data['unit_name'] = $this->input->post('name');
            $this->unit->update($data, $id);

            redirect('/admin/units', 'refresh');
        }

        $unit = $this->unit->get($id);
        if(is_null($unit) || !is_numeric($id))
            redirect('/admin/units', 'refresh');

        $data['unit'] = $unit;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "units_edit";
        $this->load->view($this->_container, $data);
    }

    public function delete($id) {
        if(!is_numeric($id))
            redirect('/admin/units', 'refresh');

        $this->unit->delete($id);

        redirect('/admin/units', 'refresh');
    }

}
