<?php

class OrdersCustomer extends Admin_Controller {

    function __construct() {
        parent::__construct();

        /*if (!$this->acl->hasPermission("admin","orders_customer") ) {
            $this->session->set_flashdata('message', "对不起，您没有权限进入这个页面。");
            redirect('/admin/dashboard', 'refresh');
        }*/

        $this->load->model(array('admin/ordercustomer'));
        $this->load->model(array('admin/ordercustomerhistory'));
        $this->load->model(array('admin/orderpaymenthistory'));
        $this->load->model(array('admin/userbonushistory'));
        $this->load->model(array('admin/productkind'));
        $this->load->model(array('admin/color'));
        $this->load->model(array('admin/unit'));
        $this->load->model(array('admin/orderstatus'));
        $this->load->model(array('admin/ordertype'));
        $this->load->model(array('admin/productinformation'));
        $this->load->model(array('admin/orderstransporter'));
    }

    public function index() {
        $user_type = $this->logged_in_role;
        $user_id = $this->logged_ind_user->id;

        $orders_customer = $this->ordercustomer->get_all_orders($user_id, $user_type);

        $data['orders_customer'] = $orders_customer;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "orders_customer_list";
        $this->load->view($this->_container, $data);
    }

    public function create() {

        if ($this->input->post('product_information_id')) {
            $data['product_id'] = $this->input->post('product_information_id');
            $data['quantity'] = $this->input->post('quantity');
            $data['sale_price'] = $this->input->post('sale_price');
            $data['customer_name'] = $this->input->post('customer_name');
            $data['shipping_address'] = $this->input->post('shipping_address');
            $data['loading_fee'] = $this->input->post('loading_fee');
            $data['customer_phone'] = $this->input->post('customer_phone');
            $data['deposit_bank'] = $this->input->post('deposit_bank');
            $data['deposit_amount'] = $this->input->post('deposit_amount');
            $data['deposit_date'] = $this->input->post('deposit_date');
            $data['deposit_time'] = $this->input->post('deposit_time');
            $data['deposit_item'] = $this->input->post('deposit_item');
            $data['status_id'] = $this->input->post('status_id');
            $data['order_date'] = date("Y-m-d H:i:s");
            $data['user_id'] = $this->logged_ind_user->id;

            $this->ordercustomer->insert($data);

            redirect('/admin/orders_customer', 'refresh');
        }

        $product_informations = $this->productinformation->get_all();
        $order_status = $this->orderstatus->get_all();

        $data['product_informations'] = $product_informations;
        $data['order_status'] = $order_status;

        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "orders_customer_create";
        $this->load->view($this->_container, $data);
    }

