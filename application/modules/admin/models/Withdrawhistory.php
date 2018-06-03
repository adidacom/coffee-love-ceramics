<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class WithdrawHistory extends MY_Model {

    protected $table_name = 'tbl_withdraw_history';

    public function __construct() {
        parent::__construct();
    }

    public function get_by_order_id($id){
        $query = $this->db->select('tp.*, tpi.product_sn, mpk.kind_name, mc.name as color_name, mos.status_name, u.nickname as creator_name, u1.nickname as confirmer_name')
            ->join('tbl_orders_customer as toc', 'tp.order_id=toc.id')
            ->join('tbl_products_informations as tpi', 'toc.product_id=tpi.id')
            ->join('mst_product_kinds as mpk', 'mpk.id=tpi.product_kind_id', 'left')
            ->join('mst_colors as mc', 'mc.id=tpi.color_id', 'left')
            ->join('mst_order_status as mos', 'mos.id=toc.status_id', 'left')
            ->join('users as u', 'u.id=tp.creator_id', 'left')
            ->join('users as u1', 'u1.id=tp.confirmer_id', 'left')
            ->order_by('id', 'asc')
            ->where("order_id", $id)
            ->get($this->table_name . " as tp");

        return $query->result();
    }

    public function get_withdraw_history(){
        $query = $this->db->select('twh.*, mb.bank_name, mb.bank_account_no, mpp.type_name')
            ->join('mst_banks as mb', 'twh.bank_id=mb.id')
            ->join('mst_payment_types as mpp', 'twh.payment_type_id=mpp.id', 'left')
            ->order_by('twh.reg_date', 'asc')
            ->get($this->table_name . " as twh");

        return $query->result();
    }

    public function get_one($id){
        $query = $this->db->select('twh.*, mb.bank_name, mb.bank_account_no, mpp.type_name')
            ->join('mst_banks as mb', 'twh.bank_id=mb.id')
            ->join('mst_payment_types as mpp', 'twh.payment_type_id=mpp.id', 'left')
            ->order_by('twh.reg_date', 'asc')
            ->where("twh.id", $id)
            ->get($this->table_name . " as twh");

        return $query->result();
    }

    public function get_sum_groupby_paymenttypes_by_bank($bank_id){
        $query = $this->db->select("id,  type_name, (SELECT IFNULL(SUM(withdraw_amount),0) FROM tbl_withdraw_history WHERE payment_type_id = mpt.id AND bank_id=".$bank_id." ) AS ordered_sum")
            ->where("kind",'withdraw')
            ->get('mst_payment_types as mpt');

        return $query->result();
    }

}
