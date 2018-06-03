<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class OrderPaymentHistory extends MY_Model {

    protected $table_name = 'tbl_orders_payment_history';

    public function __construct() {
        parent::__construct();
    }

    public function get_by_order_id($id){
        //$query = $this->db->select('tp.*, tpi.product_sn, mpk.kind_name, mc.name as color_name, mos.status_name, u.nickname as creator_name, u1.nickname as confirmer_name')
        $query = $this->db->select('tp.*, tpi.product_sn, mpk.kind_name, mos.status_name, u.nickname as creator_name, u1.nickname as confirmer_name')
            ->join('tbl_orders_customer as toc', 'tp.order_id=toc.id')
            ->join('tbl_products_informations as tpi', 'toc.product_id=tpi.id')
            ->join('mst_product_kinds as mpk', 'mpk.id=tpi.product_kind_id', 'left')
            //->join('mst_colors as mc', 'mc.id=tpi.color_id', 'left')
            ->join('mst_order_status as mos', 'mos.id=toc.status_id', 'left')
            ->join('users as u', 'u.id=tp.creator_id', 'left')
            ->join('users as u1', 'u1.id=tp.confirmer_id', 'left')
            ->order_by('id', 'asc')
            ->where("order_id", $id)
            ->get($this->table_name . " as tp");

        return $query->result();
    }

    public function get_payments_history(){
        $query = $this->db->select('tp.*, mos.status_name, u.nickname as creator_name, u1.nickname as confirmer_name, mb.bank_name as receiver_bank_name, mb.bank_account_no')
            ->join('tbl_orders_customer as toc', 'tp.order_id=toc.id')
            //->join('tbl_products_informations as tpi', 'toc.product_id=tpi.id')
            //->join('mst_product_kinds as mpk', 'mpk.id=tpi.product_kind_id', 'left')
            //->join('mst_colors as mc', 'mc.id=tpi.color_id', 'left')
            ->join('mst_order_status as mos', 'mos.id=toc.status_id', 'left')
            ->join('mst_banks as mb', 'mb.id=tp.receiver_bank', 'left')
            ->join('users as u', 'u.id=tp.creator_id', 'left')
            ->join('users as u1', 'u1.id=tp.confirmer_id', 'left')
            ->order_by('order_id', 'asc')
            ->order_by('paid_date', 'asc')
            ->get($this->table_name . " as tp");

        return $query->result();
    }

    public function get_sum_by_bank($bank_id){
        $query = $this->db->select("SUM(amount) as ordered_sum")
            ->where("pay_confirm_status","yes")
            ->where("receiver_bank",$bank_id)
            ->get($this->table_name);

        return $query->result();
    }

}
