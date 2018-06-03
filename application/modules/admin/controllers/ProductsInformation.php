<?php

class ProductsInformation extends Admin_Controller {

    protected $img_dir = 'assets/products/';

    function __construct() {
        parent::__construct();

        /*if (!$this->acl->hasPermission("admin","product_information") ) {
            $this->session->set_flashdata('message', "对不起，您没有权限进入这个页面。");
            redirect('/admin/dashboard', 'refresh');
        }*/

        $this->load->model(array('admin/productinformation'));
        $this->load->model(array('admin/productkind'));
        $this->load->model(array('admin/color'));
        $this->load->model(array('admin/tilecategory'));
        $this->load->model(array('admin/ordercustomer'));
    }

    public function index() {
        $products_information = $this->productinformation->get_all();

        $data['products_information'] = $products_information;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "products_information_list";
        $this->load->view($this->_container, $data);
    }

    public function create() {

        if ($this->input->post('product_kind_id')) {

            //if( $this->productinformation->is_already_registered_product_sn($this->input->post('product_sn'), $this->input->post('color_id')) ){
            if( $this->productinformation->is_already_registered_product_sn($this->input->post('product_sn')) ){
                $this->session->set_flashdata('message', "产品编号已被登录。");
                $data['data'] = $_POST;
                //redirect('/admin/product_information/create', 'refresh');
            } else {

                $data['tile_category_id'] = $this->input->post('tile_category_id');
                $data['product_kind_id'] = $this->input->post('product_kind_id');
                //$data['color_id'] = $this->input->post('color_id');
                $data['product_type_no'] = $this->input->post('product_type_no');
                $data['product_sn'] = $this->input->post('product_sn');
                //$data['product_license_no'] = $this->input->post('product_license_no');
                $data['tiles_per_box_quantity'] = $this->input->post('tiles_per_box_quantity');
                $data['size_width'] = $this->input->post('size_width');
                $data['size_height'] = $this->input->post('size_height');
                $data['weight'] = $this->input->post('weight');
                $data['production_price'] = $this->input->post('production_price');
                $data['bulk_sale_price'] = $this->input->post('bulk_sale_price');
                $data['sale_price'] = $this->input->post('sale_price');
                $data['internet_price'] = $this->input->post('internet_price');
                $data['discount_price'] = $this->input->post('discount_price');

                $data['loading_fee'] = $this->input->post('loading_fee');
                $data['reg_date'] = date("Y-m-d H:i:s");
                $data['description'] = $this->input->post('product_description');

                $new_product_id = $this->productinformation->insert($data);
                if ($new_product_id) {

                    for ($i = 1; $i <= 5; $i++) {
                        if ($_FILES['photo_' . $i]['name'] != "") {
                            $ext = substr(basename($_FILES['photo_' . $i]['name']), strpos(basename($_FILES['photo_' . $i]['name']), '.'), strlen(basename($_FILES['photo_' . $i]['name'])) - 1);
                            $newFilename = $new_product_id . "_" . $i . $ext;

                            if (move_uploaded_file($_FILES['photo_' . $i]['tmp_name'], $this->img_dir . $newFilename)) {
                                $updatePhotoRecord = array(
                                    'photo_' . $i => $newFilename,
                                    'photo_' . $i . '_mimetype' => $_FILES['photo_' . $i]['type']
                                );

                                $this->productinformation->update($updatePhotoRecord, $new_product_id);
                            }
                        }
                    }
                }

                redirect('/admin/product_information', 'refresh');
            }
        }

        $product_kinds = $this->productkind->get_all();
        //$colors = $this->color->get_all();
        $tile_category = $this->tilecategory->get_all();

        $data['product_kinds'] = $product_kinds;
        //$data['colors'] = $colors;
        $data['tile_category'] = $tile_category;

        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "products_information_create";
        $this->load->view($this->_container, $data);
    }

    public function get($id){
        $information = $this->productinformation->get_one($id);
        echo json_encode($information[0]);
    }

