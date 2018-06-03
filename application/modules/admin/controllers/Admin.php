<?php

class Admin extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model(array('admin/orderpaymenthistory'));
        $this->load->model(array('admin/ordercustomer'));
        $this->load->model(array('admin/bank'));
        $this->load->model(array('admin/paymenttype'));
        $this->load->model(array('admin/withdrawhistory'));
        $this->load->model(array('admin/deposithistory'));
    }

    public function index() {
        $banks = $this->bank->get_all();
        $deposit_payment_types = $this->paymenttype->get_all("*", array("kind"=>'deposit'));
        $withdraw_payment_types = $this->paymenttype->get_all("*", array("kind"=>'withdraw'));

        foreach($banks as $k=>$bank){
            $order_sum = $this->orderpaymenthistory->get_sum_by_bank($bank['id']);
            $order_sum = $order_sum[0]->ordered_sum;
            $banks[$k]['ordered_sum'] = $order_sum;

            $bank_deposited_sum = $this->deposithistory->get_sum_groupby_paymenttypes_by_bank($bank['id']);
            $bank_withdrawed_sum = $this->withdrawhistory->get_sum_groupby_paymenttypes_by_bank($bank['id']);

            $banks[$k]['deposit_sum'] = $bank_deposited_sum;
            $banks[$k]['withdraw_sum'] = $bank_withdrawed_sum;

        }

        $total_ordered_quantity = $this->ordercustomer->get_total_quantity();
        if($total_ordered_quantity == "")
            $total_ordered_quantity = 0;

        $data['banks'] = $banks;
        $data['total_ordered_quantity'] = $total_ordered_quantity;
        $data['aggencies_user_cnt'] = count($this->ion_auth->users(array(2,7))->result());
        $data['business_user_cnt'] = count($this->ion_auth->users(array(5))->result());
        $data['consumer_user_cnt'] = count($this->ion_auth->users(array(4))->result());
        $data['total_users_cnt'] = count($this->ion_auth->users()->result());

        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "dashboard";
        $this->load->view($this->_container, $data);
    }

}
