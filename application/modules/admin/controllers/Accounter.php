<?php

class Accounter extends Admin_Controller {

    function __construct() {
        parent::__construct();

        /*if (!$this->acl->hasPermission("admin","accounter") ) {
            $this->session->set_flashdata('message', "对不起，您没有权限进入这个页面。");
            redirect('/admin/dashboard', 'refresh');
        }*/

        $this->load->model(array('admin/orderpaymenthistory'));
        $this->load->model(array('admin/ordercustomer'));
        $this->load->model(array('admin/bank'));
        $this->load->model(array('admin/paymenttype'));
        $this->load->model(array('admin/withdrawhistory'));
        $this->load->model(array('admin/deposithistory'));
    }

    public function index() {

    }

    public function orderpayments(){
        $payments_history = $this->orderpaymenthistory->get_payments_history();

        $data['payment_history'] = $payments_history;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "accounter_orders_payment_history";

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
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "accounter_orders_payment_detail";

        $this->load->view($this->_container, $data);
    }

    public function registorderpayment(){
        $unprocessed_orders = $this->ordercustomer->get_orders_not_processed_yet();
        $banks = $this->bank->get_all();

        $data['unprocessed_orders'] = $unprocessed_orders;
        $data['banks'] = $banks;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "accounter_regist_order_payment";

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
            $data['description'] = $this->input->post('description');
            $data['creator_id'] = $this->logged_ind_user->id;
            $this->orderpaymenthistory->insert($data);

            redirect('/admin/accounter/regist_order_payment', 'refresh');
        } else if($this->input->post('history_id')){
            $history_id = $this->input->post('history_id');

            $data['pay_confirm_status'] = $this->input->post('confirm_status');
            $data['confirmer_id'] = $this->logged_ind_user->id;

            $this->orderpaymenthistory->update($data, $history_id);

            if($data['pay_confirm_status'] == 'yes'){
                $order_history = $this->orderpaymenthistory->get($history_id);
                $bank = $this->bank->get($order_history->receiver_bank);

                $bank_data['balance'] = $bank->balance + $order_history->amount;
                $this->bank->update($bank_data, $order_history->receiver_bank);
            }

            redirect('/admin/accounter/order_payments', 'refresh');
        }
    }

    public function depositpaymenttypelist(){
        $types = $this->paymenttype->get_all("*", array("kind"=>'deposit'));

        $data['types'] = $types;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "deposit_payment_type_list";
        $this->load->view($this->_container, $data);
    }

    public function depositpaymenttypecreate(){
        if ($this->input->post('type_name')) {
            $data['type_name'] = $this->input->post('type_name');
            $this->paymenttype->insert($data);

            redirect('/admin/accounter/deposit_payment_type_list', 'refresh');
        }

        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "deposit_payment_type_create";
        $this->load->view($this->_container, $data);

    }

    public function depositpaymenttypeedit($id){
        if ($this->input->post('type_name')) {
            $data['type_name'] = $this->input->post('type_name');
            $this->paymenttype->update($data, $id);

            redirect('/admin/accounter/deposit_payment_type_list', 'refresh');
        }

        $type = $this->paymenttype->get($id);
        if(is_null($type) || !is_numeric($id))
            redirect('/admin/accounter/deposit_payment_type_list', 'refresh');

        $data['type'] = $type;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "deposit_payment_type_edit";
        $this->load->view($this->_container, $data);
    }

    public function depositpaymenttypedelete($id){
        if(!is_numeric($id))
            redirect('/admin/accounter/deposit_payment_type_list', 'refresh');

        $this->paymenttype->delete($id);

        redirect('/admin/accounter/deposit_payment_type_list', 'refresh');
    }

    public function withdrawpaymenttypelist(){
        $types = $this->paymenttype->get_all("*", array("kind"=>'withdraw'));

        $data['types'] = $types;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "withdraw_payment_type_list";
        $this->load->view($this->_container, $data);
    }

    public function withdrawpaymenttypecreate(){
        if ($this->input->post('type_name')) {
            $data['type_name'] = $this->input->post('type_name');
            $data['kind'] = 'withdraw';
            $this->paymenttype->insert($data);

            redirect('/admin/accounter/withdraw_payment_type_list', 'refresh');
        }

        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "withdraw_payment_type_create";
        $this->load->view($this->_container, $data);

    }

    public function withdrawpaymenttypeedit($id){
        if ($this->input->post('type_name')) {
            $data['type_name'] = $this->input->post('type_name');
            $this->paymenttype->update($data, $id);

            redirect('/admin/accounter/withdraw_payment_type_list', 'refresh');
        }

        $type = $this->paymenttype->get($id);
        if(is_null($type) || !is_numeric($id))
            redirect('/admin/accounter/withdraw_payment_type_list', 'refresh');

        $data['type'] = $type;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "withdraw_payment_type_edit";
        $this->load->view($this->_container, $data);
    }

    public function withdrawpaymenttypedelete($id){
        if(!is_numeric($id))
            redirect('/admin/accounter/withdraw_payment_type_list', 'refresh');

        $this->paymenttype->delete($id);

        redirect('/admin/accounter/withdraw_payment_type_list', 'refresh');
    }

    public function withdrawlist(){
        $histories = $this->withdrawhistory->get_withdraw_history();

        $data['histories'] = $histories;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "withdraw_list";
        $this->load->view($this->_container, $data);
    }

    public function withdrawcreate(){
        if ($this->input->post('bank_id')) {
            $data['bank_id'] = $this->input->post('bank_id');
            $data['withdraw_amount'] = $this->input->post('withdraw_amount');
            $data['payment_type_id'] = $this->input->post('payment_type_id');
            $data['description'] = $this->input->post('description');
            $data['join_fee_user_id'] = $this->input->post('deposit_user_id');
            $user_id = $this->input->post('deposit_user_id');

            $data['reg_date'] = date("Y-m-d H:i:s");
            $this->withdrawhistory->insert($data);

            $bank = $this->bank->get($data['bank_id']);
            $new_balance = $bank->balance - $data['withdraw_amount'];
            $bank_update = array('balance'=>$new_balance);
            $this->bank->update($bank_update, $data['bank_id']);

            if($user_id >0) {
                $user_data = array("join_fee" => 0);
                $this->ion_auth->update($user_id, $user_data);
            }

            redirect('/admin/accounter/withdraw_list', 'refresh');
        }

        $user_in_group = array(2,7);
        $agencies = $this->ion_auth->users($user_in_group)->result();

        $data['banks'] = $this->bank->get_all();
        $data['agencies'] = $agencies;
        $data['payment_types'] = $this->paymenttype->get_all('*', array('kind'=>'withdraw'));

        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "withdraw_create";
        $this->load->view($this->_container, $data);
    }

    public function withdrawedit($id){
        $withdraw_item = $this->withdrawhistory->get_one($id);

        if(is_null($withdraw_item) || !is_numeric($id))
            redirect('/admin/accounter/withdraw_list', 'refresh');

        $withdraw = $withdraw_item[0];

        if ($this->input->post('bank_id')) {
            $data['bank_id'] = $this->input->post('bank_id');
            $data['withdraw_amount'] = $this->input->post('withdraw_amount');
            $data['payment_type_id'] = $this->input->post('payment_type_id');
            $data['description'] = $this->input->post('description');
            $data['join_fee_user_id'] = $this->input->post('deposit_user_id');
            $user_id = $this->input->post('deposit_user_id');
            $this->withdrawhistory->update($data, $id);

            $org_bank = $this->bank->get($withdraw->bank_id);
            $new_balance = $org_bank->balance + $withdraw->withdraw_amount;
            $bank_update = array('balance'=>$new_balance);
            $this->bank->update($bank_update, $withdraw->bank_id);

            $bank = $this->bank->get($data['bank_id']);
            $new_balance = $bank->balance - $data['withdraw_amount'];
            $bank_update = array('balance'=>$new_balance);
            $this->bank->update($bank_update, $data['bank_id']);

            if($data['join_fee_user_id'] >0) {
                $user_data = array("join_fee" => 0);
                $this->ion_auth->update($user_id, $user_data);
            }

            redirect('/admin/accounter/withdraw_list', 'refresh');
        }

        $user_in_group = array(2,7);
        $agencies = $this->ion_auth->users($user_in_group)->result();

        $data['banks'] = $this->bank->get_all();
        $data['agencies'] = $agencies;
        $data['withdraw'] = $withdraw;
        $data['payment_types'] = $this->paymenttype->get_all('*', array('kind'=>'withdraw'));

        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "withdraw_edit";
        $this->load->view($this->_container, $data);
    }

    public function withdrawdelete($id){
        if(!is_numeric($id))
            redirect('/admin/accounter/withdraw_list', 'refresh');

        $history_data = $this->withdrawhistory->get($id);

        $bank = $this->bank->get($history_data->bank_id);
        $new_balance = $bank->balance + $history_data->withdraw_amount;
        $bank_update = array('balance'=>$new_balance);
        $this->bank->update($bank_update, $history_data->bank_id);

        $this->withdrawhistory->delete($id);

        redirect('/admin/accounter/withdraw_list', 'refresh');
    }

    public function depositlist(){
        $histories = $this->deposithistory->get_deposit_history();

        $data['histories'] = $histories;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "deposit_list";
        $this->load->view($this->_container, $data);
    }

    public function depositcreate(){
        if ($this->input->post('bank_id')) {
            $data['bank_id'] = $this->input->post('bank_id');
            $data['withdraw_amount'] = $this->input->post('withdraw_amount');
            $data['payment_type_id'] = $this->input->post('payment_type_id');
            $data['description'] = $this->input->post('description');
            $data['user_id'] = $this->input->post('deposit_user_id');

            $data['reg_date'] = date("Y-m-d H:i:s");
            $this->deposithistory->insert($data);

            $bank = $this->bank->get($data['bank_id']);
            $new_balance = $bank->balance + $data['withdraw_amount'];
            $bank_update = array('balance'=>$new_balance);
            $this->bank->update($bank_update, $data['bank_id']);

            if($data['user_id'] >0) {
                $user_data = array("join_fee" => $data['withdraw_amount']);
                $this->ion_auth->update($data['user_id'], $user_data);
            }

            redirect('/admin/accounter/deposit_list', 'refresh');
        }

        $user_in_group = array(2,7);
        $agencies = $this->ion_auth->users($user_in_group)->result();

        $data['banks'] = $this->bank->get_all();
        $data['agencies'] = $agencies;
        $data['payment_types'] = $this->paymenttype->get_all("*", array('kind'=>'deposit'));

        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "deposit_create";
        $this->load->view($this->_container, $data);

    }

    public function depositedit($id){

        $deposit_item = $this->deposithistory->get_one($id);

        if(is_null($deposit_item) || !is_numeric($id))
            redirect('/admin/accounter/deposit_list', 'refresh');

        $deposit = $deposit_item[0];

        if ($this->input->post('bank_id')) {
            $data['bank_id'] = $this->input->post('bank_id');
            $data['withdraw_amount'] = $this->input->post('withdraw_amount');
            $data['payment_type_id'] = $this->input->post('payment_type_id');
            $data['description'] = $this->input->post('description');
            $data['user_id'] = $this->input->post('deposit_user_id');

            $this->deposithistory->update($data, $id);

            $org_bank = $this->bank->get($deposit->bank_id);
            $new_balance = $org_bank->balance - $deposit->withdraw_amount;
            $bank_update = array('balance'=>$new_balance);
            $this->bank->update($bank_update, $deposit->bank_id);

            $bank = $this->bank->get($data['bank_id']);
            $new_balance = $bank->balance + $data['withdraw_amount'];
            $bank_update = array('balance'=>$new_balance);
            $this->bank->update($bank_update, $data['bank_id']);

            if($data['user_id'] >0) {
                $user_data = array("join_fee" => $data['withdraw_amount']);
                $this->ion_auth->update($data['user_id'], $user_data);
            }

            redirect('/admin/accounter/deposit_list', 'refresh');
        }

        $user_in_group = array(2,7);
        $agencies = $this->ion_auth->users($user_in_group)->result();

        $data['banks'] = $this->bank->get_all();
        $data['agencies'] = $agencies;
        $data['deposit'] = $deposit;
        $data['payment_types'] = $this->paymenttype->get_all("*", array('kind'=>'deposit'));

        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "deposit_edit";
        $this->load->view($this->_container, $data);

    }

    public function depositdelete($id){
        if(!is_numeric($id))
            redirect('/admin/accounter/deposit_list', 'refresh');

        $history_data = $this->deposithistory->get($id);

        $bank = $this->bank->get($history_data->bank_id);
        $new_balance = $bank->balance - $history_data->withdraw_amount;
        $bank_update = array('balance'=>$new_balance);
        $this->bank->update($bank_update, $history_data->bank_id);

        $this->deposithistory->delete($id);

        redirect('/admin/accounter/deposit_list', 'refresh');
    }
}