    public function salercreate() {

        if (!$this->acl->hasPermission("admin","orders_customer/saler_create") ) {
            $this->session->set_flashdata('message', "对不起，您没有权限进入这个页面。");
            redirect('/admin/dashboard', 'refresh');
        }

        if ($this->input->post('product_information_id')) {
            $data['product_id'] = $this->input->post('product_information_id');
            $data['color_id'] = $this->input->post('color_id');
            $data['quantity'] = $this->input->post('box_quantity') * $this->input->post('tiles_per_box_quantity');
            $data['sale_price'] = $this->input->post('item_price');
            $data['total_price'] = $this->input->post('total_price');
            $data['box_quantity'] = $this->input->post('box_quantity');
            $data['tiles_per_box_quantity'] = $this->input->post('tiles_per_box_quantity');
            //$data['customer_name'] = $this->input->post('customer_name');
            //$data['customer_name_70'] = $this->input->post('customer_name');
            //$data['shipping_address'] = $this->input->post('shipping_address');
            /*$data['loading_fee'] = $this->input->post('loading_fee');
            $data['customer_phone'] = $this->input->post('customer_phone');
            $data['deposit_bank'] = $this->input->post('deposit_bank');
            $data['deposit_bank_70'] = $this->input->post('deposit_bank');
            $data['deposit_amount'] = $this->input->post('deposit_amount');
            $data['deposit_amount_70'] = $this->input->post('deposit_amount');
            $data['deposit_date'] = $this->input->post('deposit_date');
            $data['deposit_date_70'] = $this->input->post('deposit_date');
            $data['deposit_time'] = $this->input->post('deposit_time');
            $data['deposit_time_70'] = $this->input->post('deposit_time');
            $data['deposit_item'] = $this->input->post('deposit_item');
            $data['deposit_item_70'] = $this->input->post('deposit_item');*/
            $data['order_type_id'] = $this->input->post('order_type_id');
            //$data['status_id'] = $this->input->post('status_id');
            $data['status_id'] = 2;
            $data['order_date'] = date("Y-m-d H:i:s");


            // check retailer relation
            /*$this->load->model(array('admin/user'));
            $customer = $this->user->get_user_by_phone($data['customer_phone']);
            if(is_null($customer)){

                $phone = $data['customer_phone'];
                $password = $data['customer_phone'];
                $email = "";

                $additional_data = array();
                $additional_data['nickname'] = $data['customer_name'];

                $parent = $this->user->get_user_by_phone($this->input->post('retailer_phone'));

                if(!is_null($parent))
                    $additional_data['parent_id'] = $parent->id;

                if($data['order_type_id'] == 2)
                    $group_id = array(2);
                else if ($data['order_type_id'] == 3)
                    $group_id = array(5);
                else if ($data['order_type_id'] == 4)
                    $group_id = array(4);

                $user_id = $this->ion_auth->register($phone, $password, $email, $additional_data, $group_id);

                $data['user_id'] = $user_id;

            } else
                $data['user_id'] = $customer->id;*/

            $data['user_id'] = $this->input->post('ordered_user_id');
            $data['creator_id'] = $this->logged_ind_user->id;
            $this->ordercustomer->insert($data);

            //redirect('/admin/orders_customer/saler_create', 'refresh');
        }

        $product_informations = $this->productinformation->get_all();
        $order_type = $this->ordertype->get_saler_order_type();
        $order_status = $this->orderstatus->get_all();

        $data['product_informations'] = $product_informations;
        $data['order_status'] = $order_status;
        $data['order_type'] = $order_type;

        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "orders_customer_saler_create";
        $this->load->view($this->_container, $data);
    }

