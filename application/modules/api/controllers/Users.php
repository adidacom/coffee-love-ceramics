<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Users extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key

        $this->load->model(array('api/user'));
        $this->load->model(array('api/product'));
    }

    public function login_get(){
        $remember = false;

        if( !isset($_REQUEST['email']) || !isset($_REQUEST['password']) ){
            $this->response([
                'status' => FALSE,
                'message' => 'incorrect_params'
            ], REST_Controller::HTTP_NOT_FOUND);
        }



        if ($this->ion_auth->login($_REQUEST['email'], $_REQUEST['password'], $remember)) {

            $access_token = md5(uniqid(rand(), true));
            $user = $this->ion_auth->user()->row();
            $expire_time = strtotime(date("Y-m-d H:i:s"))+24*60*60;

            $data = array("access_token"=>$access_token, "expires_in"=>$expire_time);
            $this->user->update_user_token($data, $user->id);

            $return_data = array(
                'token' => $access_token,
                'id' => $user->id,
                'user_name' => $user->nickname,
                'phone' => $user->phone
            );

            $this->response([
                'status' => TRUE,
                'data' => $return_data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'login_failed'
            ], REST_Controller::HTTP_OK);
        }
    }

    public function signup_get(){
        if( $this->ion_auth_model->phonenumber_check($_REQUEST['email'] )){
            $this->response([
                'status' => FALSE,
                'data' => "phone_already_used"
            ], REST_Controller::HTTP_OK);
        }

        $phone = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        $email = "";

        $additional_data = array();
        $access_token = md5(uniqid(rand(), true));
        $expire_time = strtotime(date("Y-m-d H:i:s"))+24*60*60;

        $additional_data['access_token'] = $access_token;
        $additional_data['expires_in'] = $expire_time;

        if(isset($_REQUEST['inviter']))
            $additional_data['parent_id'] = $_REQUEST['inviter'];

        $group_id = array(4);

        $user_id = $this->ion_auth->register($phone, $password, $email, $additional_data, $group_id);

        $user = array(
            "id" => $user_id,
            "user_name" => "",
            "phone" => $phone,
            "token" => $access_token
        );

        $this->response([
            'status' => TRUE,
            'data' => $user
        ], REST_Controller::HTTP_OK);
    }

    public function logout_get(){

        $user_id = $_REQUEST['member_id'];

        $data = array("access_token"=>'', "expires_in"=>'');
        $this->user->update_user_token($data, $user_id );

        $this->ion_auth->logout();

        $this->response([
            'status' => TRUE,
            'data' => "logout"
        ], REST_Controller::HTTP_OK);
    }

    public function profile_post(){
        $id = $this->post('user_id');
        $token = $this->post('token');

        if( !$this->product->check_token($token) ){
            $this->response([
                'status' => -401,
                'message' => 'invalid_token'
            ], REST_Controller::HTTP_OK);
        }

        if ($id <= 0)
        {
            // Invalid id, set the response and exit.
            //$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            $this->response([
                'status' => -401,
                'message' => 'User could not be found'
            ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
        }

        $user = $this->ion_auth->user($id)->row();

        if ($user)
        {
            // Set the response and exit
            if($user->avatar != "")
                $user->avatar = $this->config->base_url()."assets/admin/images/users/".$user->avatar;
            else
                $user->avatar = './img/fenxiao_icon@2x.png';

            $user_group = $this->ion_auth->get_users_groups($id)->row();
            $user->group_id = $user_group->id;
            $user->group_name = $user_group->name;

            $this->response([
                'status' => TRUE,
                'data' => $user
            ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'User could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function resetpassword_post(){
        $phone = $this->post('phone');
        $old_pw = $this->post('old_pw');
        $new_pw = $this->post('new_pw');

        $is_changed = $this->ion_auth->change_password($phone, $old_pw, $new_pw);

        if($is_changed){
            $this->response([
                'status' => TRUE,
                'message' => 'password changed'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => $this->ion_auth->errors('password_change_unsuccessful')
            ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
    }

    public function updatenickname_post(){
        $id = $this->post('user_id');
        $nick_name = $this->post('new_name');

        $data = array('nickname' => $nick_name);

        $is_changed = $this->ion_auth->update($id, $data);

        if($is_changed){
            $this->response([
                'status' => TRUE,
                'message' => 'nickname changed'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'nickname change failed'
            ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
    }

    public function updateavatar_post(){
        $id = $this->post('user_id');
        $data = $this->post('image');

        //$img = str_replace('data:image/png;base64,', '', $data);
		$img = explode(',', $data)[1];
        $img_dir = $_SERVER['DOCUMENT_ROOT'].'/assets/admin/images/users/';
        $file_name = "user_".$id.".png";
        $file_url = $img_dir.$file_name;
        file_put_contents($file_url, base64_decode($img));

        $data = array('avatar' => $file_name);

        $is_changed = $this->ion_auth->update($id, $data);
        if($is_changed){
            $this->response([
                'status' => TRUE,
                'message' => 'avatar changed'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'nickname change failed'
            ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
    }

    public function users_post()
    {
        // $this->some_model->update_user( ... );
        $message = [
            'id' => 100, // Automatically generated by the model
            'name' => $this->post('name'),
            'email' => $this->post('email'),
            'message' => 'Added a resource'
        ];

        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function users_delete()
    {
        $id = (int) $this->get('id');

        // Validate the id.
        if ($id <= 0)
        {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // $this->some_model->delete_something($id);
        $message = [
            'id' => $id,
            'message' => 'Deleted the resource'
        ];

        $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }

}
