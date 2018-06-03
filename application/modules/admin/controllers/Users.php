<?php

class Users extends Admin_Controller {

    private $img_dir = "assets/admin/images/users/";

    function __construct() {
        parent::__construct();

        /*if (!$this->acl->hasPermission("admin","users") ) {
            $this->session->set_flashdata('message', "对不起，您没有权限进入这个页面。");
            redirect('/admin/dashboard', 'refresh');
        }*/

        /*$group = 'admin';

        if (!$this->ion_auth->in_group($group))
        {
            $this->session->set_flashdata('message', 'You must be an administrator to view the users page.');
            redirect('admin/dashboard');
        }*/
    }

    public function index() {
        $user_in_group = array(2,4,5,7);
        $users = $this->ion_auth->users($user_in_group)->result();

        $data['users'] = $users;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "users_list";
        $this->load->view($this->_container, $data);
    }

    public function backendusers() {
        $user_in_group = array(1,3,6,8);
        $users = $this->ion_auth->users($user_in_group)->result();

        $data['users'] = $users;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "users_list";
        $this->load->view($this->_container, $data);
    }

    public function create() {
        if ($this->input->post('phone')) {

            if( $this->ion_auth_model->phonenumber_check($this->input->post('phone') )){
                $errors = "电话号码已被注册。";
                $this->session->set_flashdata('message', $errors);
                redirect('/admin/users', 'refresh');
            }

            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $group_id = array( $this->input->post('group_id'));

            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'username' => $this->input->post('username'),
                'phone' => $this->input->post('phone'),
                'nickname' => $this->input->post('nickname'),
                'parent_id' => $this->input->post('parent_id'),
            );

            if ($_FILES["avatar"]['name'] != "") {
                $newfilename = time() . $_FILES["avatar"]['name'];

                $config = array(
                    'upload_path' => "./assets/admin/images/users/",
                    'allowed_types' => "gif|jpg|png|jpeg|pdf",
                    'overwrite' => TRUE,
                    'max_size' => "2048000",  // Can be set to particular file size
                    //'max_height'      => "200",
                    //'max_width'       => "200"
                    'file_name' => $newfilename
                );

                $this->load->library('upload', $config);
                $this->load->library('image_lib');
                if ($this->upload->do_upload('avatar')) {
                    /*$data = array('upload_data' => $this->upload->data());
                    $this->load->view('upload_success',$data);*/

                    $image_data = $this->upload->data();

                    $configer = array(
                        'image_library' => 'gd2',
                        'source_image' => $image_data['full_path'],
                        'maintain_ratio' => TRUE,
                        'width' => 250,
                        'height' => 250,
                    );
                    $this->image_lib->clear();
                    $this->image_lib->initialize($configer);
                    $this->image_lib->resize();

                    $additional_data['avatar'] = $image_data['file_name'];
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('message', $error);
                    redirect('/admin/users', 'refresh');
                }
            }

            $user = $this->ion_auth->register($phone, $password, $email, $additional_data,$group_id);

            if(!$user)
            {
                $errors = $this->ion_auth->errors();
                $this->session->set_flashdata('message', $errors);
                redirect('/admin/users', 'refresh');
            }
            else
            {
                redirect('/admin/users', 'refresh');
            }
        }

        $users = $this->ion_auth->users()->result();
        $data['groups'] = $this->ion_auth->groups()->result();
        $data['users'] = $users;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "users_create";
        $this->load->view($this->_container, $data);
    }

    public function edit($id) {

        $user = $this->ion_auth->user($id)->row();

        if ($this->input->post('phone')) {

            if( $this->ion_auth_model->phonenumber_check($this->input->post('phone'), $id)){
                $errors = "电话号码已被注册。";
                $this->session->set_flashdata('message', $errors);
                redirect('/admin/users', 'refresh');
            }

            $data['username'] = $this->input->post('username');
            $data['first_name'] = $this->input->post('first_name');
            $data['last_name'] = $this->input->post('last_name');
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');
            $data['nickname'] = $this->input->post('nickname');
            $data['parent_id'] = $this->input->post('parent_id');

            if ( $this->input->post('password') != "" )
                $data['password'] = $this->input->post('password');

            if ($_FILES["avatar"]['name'] != "") {
                $newfilename = time() . $_FILES["avatar"]['name'];

                $config = array(
                    'upload_path' => "./assets/admin/images/users/",
                    'allowed_types' => "gif|jpg|png|jpeg|pdf",
                    'overwrite' => TRUE,
                    'max_size' => "2048000",  // Can be set to particular file size
                    'file_name' => $newfilename
                );

                $this->load->library('upload', $config);
                $this->load->library('image_lib');
                if ($this->upload->do_upload('avatar')) {
                    /*$data = array('upload_data' => $this->upload->data());
                    $this->load->view('upload_success',$data);*/

                    $image_data = $this->upload->data();

                    $configer = array(
                        'image_library' => 'gd2',
                        'source_image' => $image_data['full_path'],
                        'maintain_ratio' => TRUE,
                        'width' => 250,
                        'height' => 250,
                    );
                    $this->image_lib->clear();
                    $this->image_lib->initialize($configer);
                    $this->image_lib->resize();

                    $data['avatar'] = $image_data['file_name'];

                    if (file_exists($this->img_dir.$user->avatar) && $user->avatar != "" )
                        unlink($this->img_dir.$user->avatar);

                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('message', $error);
                    redirect('/admin/users', 'refresh');
                }
            }

            $group_id = $this->input->post('group_id');
            
            $this->ion_auth->remove_from_group('', $id);
            $this->ion_auth->add_to_group($group_id, $id);

            $this->ion_auth->update($id, $data);
            
            redirect('/admin/users', 'refresh');
        }

        $this->load->helper('ui');

        $data['groups'] = $this->ion_auth->groups()->result();

        if($user->avatar != "")
            $user->avatar = "../../../" . $this->img_dir . $user->avatar;
        else
            $user->avatar = "../../../" . $this->img_dir . "default_avatar.png";

        $data['user'] = $user;
        $data['users'] = $this->ion_auth->users()->result();
        $data['user_group'] = $this->ion_auth->get_users_groups($id)->row();
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "users_edit";
        $this->load->view($this->_container, $data);
    }

    public function delete($id) {

        if(!is_numeric($id))
            redirect('/admin/users', 'refresh');

        $user = $this->ion_auth->user($id)->row();

        if(is_null($user) || !is_numeric($id))
            redirect('/admin/users', 'refresh');

        $this->ion_auth->delete_user($id);

        if ( $user->avatar != "" && file_exists($this->img_dir.$user->avatar))
            unlink($this->img_dir.$user->avatar);

        redirect('/admin/users', 'refresh');
    }

    public function getbyphone($phone){
        $this->load->model(array('admin/user'));
        $user = $this->user->get_user_by_phone($phone);

        if(is_null($user)){
            echo json_encode(array("status"=>"fail"));
        } else
        {
            echo json_encode(array("status"=>"success", "data"=>$user));
        }
    }

    public function getbynameorphone(){
        $this->load->model(array('admin/user'));
        $search_query = $this->input->get('q');
        $page = $this->input->get('page');

        $users = $this->user->get_user_by_name_or_phone($search_query);
        $data = array(
            "total_count" => count($users),
            "items" => $users
        );
        echo json_encode($data);
    }

    public function getdeposittypeusers(){

    }
}