    public function edit($id) {

        $order_customer = $this->ordercustomer->get_one($id);

        if(is_null($order_customer) || !is_numeric($id))
            redirect('/admin/orders_customer', 'refresh');

        $order_customer = $order_customer[0];

        if ($this->input->post('product_information_id')) {
            $data['product_id'] = $this->input->post('product_information_id');
            $data['quantity'] = $this->input->post('box_quantity') * $this->input->post('tiles_per_box_quantity');
            $data['box_quantity'] = $this->input->post('box_quantity');
            $data['tiles_per_box_quantity'] = $this->input->post('tiles_per_box_quantity');
            $data['sale_price'] = $this->input->post('item_price');
            $data['total_price'] = $this->input->post('total_price');
            $data['customer_name'] = $this->input->post('customer_name');
            $data['customer_name_70'] = $this->input->post('customer_name_70');
            $data['shipping_address'] = $this->input->post('shipping_address');
            $data['customer_phone'] = $this->input->post('customer_phone');
            $data['deposit_bank'] = $this->input->post('deposit_bank');
            $data['deposit_bank_70'] = $this->input->post('deposit_bank_70');
            $data['deposit_amount'] = $this->input->post('deposit_amount');
            $data['deposit_amount_70'] = $this->input->post('deposit_amount_70');
            $data['deposit_date'] = $this->input->post('deposit_date');
            $data['deposit_date_70'] = $this->input->post('deposit_date_70');
            $data['deposit_time'] = $this->input->post('deposit_time');
            $data['deposit_time_70'] = $this->input->post('deposit_time_70');
            $data['deposit_item'] = $this->input->post('deposit_item');
            $data['deposit_item_70'] = $this->input->post('deposit_item_70');
            $data['status_id'] = $this->input->post('status_id');

            $this->ordercustomer->update($data, $id);

            $history_data['status_id'] = $data['status_id'];
            $history_data['order_id'] = $id;
            $history_data['user_id'] = $this->logged_ind_user->id;
            $history_data['modify_date'] = date("Y-m-d H:i:s");

            $order_status_already_changed = $this->ordercustomerhistory->is_order_status_already_changed($history_data['order_id'], $history_data['status_id']);

            if ( !$order_status_already_changed )
                $order_history_id = $this->ordercustomerhistory->insert($history_data);
            else {
                $order_history = $this->ordercustomerhistory->get_order_history_by_orderid_and_status($history_data['order_id'], $history_data['status_id']);
                $order_history_id = $order_history->id;
            }

            $order_user = $this->ion_auth->user($order_customer->user_id)->row();

            if( $this->input->post('status_id') == 3 ){
                if ( !$order_status_already_changed ) {
                    $new_balance = $order_user->balance + $this->input->post('deposit_amount');
                    $user_data['balance'] = $new_balance;

                    $this->ion_auth->update($order_customer->user_id, $user_data);

                    // update the product stock
                    $product_information = $this->productinformation->get($data['product_id']);
                    $new_stock = $product_information->stock - $data['quantity'];
                    $this->productinformation->update(array("stock"=>$new_stock), $data['product_id']);
                }
            }

            if( $this->input->post('status_id') == 5 ){
                if ( !$order_status_already_changed ) {
                    $new_balance = $order_user->balance + $this->input->post('deposit_amount_70');
                    $user_data['balance'] = $new_balance;

                    $this->ion_auth->update($order_customer->user_id, $user_data);
                }
            }

            if( $this->input->post('status_id') == 8 ){

                if ( !$order_status_already_changed ) {

                    //$total_deposit_amount = $order_customer->deposit_amount + $order_customer->deposit_amount_70;
                    $total_deposit_amount = $this->input->post('total_price');

                    // update the user balance
                    $new_balance = $order_user->balance - $total_deposit_amount;
                    $user_data['balance'] = $new_balance;

                    $this->ion_auth->update($order_customer->user_id, $user_data);

                    // update the product stock
                    /*$product_information = $this->productinformation->get($data['product_id']);
                    $new_stock = $product_information->stock - $data['quantity'];
                    $this->productinformation->update(array("stock"=>$new_stock), $data['product_id']);*/

                    // update the user bonuses
                    $business_accounter_bonus_ratio_level_1 = 0.03;
                    $business_accounter_bonus_ratio_level_2 = 0.01;
                    $cosumer_bonus_ratio_level_1 = 0.1;
                    $cosumer_bonus_ratio_level_2 = 0.06;

                    // Calculat the bonus of consumer and accounter
                    if($order_user->parent_id != 0) {

                        // calculate the parent bonus
                        $parent = $this->ion_auth->user($order_user->parent_id)->row();
                        $parent_group = $this->ion_auth->get_users_groups($parent->id)->row();
                        $bonus_amount_level_1 = 0;

                        if($parent_group->id == 4){// parent is consumer case
                            $bonus_amount_level_1 = $total_deposit_amount * $cosumer_bonus_ratio_level_1;
                        } else if($parent_group->id == 5){ // parent is business accounter case
                            $bonus_amount_level_1 = $total_deposit_amount * $business_accounter_bonus_ratio_level_1;
                        }

                        if($bonus_amount_level_1 > 0){
                            $new_bonus_amount = $parent->bonus + $bonus_amount_level_1;
                            $user_bonus_data_level_1['bonus'] = $new_bonus_amount;
                            $this->ion_auth->update($parent->id, $user_bonus_data_level_1);

                            $bonus_data = array(
                                "user_id" => $parent->id,
                                "amount" => $bonus_amount_level_1,
                                "order_history_id" => $order_history_id
                            );
                            $this->userbonushistory->insert($bonus_data);
                        }

                        // calculate the parent of parent bonus
                        if($parent->parent_id != 0){
                            $parent_parent = $this->ion_auth->user($parent->parent_id)->row();
                            $parent_parent_group = $this->ion_auth->get_users_groups($parent_parent->id)->row();
                            $bonus_amount_level_2 = 0;

                            if($parent_parent_group->id == 4){
                                $bonus_amount_level_2 = $total_deposit_amount * $cosumer_bonus_ratio_level_2;
                            } else if($parent_parent_group->id == 5){
                                $bonus_amount_level_2 = $total_deposit_amount * $business_accounter_bonus_ratio_level_2;
                            }

                            if($bonus_amount_level_2 > 0){
                                $new_bonus_amount = $parent_parent->bonus + $bonus_amount_level_2;
                                $user_bonus_data_level_2['bonus'] = $new_bonus_amount;
                                $this->ion_auth->update($parent_parent->id, $user_bonus_data_level_2);

                                $bonus_data = array(
                                    "user_id" => $parent_parent->id,
                                    "amount" => $bonus_amount_level_2,
                                    "order_history_id" => $order_history_id
                                );
                                $this->userbonushistory->insert($bonus_data);
                            }
                        }
                    }

                    // Calculate the benefits of agency and sub-agency
                    $agency_benefits = ($data['sale_price'] - $product_information->sale_price) - $product_information->loading_fee - $data['sale_price']*0.1 - $data['sale_price']*0.06;

                    $sub_agency_benefits = $agency_benefits * 0.92;
                    $sub_agency_parent_benefits = $agency_benefits * 0.08;
                    $order_user_group = $this->ion_auth->get_users_groups($order_user->id)->row();

                    if($order_user_group->id == 2){
                        // ordered user is agency case
                        $agency_benefit_data['benefit'] = $order_user->benefit + $agency_benefits;
                        $this->ion_auth->update($order_user->id, $agency_benefit_data);

                        $bonus_data = array(
                            "user_id" => $order_user->id,
                            "amount" => $agency_benefits,
                            "order_history_id" => $order_history_id
                        );
                        $this->userbonushistory->insert($bonus_data);

                    } else if($order_user_group->id == 7){
                        // ordered user is sub agency case
                        $sub_agency_benefit_data['benefit'] = $order_user->benefit + $sub_agency_benefits;
                        $this->ion_auth->update($order_user->id, $sub_agency_benefit_data);

                        $bonus_data = array(
                            "user_id" => $order_user->id,
                            "amount" => $sub_agency_benefits,
                            "order_history_id" => $order_history_id
                        );
                        $this->userbonushistory->insert($bonus_data);

                        if($order_user->parent_id != 0) {
                            $parent_of_sub_agency = $this->ion_auth->user($order_user->parent_id)->row();
                            $parent_of_sub_agency_group = $this->ion_auth->get_users_groups($parent_of_sub_agency->id)->row();
                            if($parent_of_sub_agency_group->id == 2){
                                $parent_of_sub_agency_benefit_data['benefit'] = $parent_of_sub_agency->benefit + $sub_agency_parent_benefits;
                                $this->ion_auth->update($parent_of_sub_agency->id, $parent_of_sub_agency_benefit_data);

                                $bonus_data = array(
                                    "user_id" => $parent_of_sub_agency->id,
                                    "amount" => $sub_agency_parent_benefits,
                                    "order_history_id" => $order_history_id
                                );
                                $this->userbonushistory->insert($bonus_data);

                            }
                        }
                    }
                }
            }

            redirect('/admin/orders_customer', 'refresh');
        }

        //$order_status = $this->orderstatus->get_all();
        $product_informations = $this->productinformation->get_all();

        $order_status_checked = false;

        $is_prepay_ordered = $this->ordercustomerhistory->is_order_status_already_changed($id, 3);
        $is_finalpay_ordered = $this->ordercustomerhistory->is_order_status_already_changed($id, 5);

        if ( !$is_prepay_ordered && !$is_finalpay_ordered ){
            if ($this->logged_in_role == "accounter") {
                $order_status = array(
                    array("id" => 2, "status_name" => '待支付预付款'),
                    array("id" => 3, "status_name" => '已支付预付款'),
                );
            } else {
                $order_status = array(
                    array("id" => 1, "status_name" => '未支付'),
                    array("id" => 2, "status_name" => '待支付预付款'),
                    array("id" => 3, "status_name" => '已支付预付款'),
                    array("id" => 6, "status_name" => '撤销'),
                );
            }
        } else if ( $is_prepay_ordered && !$is_finalpay_ordered ){
            if ($this->logged_in_role == "accounter") {
                $order_status = array(
                    array("id" => 3, "status_name" => '已支付预付款'),
                    array("id" => 4, "status_name" => '带支付尾款'),
                    array("id" => 5, "status_name" => '已支付尾款'),
                );
            } else {
                $order_status = array(
                    array("id" => 3, "status_name" => '已支付预付款'),
                    array("id" => 4, "status_name" => '带支付尾款'),
                    array("id" => 5, "status_name" => '已支付尾款'),
                    array("id" => 6, "status_name" => '撤销')
                );
            }
        } else if ( $is_prepay_ordered && $is_finalpay_ordered ){
            if ($this->logged_in_role == "accounter"){
                $order_status = array(
                    array("id" => 5, "status_name" => '已支付尾款'),
                    array("id" => 7, "status_name" => '带发货'),
                    array("id" => 8, "status_name" => '已发货'),
                );
            } else {
                $order_status = array(
                    array("id" => 5, "status_name" => '已支付尾款'),
                    array("id" => 7, "status_name" => '带发货'),
                    array("id" => 8, "status_name" => '已发货'),
                    array("id" => 6, "status_name" => '撤销')
                );
            }
        }

        if( $this->ordercustomerhistory->is_order_status_already_changed($id, 8) ){
            $order_status = array(
                array("id" => 8, "status_name" => '已发货'),
            );
        }

        $data['order_status'] = $order_status;
        $data['product_informations'] = $product_informations;

        $data['order_customer'] = $order_customer;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "orders_customer_edit";

        $this->load->view($this->_container, $data);
    }

