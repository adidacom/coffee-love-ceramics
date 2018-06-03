<?php

class ProductsLoss extends Admin_Controller {

    function __construct() {
        parent::__construct();

        /*if (!$this->acl->hasPermission("admin","product_loss") ) {
            $this->session->set_flashdata('message', "对不起，您没有权限进入这个页面。");
            redirect('/admin/dashboard', 'refresh');
        }*/

        $this->load->model(array('admin/productloss'));
        $this->load->model(array('admin/store'));
        $this->load->model(array('admin/color'));
        $this->load->model(array('admin/productinformation'));
    }

    public function index() {
        $products_loss = $this->productloss->get_all();

        $data['products_loss'] = $products_loss;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "products_loss_list";
        $this->load->view($this->_container, $data);
    }

    public function create() {
        if ($this->input->post('product_kind_id')) {
            $data['product_information_id'] = $this->input->post('product_information_id');
            $data['color_id'] = $this->input->post('color_id');
            $data['box_quantity'] = $this->input->post('box_quantity');
            $data['tiles_per_box_quantity'] = $this->input->post('tiles_per_box_quantity');
            $data['store_id'] = $this->input->post('store_id');
            $data['loss_description'] = $this->input->post('loss_description');

            $data['reg_date'] = $this->input->post('regist_date');
            $data['reg_time'] = $this->input->post('regist_time');

            $new_product_id = $this->productloss->insert($data);

            /*$product_information = $this->productinformation->get($data['product_information_id']);
            $new_stock = $product_information->stock - $data['box_quantity']*$data['tiles_per_box_quantity'];
            $this->productinformation->update(array("stock"=>$new_stock), $data['product_information_id']);*/

            redirect('/admin/product_loss', 'refresh');
        }

        $product_informations = $this->productinformation->get_all();
        $stores = $this->store->get_all();
        $colors = $this->color->get_all();

        $data['product_informations'] = $product_informations;
        $data['stores'] = $stores;
        $data['colors'] = $colors;

        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "products_loss_create";
        $this->load->view($this->_container, $data);
    }

    public function confirm($id){
        $product = $this->productloss->get($id);
        $product = $product[0];

        if(is_null($product) || !is_numeric($id))
            redirect('/admin/product_loss', 'refresh');

        $product_information = $this->productinformation->get($product->product_information_id);

        $new_stock = $product_information->stock - $product->box_quantity * $product->tiles_per_box_quantity;
        $new_real_stock = $product_information->real_stock - $product->box_quantity * $product->tiles_per_box_quantity;
        $this->productinformation->update(array("stock"=>$new_stock,"real_stock"=>$new_real_stock), $product->product_information_id);

        $loss_data = array("confirmed"=>'yes',"confirmer_id"=>$this->logged_ind_user->id);
        $this->productloss->update($loss_data, $id);

        redirect('/admin/product_loss', 'refresh');
    }

    public function edit($id) {
        $product = $this->productloss->get($id);
        $product = $product[0];

        if(is_null($product) || !is_numeric($id))
            redirect('/admin/product_loss', 'refresh');

        if ($this->input->post('product_kind_id')) {
            $data['product_information_id'] = $this->input->post('product_information_id');
            $data['color_id'] = $this->input->post('color_id');
            $data['box_quantity'] = $this->input->post('box_quantity');
            $data['tiles_per_box_quantity'] = $this->input->post('tiles_per_box_quantity');
            $data['store_id'] = $this->input->post('store_id');
            $data['loss_description'] = $this->input->post('loss_description');

            $data['reg_date'] = $this->input->post('regist_date');
            $data['reg_time'] = $this->input->post('regist_time');

            $this->productloss->update($data, $id);

            /*$product_information = $this->productinformation->get($data['product_information_id']);
            if($product->product_information_id == $data['product_information_id']) {
                $new_stock = ($product_information->stock + $product->box_quantity * $product->tiles_per_box_quantity) - $data['box_quantity'] * $data['tiles_per_box_quantity'];
                $this->productinformation->update(array("stock"=>$new_stock), $data['product_information_id']);
            }
            else {
                $new_stock = $product_information->stock - $data['box_quantity'] * $data['tiles_per_box_quantity'];
                $this->productinformation->update(array("stock"=>$new_stock), $data['product_information_id']);

                $org_product_information = $this->productinformation->get($product->product_information_id);
                $org_stock = $org_product_information->stock + $product->box_quantity*$product->tiles_per_box_quantity;
                $this->productinformation->update(array("stock"=>$org_stock), $product->product_information_id);
            }*/

            redirect('/admin/product_loss', 'refresh');
        }

        $product_informations = $this->productinformation->get_all();
        $stores = $this->store->get_all();
        $colors = $this->color->get_all();

        $data['product_informations'] = $product_informations;
        $data['stores'] = $stores;
        $data['colors'] = $colors;
        $data['product'] = $product;

        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "products_loss_edit";

        $this->load->view($this->_container, $data);
    }

    public function delete($id) {
        if(!is_numeric($id))
            redirect('/admin/product_loss', 'refresh');

        $this->productloss->delete($id);

        redirect('/admin/product_loss', 'refresh');
    }

}
