<?php

class Posts extends Admin_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->acl->hasPermission("admin","posts") ) {
            $this->session->set_flashdata('message', "对不起，您没有权限进入这个页面。");
            redirect('/admin/dashboard', 'refresh');
        }

        $this->load->model(array('admin/post'));
    }

    public function index() {
        $posts = $this->post->get_all();

        $data['posts'] = $posts;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "posts_list";
        $this->load->view($this->_container, $data);
    }

    public function create() {
        if ($this->input->post('title')) {
            $data['title'] = $this->input->post('title');
            $data['keyword'] = $this->input->post('keyword');
            $data['description'] = $this->input->post('description');
            $data['contents'] = $this->input->post('contents');
            $this->post->insert($data);

            redirect('/admin/posts', 'refresh');
        }

        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "posts_create";
        $this->load->view($this->_container, $data);
    }

    public function edit($id) {
        if ($this->input->post('title')) {
            $data['title'] = $this->input->post('title');
            $data['keyword'] = $this->input->post('keyword');
            $data['description'] = $this->input->post('description');
            $data['contents'] = $this->input->post('contents');
            $this->post->update($data, $id);

            redirect('/admin/posts', 'refresh');
        }

        $post = $this->post->get($id);
        if(is_null($post) || !is_numeric($id))
            redirect('/admin/colors', 'refresh');

        $data['post'] = $post;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "posts_edit";
        $this->load->view($this->_container, $data);
    }

    public function delete($id) {
        if(!is_numeric($id))
            redirect('/admin/posts', 'refresh');

        $this->post->delete($id);

        redirect('/admin/posts', 'refresh');
    }

}