    public function delete($id) {
        if($this->logged_in_role != "admin" && $this->logged_in_role != "accounter"){
            $this->session->set_flashdata('message', "对不起，您没有权限进入这个页面。");
            redirect('/admin/orders_customer', 'refresh');
        }

        if(!is_numeric($id))
            redirect('/admin/orders_customer', 'refresh');

        $this->ordercustomer->delete($id);

        redirect('/admin/orders_customer', 'refresh');
    }

    public function history($id){

        if(!is_numeric($id))
            redirect('/admin/orders_customer', 'refresh');

        $order_statuses = $this->orderstatus->get_all();

        $histories = array();
        foreach($order_statuses as $ind => $status){
            $status_history = $this->ordercustomerhistory->get_order_history_by_orderid_and_status($id, $status['id']);
            $histories[] = $status_history;
        }

        $order_customer = $this->ordercustomer->get_one($id);
        $order_customer = $order_customer[0];

        $data['order_customer'] = $order_customer;
        $data['order_statuses'] = $order_statuses;
        $data['histories'] = $histories;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "orders_customer_history";

        $this->load->view($this->_container, $data);
    }

    public function paymenthistory($id){

        if(!is_numeric($id))
            redirect('/admin/orders_customer', 'refresh');

        $payment_history = $this->orderpaymenthistory->get_by_order_id($id);

        $order_customer = $this->ordercustomer->get_one($id);
        $order_customer = $order_customer[0];

        $data['payment_history'] = $payment_history;
        $data['order_customer'] = $order_customer;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "orders_payment_history";

        $this->load->view($this->_container, $data);
    }