    public function edit($id) {
        $product = $this->productinformation->get($id);

        if(is_null($product) || !is_numeric($id))
            redirect('/admin/product_information', 'refresh');

        if ($this->input->post('product_kind_id')) {

            //if( $this->productinformation->is_already_registered_product_sn($this->input->post('product_sn'),$this->input->post('color_id'), $id) ){
            if( $this->productinformation->is_already_registered_product_sn($this->input->post('product_sn'), $id) ){
                $this->session->set_flashdata('message', "产品编号已被登录。");
                //redirect('/admin/product_information/edit/'.$id, 'refresh');
            } else {

                $data['tile_category_id'] = $this->input->post('tile_category_id');
                $data['product_kind_id'] = $this->input->post('product_kind_id');
                //$data['color_id'] = $this->input->post('color_id');
                $data['product_type_no'] = $this->input->post('product_type_no');
                $data['product_sn'] = $this->input->post('product_sn');
                //$data['product_license_no'] = $this->input->post('product_license_no');
                $data['size_width'] = $this->input->post('size_width');
                $data['size_height'] = $this->input->post('size_height');
                $data['weight'] = $this->input->post('weight');
                $data['production_price'] = $this->input->post('production_price');
                $data['bulk_sale_price'] = $this->input->post('bulk_sale_price');
                $data['sale_price'] = $this->input->post('sale_price');
                $data['internet_price'] = $this->input->post('internet_price');
                $data['discount_price'] = $this->input->post('discount_price');
                $data['loading_fee'] = $this->input->post('loading_fee');
                $data['description'] = $this->input->post('product_description');

                $this->productinformation->update($data, $id);

                $is_photo_ids = $this->input->post('is_photo_ids');
                $is_photo_ids = explode(",", $is_photo_ids);

                $product = $this->productinformation->get($id);

                for ($i = 1; $i <= 5; $i++) {
                    $photo_id = "photo_" . $i;
                    $newFilename = $product->$photo_id;

                    if (!in_array($i, $is_photo_ids)) {
                        if ($newFilename != "" && file_exists($this->img_dir . $newFilename) && !is_dir(file_exists($this->img_dir . $newFilename))) {
                            unlink($this->img_dir . $newFilename);
                        }

                        $updatePhotoRecord = array(
                            'photo_' . $i => "",
                            'photo_' . $i . '_mimetype' => ""
                        );

                        $this->productinformation->update($updatePhotoRecord, $id);
                    }
                }

                for ($i = 1; $i <= 5; $i++) {
                    if ($_FILES['photo_' . $i]['name'] != "") {
                        $ext = substr(basename($_FILES['photo_' . $i]['name']), strpos(basename($_FILES['photo_' . $i]['name']), '.'), strlen(basename($_FILES['photo_' . $i]['name'])) - 1);
                        $newFilename = $id . "_" . $i . $ext;

                        if (move_uploaded_file($_FILES['photo_' . $i]['tmp_name'], $this->img_dir . $newFilename)) {
                            $updatePhotoRecord = array(
                                'photo_' . $i => $newFilename,
                                'photo_' . $i . '_mimetype' => $_FILES['photo_' . $i]['type']
                            );

                            $this->productinformation->update($updatePhotoRecord, $id);
                        }
                    }
                }

                redirect('/admin/product_information', 'refresh');
            }
        }

        for($i=1; $i<=5; $i++) {
            $photo = "photo_".$i;
            $photo_img = $photo."_img";
            $is_photo = $photo."_is_photo";

            if ($product->$photo != "") {
                $product->$photo_img = "../../../" . $this->img_dir . $product->$photo;
                $product->$is_photo = "Y";
            }
            else {
                $product->$photo_img = "../../../assets/admin/images/no_product.png";
                $product->$is_photo = "N";
            }
        }

        $already_ordered = $this->ordercustomer->get_all("id", array("product_id" => $id, "status_id <" => "6") );

        if(count($already_ordered)>0)
            $product->is_ordered = 'yes';
        else
            $product->is_ordered = 'no';

        $product_kinds = $this->productkind->get_all();
        //$colors = $this->color->get_all();
        $tile_category = $this->tilecategory->get_all();

        $data['product_kinds'] = $product_kinds;
        //$data['colors'] = $colors;
        $data['tile_category'] = $tile_category;
        $data['product'] = $product;

        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "products_information_edit";

        $this->load->view($this->_container, $data);
    }

    public function delete($id) {
        if(!is_numeric($id))
            redirect('/admin/product_information', 'refresh');

        $product = $this->productinformation->get($id);

        if(is_null($product) || !is_numeric($id))
            redirect('/admin/product_information', 'refresh');

        for($i=1; $i<=5; $i++){
            $fileName = "photo_".$i;
            $file = $product->$fileName;
            if ( file_exists($this->img_dir . $file) ){
                unlink($this->img_dir . $file);
            }
        }

        $this->productinformation->delete($id);

        redirect('/admin/product_information', 'refresh');
    }

    public function detail($id){
        if(!is_numeric($id))
            redirect('/admin/product_information', 'refresh');

        $product = $this->productinformation->get_one($id);

        if(is_null($product) || !is_numeric($id))
            redirect('/admin/product_information', 'refresh');

        $product = $product[0];

        for($i=1; $i<=5; $i++) {
            $photo = "photo_".$i;
            $photo_img = $photo."_img";
            $is_photo = $photo."_is_photo";

            if ($product->$photo != "") {
                $product->$photo_img = "../../../" . $this->img_dir . $product->$photo;
                $product->$is_photo = "Y";
            }
            else {
                $product->$photo_img = "../../../assets/admin/images/no_product.png";
                $product->$is_photo = "N";
            }
        }

        $data['product'] = $product;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "products_information_detail";

        $this->load->view($this->_container, $data);
    }

    public function getbysnorcolor(){

        $search_query = $this->input->get('q');
        $page = $this->input->get('page');

        $product_informations = $this->productinformation->get_by_sn_or_color($search_query);
        $data = array(
            "total_count" => count($product_informations),
            "items" => $product_informations
        );
        echo json_encode($data);
    }

}
