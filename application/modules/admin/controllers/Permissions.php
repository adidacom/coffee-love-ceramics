<?php

class Permissions extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $group = 'admin';

        if (!$this->ion_auth->in_group($group))
        {
            $this->session->set_flashdata('message', '对不起，您没有权限进入这个页面。');
            redirect('admin/dashboard');
        }

        $this->load->model(array('admin/action_model'));
        $this->load->model(array('admin/group_action_model'));
    }

    function index(){
        $data['groups'] = $this->ion_auth->groups()->result();
        $data['actions'] = $this->action_model->getAll();
        foreach ($data['actions'] as $action) {
            $action->groups = array();
            $group_action = $this->group_action_model->openWhere(array('id_action'=>$action->id));
            foreach ($group_action as $group) {
                $action->groups[$group->id_group] = true;
            }
        }

        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "permissions";
        $this->load->view($this->_container, $data);
    }


    function addPerm(){
        $id_action = $this->input->post('id_action',true);
        if(empty($id_action) || ! is_numeric($id_action)){die();}
        $action = $this->action_model->open($id_action);
        if(empty($action))die();

        $id_group = $this->input->post('id_group',true);
        if(empty($id_group) || ! is_numeric($id_group)){die("group");}


        $this->acl->addPerm($id_action,$id_group);
        die();
    }

    function rmPerm(){
        $id_action = $this->input->post('id_action',true);
        if(empty($id_action) || ! is_numeric($id_action)){die();}

        $action = $this->action_model->open($id_action);
        if(empty($action))die();

        $id_group = $this->input->post('id_group',true);
        if(empty($id_group) || ! is_numeric($id_group)){die();}

        $group = $this->group_action_model->openWhere(array("id_group"=>$id_group,"id_action"=>$id_action));
        if(empty($group))die();

        $this->acl->rmPerm($group[0]->id);
        die();
    }

    function rmAction(){
        $id_action = $this->input->post('id_action',true);
        if(empty($id_action) || ! is_numeric($id_action)){redirect();}

        $action = $this->action_model->open($id_action);
        if(empty($action))redirect();

        $this->acl->rmAction($id_action);
        redirect('admin/permissions');
    }

    function setPublic(){
        $id_action = $this->input->post('id_action',true);
        if(empty($id_action) || ! is_numeric($id_action)){die();}

        $action = $this->action_model->open($id_action);
        if(empty($action))die();

        $this->acl->addPermPublic($id_action);
        die();

    }

    function addAction(){
        $ctrl = $this->input->post('ctrl',true);
        $nom = $this->input->post('nom',true);
        $ssctrl = $this->input->post('ssctrl',true);
        if(empty($ssctrl))
            $ssctrl="*";
        $this->acl->addAction($nom,$ctrl,$ssctrl);
        redirect('admin/permissions', 'refresh');
    }

}