    public function registpaymenthistory(){
        if ($this->input->post('payer_name')) {
            $data['payer_name'] = $this->input->post('payer_name');
            $data['payer_bank'] = $this->input->post('payer_bank');
            $data['amount'] = $this->input->post('amount');
            $data['paid_date'] = $this->input->post('paid_date')." ".$this->input->post('paid_time');
            $data['paid_type'] = $this->input->post('paid_type');
            $data['receiver_bank'] = $this->input->post('receiver_bank');
            $data['order_id'] = $this->input->post('order_id');
            $data['creator_id'] = $this->logged_ind_user->id;
            $this->orderpaymenthistory->insert($data);

            redirect('/admin/orders_customer/payment_history/'.$data['order_id'], 'refresh');
        } else if($this->input->post('history_id')){
            $history_id = $this->input->post('history_id');
            $order_id = $this->input->post('order_id');

            $data['pay_confirm_status'] = $this->input->post('confirm_status');
            $data['confirmer_id'] = $this->logged_ind_user->id;

            $this->orderpaymenthistory->update($data, $history_id);

            redirect('/admin/orders_customer/payment_history/'.$order_id, 'refresh');
        }
    }

    public function getordersbytype(){

        $user_type = $this->logged_in_role;
        $user_id = $this->logged_ind_user->id;

        $type = $_REQUEST['order_type'];
        $aColumns = array( 'toc.id as id','mc.name as color_name','u.nickname as nickname', 'u.phone as phone', 'tpi.product_sn as product_sn', 'toc.quantity as quantity', 'toc.total_price as total_price', 'ROUND(toc.total_price * 0.3, 2) as prepayment', 'ROUND(toc.total_price*0.7, 2) as lastpayment', 'mos.status_name');
        $aColumnsReal = array( 'id', 'color_name', 'nickname', 'phone', 'product_sn', 'quantity', 'total_price', 'prepayment', 'lastpayment', 'status_name');
        $aColumnsSearch = array( 'toc.id', 'mc.name', 'u.nickname', 'u.phone', 'tpi.product_sn', 'toc.quantity', 'toc.total_price', 'mos.status_name' );

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "toc.id";

        /* DB table to use */
        $sTable = "tbl_orders_customer as toc LEFT JOIN mst_colors as mc ON(toc.color_id=mc.id) LEFT JOIN tbl_products_informations as tpi ON (toc.product_id=tpi.id) LEFT JOIN users as u ON (toc.user_id=u.id) LEFT JOIN mst_order_status as mos ON (toc.status_id=mos.id)";

        /*
         * Paging
         */
        $sLimit = "";
        if ( isset( $_REQUEST['iDisplayStart'] ) && $_REQUEST['iDisplayLength'] != '-1' )
        {
            $sLimit = "LIMIT ".intval( $_REQUEST['iDisplayStart'] ).", ".
                intval( $_REQUEST['iDisplayLength'] );
        }

        /*
         * Ordering
         */
        $sOrder = "";
        if ( isset( $_REQUEST['iSortCol_0'] ) )
        {
            $sOrder = "ORDER BY  ";
            for ( $i=0 ; $i<intval( $_REQUEST['iSortingCols'] ) ; $i++ )
            {
                if ( $_REQUEST[ 'bSortable_'.intval($_REQUEST['iSortCol_'.$i]) ] == "true" )
                {
                    $sOrder .= $aColumnsReal[ intval( $_REQUEST['iSortCol_'.$i] ) ].
                        ($_REQUEST['sSortDir_'.$i]==='asc' ? ' asc' : ' desc') .", ";
                }
            }

            $sOrder = substr_replace( $sOrder, "", -2 );
            if ( $sOrder == "ORDER BY " )
            {
                $sOrder = "";
            }
        }


        /*
         * Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */
        $sWhere = "";
        if ( isset($_REQUEST['sSearch']) && $_REQUEST['sSearch'] != "" )
        {
            $sWhere = "WHERE (";
            for ( $i=0 ; $i<count($aColumnsSearch) ; $i++ )
            {
                $sWhere .= $aColumnsSearch[$i]." LIKE '%". $_REQUEST['sSearch'] ."%' OR ";
            }
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }

        /* Individual column filtering */
        for ( $i=0 ; $i<count($aColumns) ; $i++ )
        {
            if ( isset($_REQUEST['bSearchable_'.$i]) && $_REQUEST['bSearchable_'.$i] == "true" && $_REQUEST['sSearch_'.$i] != '' )
            {
                if ( $sWhere == "" )
                {
                    $sWhere = "WHERE ";
                }
                else
                {
                    $sWhere .= " AND ";
                }
                $sWhere .= $aColumnsSearch[$i]." LIKE '%".$_REQUEST['sSearch_'.$i]."%' ";
            }
        }

        if($type != 0 ){
            if($sWhere != ""){
                if($type == 1)
                    $sWhere .= " AND order_type_id=".$type;
                else
                    $sWhere .= " AND order_type_id >= ".$type;
            }
            else {
                if($type == 1)
                    $sWhere .= "WHERE order_type_id=" . $type;
                else
                    $sWhere .= "WHERE order_type_id >=" . $type;
            }
        }

        if($user_type == 'saler'){
            if($sWhere != ""){
                $sWhere .= " AND creator_id = ".$user_id;
            }
            else {
                $sWhere .= "WHERE creator_id =" . $user_id;
            }
        }

        /*
         * SQL queries
         * Get data to display
         */
        $sQuery = "
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns)).", toc.product_id
		FROM   $sTable
		$sWhere
		$sOrder
		$sLimit
		";

        $rResult = $this->db->query($sQuery)->result_array();

        /* Data set length after filtering */
        $sQuery = "
		SELECT FOUND_ROWS()
	";
        $rResultFilterTotal = $this->db->query($sQuery)->result_array();
        $iFilteredTotal = $rResultFilterTotal[0]['FOUND_ROWS()'];

        /* Total data set length */
        $sQuery = "
		SELECT COUNT(".$sIndexColumn.") as tl
		FROM   $sTable
	";

        $rResultTotal = $this->db->query($sQuery)->result_array();
        $iTotal = $rResultTotal[0]['tl'];

        /*
         * Output
         */
        $output = array(
            "sEcho" => intval($_REQUEST['sEcho']),
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => array()
        );

        foreach ( $rResult as $aRow)
        {
			$rowId = $aRow['id'];
            $row = array();
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                if ($aColumnsReal[$i] == 'id' && ($this->logged_in_role == "admin" || $this->logged_in_role == "saler") ){
                    $aRow[ $aColumnsReal[$i] ] = '<a href="'.base_url('admin/orders_customer/edit/'.$aRow['id']).'">'.$aRow[ $aColumnsReal[$i] ].'</a>';
                }
                if ($aColumnsReal[$i] == "total_price" || $aColumnsReal[$i] == "prepayment" || $aColumnsReal[$i] == "lastpayment")
                    $aRow[ $aColumnsReal[$i] ] = number_format($aRow[ $aColumnsReal[$i] ],2);

                if($aColumnsReal[$i] == "product_sn"){
                    $aRow[ $aColumnsReal[$i] ] = '<a href="javascript:void(0)" onclick="showProductDetail(\''.$aRow['product_id'].'\')">'.$aRow[ $aColumnsReal[$i] ].'</a>';
                }

                $row[] = $aRow[ $aColumnsReal[$i] ];
            }

            $button_html = '<td>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">操作 <span class="caret"></span></button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="'. base_url('admin/orders_customer/history/'.$rowId) .'" class="dropdown-item">订单跟踪</a></li>
                                            <li><a href="'. base_url('admin/orders_customer/payment_history/'.$rowId) .'" class="dropdown-item">存款跟踪</a></li>';

            if($this->logged_in_role == "admin" || $this->logged_in_role == "accounter" ) {
                $button_html .= '<li><a href="'. base_url('admin/orders_customer/edit/'.$rowId) .'" class="dropdown-item">编辑</a></li>
                                 <li><a href="javascript:void(0)" class="" data-href="'. base_url('admin/orders_customer/delete/'.$rowId). '" data-toggle="modal" data-target="#confirm-delete">
                                        删除
                                    </a>
                                </li>';
            }

            $button_html .= '</ul></div></td>';

            $row[] = $button_html;

            $output['aaData'][] = $row;
        }

        echo json_encode( $output );
        return;
    }

    public function ordertransporterlist(){
        if($this->logged_in_role == "saler")
            $transporters = $this->orderstransporter->get_transporters($this->logged_ind_user->id);
        else
            $transporters = $this->orderstransporter->get_transporters();

        $data['transporters'] = $transporters;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "orders_transporter_list";
        $this->load->view($this->_container, $data);
    }

    public function ordertransportercreate() {

        if ($this->input->post('order_id')) {
            $data['order_id'] = $this->input->post('order_id');
            $data['transporter_name'] = $this->input->post('transporter_name');
            $data['transporter_phone'] = $this->input->post('transporter_phone');
            $data['transporter_card_no'] = $this->input->post('transporter_card_no');
            $data['transporter_car_no'] = $this->input->post('transporter_car_no');
            $data['quantity'] = $this->input->post('quantity');
            $data['creator_id'] = $this->logged_ind_user->id;

            $this->orderstransporter->insert($data);

            redirect('/admin/orders/order_transporter_create', 'refresh');
        } else if($this->input->post('sale_order_id')){
            $sale_order_id = $this->input->post('sale_order_id');
            $data['send_status'] = 'yes';

            $this->orderstransporter->update($data, $sale_order_id);

            // update the product stock
            $transporter_data = $this->orderstransporter->get_by_id($sale_order_id);
            $transporter_data = $transporter_data[0];

            $product_information = $this->productinformation->get($transporter_data->product_id);
            $new_stock = $product_information->stock - $transporter_data->quantity;
            $this->productinformation->update(array("stock"=>$new_stock), $transporter_data->product_id);

            redirect('/admin/orders/order_transporter_list', 'refresh');
        }

        $paid_orders = $this->ordercustomer->get_paid_orders();
        $data['paid_orders'] = $paid_orders;

        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "orders_transporter_create";
        $this->load->view($this->_container, $data);
    }

    public function getordertransporter($id){
        $order = $this->ordercustomer->get($id);
        $already_transporter_for_order = $this->orderstransporter->get_already_transported_for_order($id);

        if(is_null($already_transporter_for_order))
            $already_transported = 0;
        else
            $already_transported = $already_transporter_for_order;

        $limited_cnt = $order->quantity - $already_transported;

        echo json_encode(array("quantity"=>$order->quantity, "tiles_per_box_quantity"=>$order->tiles_per_box_quantity, "already_transported"=>$already_transported, "possible_quantity"=>$limited_cnt));
    }
}
