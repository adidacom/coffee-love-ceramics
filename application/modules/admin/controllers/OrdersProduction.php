<?php

class OrdersProduction extends Admin_Controller {

    function __construct() {
        parent::__construct();

        /*if (!$this->acl->hasPermission("admin","orders_production") ) {
            $this->session->set_flashdata('message', "对不起，您没有权限进入这个页面。");
            redirect('/admin/dashboard', 'refresh');
        }*/

        $this->load->model(array('admin/orderproduction'));
        $this->load->model(array('admin/productkind'));
        $this->load->model(array('admin/color'));
        $this->load->model(array('admin/unit'));
    }

    public function index() {
        $path = $this -> router -> fetch_module();
        $orders_production = $this->orderproduction->get_all();

        $data['orders_production'] = $orders_production;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "orders_production_list";
        $this->load->view($this->_container, $data);
    }

    public function create() {
        if ($this->input->post('product_kind_id')) {
            $data['product_kind_id'] = $this->input->post('product_kind_id');
            $data['color_id'] = $this->input->post('color_id');
            $data['product_type_no'] = $this->input->post('product_type_no');
            $data['product_sn'] = $this->input->post('product_sn');
            $data['product_license_no'] = $this->input->post('product_license_no');
            $data['quantity'] = $this->input->post('quantity');
            $data['unit_id'] = $this->input->post('unit_id');
            $data['production_price'] = $this->input->post('production_price');
            $data['bulk_sale_price'] = $this->input->post('bulk_sale_price');
            $data['sale_price'] = $this->input->post('sale_price');
            $data['discount_price'] = $this->input->post('discount_price');
            $data['price'] = $this->input->post('price');
            $data['reservation_amount'] = $this->input->post('reservation_amount');
            $data['reservation_date'] = $this->input->post('reservation_date');
            $data['reservation_time'] = $this->input->post('reservation_time');
            $data['reg_date'] = date("Y-m-d H:i:s");

            $this->orderproduction->insert($data);

            redirect('/admin/orders_production', 'refresh');
        }

        $product_kinds = $this->productkind->get_all();
        $colors = $this->color->get_all();
        $units = $this->unit->get_all();

        $data['product_kinds'] = $product_kinds;
        $data['colors'] = $colors;
        $data['units'] = $units;

        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "orders_production_create";
        $this->load->view($this->_container, $data);
    }

    public function edit($id) {
        if ($this->input->post('product_kind_id')) {
            $data['product_kind_id'] = $this->input->post('product_kind_id');
            $data['color_id'] = $this->input->post('color_id');
            $data['product_type_no'] = $this->input->post('product_type_no');
            $data['product_sn'] = $this->input->post('product_sn');
            $data['product_license_no'] = $this->input->post('product_license_no');
            $data['quantity'] = $this->input->post('quantity');
            $data['unit_id'] = $this->input->post('unit_id');
            $data['production_price'] = $this->input->post('production_price');
            $data['bulk_sale_price'] = $this->input->post('bulk_sale_price');
            $data['sale_price'] = $this->input->post('sale_price');
            $data['discount_price'] = $this->input->post('discount_price');
            $data['price'] = $this->input->post('price');
            $data['reservation_amount'] = $this->input->post('reservation_amount');
            $data['reservation_date'] = $this->input->post('reservation_date');
            $data['reservation_time'] = $this->input->post('reservation_time');

            $this->orderproduction->update($data, $id);

            redirect('/admin/orders_production', 'refresh');
        }

        $order_production = $this->orderproduction->get($id);
        if(is_null($order_production) || !is_numeric($id))
            redirect('/admin/orders_production', 'refresh');

        $product_kinds = $this->productkind->get_all();
        $colors = $this->color->get_all();
        $units = $this->unit->get_all();

        $data['product_kinds'] = $product_kinds;
        $data['colors'] = $colors;
        $data['units'] = $units;
        $data['order_production'] = $order_production;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "orders_production_edit";

        $this->load->view($this->_container, $data);
    }

    public function delete($id) {
        if(!is_numeric($id))
            redirect('/admin/orders_production', 'refresh');

        $this->orderproduction->delete($id);

        redirect('/admin/orders_production', 'refresh');
    }

}
