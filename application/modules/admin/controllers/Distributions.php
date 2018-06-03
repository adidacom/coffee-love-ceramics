<?php

class Distributions extends Admin_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->acl->hasPermission("admin","distributions") ) {
            $this->session->set_flashdata('message', "对不起，您没有权限进入这个页面。");
            redirect('/admin/dashboard', 'refresh');
        }

        $this->load->model(array('admin/distribution'));
        $this->load->model(array('admin/distlevel'));
    }

    public function index() {
        $distributions = $this->distribution->get_all();

        $data['distributions'] = $distributions;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "distribution_list";
        $this->load->view($this->_container, $data);
    }

    public function create() {
        if ($this->input->post('recommended_person')) {
            $data['recommended_person'] = $this->input->post('recommended_person');
            $data['recommended_name'] = $this->input->post('recommended_name');
            $data['recommended_phone'] = $this->input->post('recommended_phone');
            $data['distribution_level_id'] = $this->input->post('distribution_level_id');
            $data['cumulative_comission'] = $this->input->post('cumulative_comission');
            $data['total'] = $this->input->post('total');
            $data['status'] = $this->input->post('status');
            $data['reg_date'] = $this->input->post('reg_date');
            $data['reg_time'] = $this->input->post('reg_time');
            $data['commissioned'] = $this->input->post('commissioned');
            $data['no_commission'] = $this->input->post('no_commission');
            $this->distribution->insert($data);

            redirect('/admin/distributions', 'refresh');
        }

        $distribution_level = $this->distlevel->get_all();

        $data['distribution_level'] = $distribution_level;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "distribution_create";
        $this->load->view($this->_container, $data);
    }

    public function edit($id) {
        if ($this->input->post('recommended_person')) {
            $data['recommended_person'] = $this->input->post('recommended_person');
            $data['recommended_name'] = $this->input->post('recommended_name');
            $data['recommended_phone'] = $this->input->post('recommended_phone');
            $data['distribution_level_id'] = $this->input->post('distribution_level_id');
            $data['cumulative_comission'] = $this->input->post('cumulative_comission');
            $data['total'] = $this->input->post('total');
            $data['status'] = $this->input->post('status');
            $data['reg_date'] = $this->input->post('reg_date');
            $data['reg_time'] = $this->input->post('reg_time');
            $data['commissioned'] = $this->input->post('commissioned');
            $data['no_commission'] = $this->input->post('no_commission');
            $this->distribution->update($data, $id);

            redirect('/admin/distributions', 'refresh');
        }

        $distribution = $this->distribution->get($id);
        if(is_null($distribution) || !is_numeric($id))
            redirect('/admin/distributions', 'refresh');

        $distribution_level = $this->distlevel->get_all();
        $data['distribution_level'] = $distribution_level;
        $data['distribution'] = $distribution;

        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "distribution_edit";
        $this->load->view($this->_container, $data);
    }

    public function delete($id) {
        if(!is_numeric($id))
            redirect('/admin/distributions', 'refresh');

        $this->distribution->delete($id);

        redirect('/admin/distributions', 'refresh');
    }

}
