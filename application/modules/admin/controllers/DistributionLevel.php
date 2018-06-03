<?php

class DistributionLevel extends Admin_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->acl->hasPermission("admin","distribution_level") ) {
            $this->session->set_flashdata('message', "对不起，您没有权限进入这个页面。");
            redirect('/admin/dashboard', 'refresh');
        }

        $this->load->model(array('admin/distlevel'));
    }

    public function index() {
        $distribution_levels = $this->distlevel->get_all();

        $data['distribution_levels'] = $distribution_levels;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "distribution_level_list";
        $this->load->view($this->_container, $data);
    }

    public function create() {
        if ($this->input->post('level_name')) {
            $data['level_name'] = $this->input->post('level_name');
            $data['distribution_ratio'] = $this->input->post('distribution_ratio');
            $data['upgrade_condition'] = $this->input->post('upgrade_condition');
            $this->distlevel->insert($data);

            redirect('/admin/distribution_level', 'refresh');
        }

        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "distribution_level_create";
        $this->load->view($this->_container, $data);
    }

    public function edit($id) {
        if ($this->input->post('level_name')) {
            $data['level_name'] = $this->input->post('level_name');
            $data['distribution_ratio'] = $this->input->post('distribution_ratio');
            $data['upgrade_condition'] = $this->input->post('upgrade_condition');
            $this->distlevel->update($data, $id);

            redirect('/admin/distribution_level', 'refresh');
        }

        $distribution_level = $this->distlevel->get($id);
        if(is_null($distribution_level) || !is_numeric($id))
            redirect('/admin/distribution_level', 'refresh');

        $data['distribution_level'] = $distribution_level;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "distribution_level_edit";
        $this->load->view($this->_container, $data);
    }

    public function delete($id) {
        if(!is_numeric($id))
            redirect('/admin/distribution_level', 'refresh');

        $this->distlevel->delete($id);

        redirect('/admin/distribution_level', 'refresh');
    }

}
