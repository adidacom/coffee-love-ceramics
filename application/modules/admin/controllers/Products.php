<?php

class Products extends Admin_Controller {

    protected $img_dir = 'assets/products/';

    function __construct() {
        parent::__construct();

        /*if (!$this->acl->hasPermission("admin","products") ) {
            $this->session->set_flashdata('message', "对不起，您没有权限进入这个页面。");
            redirect('/admin/dashboard', 'refresh');
        }*/

        $this->load->model(array('admin/product'));
        $this->load->model(array('admin/store'));
        $this->load->model(array('admin/color'));
        $this->load->model(array('admin/productinformation'));
    }

    public function index() {
        $products = $this->product->get_all();

        $data['products'] = $products;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "products_list";
        $this->load->view($this->_container, $data);
    }

    public function create() {
        if ($this->input->post('product_kind_id')) {
            $data['product_information_id'] = $this->input->post('product_information_id');
            $data['color_id'] = $this->input->post('color_id');
            $data['box_quantity'] = $this->input->post('box_quantity');
            $data['tiles_per_box_quantity'] = $this->input->post('tiles_per_box_quantity');
            $data['product_license_no'] = $this->input->post('product_license_no');
            $data['store_id'] = $this->input->post('store_id');

            $data['reg_date'] = $this->input->post('regist_date');
            $data['reg_time'] = $this->input->post('regist_time');

            $new_product_id = $this->product->insert($data);

            $product_information = $this->productinformation->get($data['product_information_id']);
            $new_stock = $product_information->stock + $data['box_quantity']*$data['tiles_per_box_quantity'];
            $new_real_stock = $product_information->real_stock + $data['box_quantity']*$data['tiles_per_box_quantity'];
            $this->productinformation->update(array("stock"=>$new_stock,"real_stock"=>$new_real_stock), $data['product_information_id']);

            redirect('/admin/products', 'refresh');
        }

        $product_informations = $this->productinformation->get_all();
        $stores = $this->store->get_all();
        $colors = $this->color->get_all();

        $data['product_informations'] = $product_informations;
        $data['stores'] = $stores;
        $data['colors'] = $colors;

        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "products_create";
        $this->load->view($this->_container, $data);
    }

    public function edit($id) {

        $product = $this->product->get($id);
        $product = $product[0];

        if(is_null($product) || !is_numeric($id))
            redirect('/admin/products', 'refresh');

        if ($this->input->post('product_kind_id')) {
            $data['product_information_id'] = $this->input->post('product_information_id');
            $data['box_quantity'] = $this->input->post('box_quantity');
            $data['tiles_per_box_quantity'] = $this->input->post('tiles_per_box_quantity');
            $data['product_license_no'] = $this->input->post('product_license_no');
            $data['store_id'] = $this->input->post('store_id');

            $data['reg_date'] = $this->input->post('regist_date');
            $data['reg_time'] = $this->input->post('regist_time');

            $this->product->update($data, $id);

            $product_information = $this->productinformation->get($data['product_information_id']);
            if($product->product_information_id == $data['product_information_id']) {
                $new_stock = ($product_information->stock - $product->box_quantity * $product->tiles_per_box_quantity) + $data['box_quantity'] * $data['tiles_per_box_quantity'];
                $this->productinformation->update(array("stock"=>$new_stock), $data['product_information_id']);
            }
            else {
                $new_stock = $product_information->stock + $data['box_quantity'] * $data['tiles_per_box_quantity'];
                $this->productinformation->update(array("stock"=>$new_stock), $data['product_information_id']);

                $org_product_information = $this->productinformation->get($product->product_information_id);
                $org_stock = $org_product_information->stock - $product->box_quantity*$product->tiles_per_box_quantity;
                $this->productinformation->update(array("stock"=>$org_stock), $product->product_information_id);
            }

            redirect('/admin/products', 'refresh');
        }

        $product_informations = $this->productinformation->get_all();
        $stores = $this->store->get_all();
        $colors = $this->color->get_all();

        $data['product_informations'] = $product_informations;
        $data['stores'] = $stores;
        $data['product'] = $product;
        $data['colors'] = $colors;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "products_edit";

        $this->load->view($this->_container, $data);
    }

    public function delete($id) {
        if(!is_numeric($id))
            redirect('/admin/products', 'refresh');

        $product = $this->product->get($id);

        if(is_null($product) || !is_numeric($id))
            redirect('/admin/products', 'refresh');

        $product = $product[0];

        $org_product_information = $this->productinformation->get($product->product_information_id);
        $org_stock = $org_product_information->stock - $product->box_quantity*$product->tiles_per_box_quantity;
        $org_real_stock = $org_product_information->real_stock - $product->box_quantity*$product->tiles_per_box_quantity;
        $this->productinformation->update(array("stock"=>$org_stock, "real_stock"=>$org_real_stock), $product->product_information_id);

        $this->product->delete($id);

        redirect('/admin/products', 'refresh');
    }

    public function getproductcolors($product_information_id){
        $colors = $this->product->getproductcolors($product_information_id);
        echo json_encode($colors);
    }

}
