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
class Products extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->load->model(array('api/product'));
        $this->load->model(array('api/user'));

/*
        $token = $this->post('token');

        if( !$this->product->check_token($token) ){
            $this->response([
                'status' => FALSE,
                'message' => 'invalid_token'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
*/
    }

    public function kinds_post(){

        $product_kinds = $this->product->get_product_kinds();

        if(count($product_kinds)==0){
            $this->response([
                'status' => FALSE,
                'message' => "no_product_kinds"
            ], REST_Controller::HTTP_OK);
        }

        $first_item = array("value"=>0, "text" => "全部");
        array_unshift($product_kinds, $first_item);

        $this->response([
            'status' => TRUE,
            'data' => $product_kinds
        ], REST_Controller::HTTP_OK);
    }

    public function getbykind_post(){
        $kind_id = $this->post('kind_id');
        if($kind_id == 0)
            $products = $this->product->get_all_products();
        else
            $products = $this->product->get_products_by_kind($kind_id);

        foreach($products as $ind => $product){
            if($product->photo_1 != ""){
                $products[$ind]->photo_1 = $this->config->base_url()."assets/products/".$product->photo_1;
            }
        }

        $this->response([
            'status' => TRUE,
            'data' => $products
        ], REST_Controller::HTTP_OK);
    }

    public function getbyid_post(){

        $product_id = $this->post('product_id');
        $product = $this->product->get_by_id($product_id);
        $product = $product[0];

        if($product->photo_1 != ""){
            $product->photo_1 = $this->config->base_url()."assets/products/".$product->photo_1;
        }

        if($product->photo_2 != ""){
            $product->photo_2 = $this->config->base_url()."assets/products/".$product->photo_2;
        }

        if($product->photo_3 != ""){
            $product->photo_3 = $this->config->base_url()."assets/products/".$product->photo_3;
        }

        if($product->photo_4 != ""){
            $product->photo_4 = $this->config->base_url()."assets/products/".$product->photo_4;
        }

        if($product->photo_5 != ""){
            $product->photo_5 = $this->config->base_url()."assets/products/".$product->photo_5;
        }

        $user = $this->user->get_user_by_token($this->post('token'));
		if(!empty($user)){
			$user = $user[0];
				
			if( $user->group_name == "business_user" ){
				$product->price_label = "店面价";
				$product->show_price = $product->sale_price;
			} else if($user->group_name == "consumer"){
				$product->price_label = "网上价";
				$product->show_price = $product->internet_price;
			} else if($user->group_name == "agency" || $user->group_name == "admin"){
				$product->price_label = "开单价";
				$product->show_price = $product->production_price;
			}
		}
        $product->quantity = 0;


        $this->response([
            'status' => TRUE,
            'data' => $product
        ], REST_Controller::HTTP_OK);
    }

    public function ordercreate_post(){
        $token = $this->post('token');

        if( !$this->product->check_token($token) ){
            $this->response([
                'status' => -401,
                'message' => 'invalid_token'
            ], REST_Controller::HTTP_OK);
        }

        /*$data['product_kind_id'] = $this->post('product_kind_id');
        $data['color_id'] = $this->post('color_id');
        $data['product_type_no'] = $this->post('product_type_no');
        $data['product_sn'] = $this->post('product_sn');
        $data['product_license_no'] = $this->post('product_license_no');*/
        $data['quantity'] = $this->post('quantity');
        //$data['unit_id'] = $this->post('unit_id');
        $data['sale_price'] = $this->post('show_price');
        $data['order_date'] = date("Y-m-d H:i:s");
        $data['user_id'] = $this->post('user_id');
        $data['product_id'] = $this->post('id');
        $data['status_id'] = 1;

        $insert_id = $this->product->create_order($data);

        if($insert_id){
            $this->response([
                'status' => TRUE,
                'data' => 'success'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'data' => 'orders failed'
            ], REST_Controller::HTTP_OK);
        }

    }

    public function ordersbyuser_post(){
        $user_id = $this->post('user_id');

        $orders = $this->product->orders_by_user($user_id);

        if (count($orders)==0){
            $this->response([
                'status' => FALSE,
                'message' => 'no_orders'
            ], REST_Controller::HTTP_OK);
        }

        foreach($orders as $ind => $order){
            if($order->photo_1 != ""){
                $orders[$ind]->photo_1 = $this->config->base_url()."assets/products/".$order->photo_1;
            }

            if($order->status_id > 2)
                $orders[$ind]->paid_class = "paid1";
            else
                $orders[$ind]->paid_class = "paid0";
        }
        $this->response([
            'status' => TRUE,
            'data' => $orders
        ], REST_Controller::HTTP_OK);
    }

    public function orderbyid_post(){
        $order_id = $this->post('order_id');

        $order = $this->product->order_by_id($order_id);
        $order = $order[0];

        $this->response([
            'status' => TRUE,
            'data' => $order
        ], REST_Controller::HTTP_OK);
    }

    public function getretailers_post(){
        $user_id = $this->post('user_id');

        $retailers = $this->product->get_retailers($user_id);

        foreach($retailers as $ind => $retailer){
            if ($retailer['avatar'] != "")
                $retailers[$ind]['avatar'] = $this->config->base_url()."assets/admin/images/users/".$retailer['avatar'];
            else
                $retailers[$ind]['avatar'] = './img/fenxiao_icon@2x.png';
        }

        $this->response([
            'status' => TRUE,
            'data' => $retailers
        ], REST_Controller::HTTP_OK);

    }
}
