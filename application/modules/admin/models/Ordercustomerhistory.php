<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class OrderCustomerHistory extends MY_Model {

    protected $table_name = 'tbl_orders_customer_history';

    public function __construct() {
        parent::__construct();
    }

    public function get_by_order_id($id){
        $query = $this->db->select('tp.*, tpi.product_sn, mpk.kind_name, mc.name as color_name, mos.status_name, u.username')
            ->join('tbl_orders_customer as toc', 'tp.order_id=toc.id')
            ->join('tbl_products_informations as tpi', 'toc.product_id=tpi.id')
            ->join('mst_product_kinds as mpk', 'mpk.id=tpi.product_kind_id', 'left')
            ->join('mst_colors as mc', 'mc.id=tpi.color_id', 'left')
            ->join('mst_order_status as mos', 'mos.id=toc.status_id', 'left')
            ->join('users as u', 'u.id=tp.user_id', 'left')
            ->order_by('id', 'desc')
            ->where("order_id", $id)
            ->get($this->table_name . " as tp");

        return $query->result();
    }

    public function is_order_status_already_changed($order_id, $status_id){
        $conditions = array("order_id" => $order_id, "status_id" => $status_id);

        $order_history = $this->get_all("*", $conditions);

        if (count($order_history) > 0)
            return TRUE;
        else
            return FALSE;
    }

    public function get_order_history_by_orderid_and_status($order_id, $status_id){
        $conditions = array("order_id" => $order_id, "status_id" => $status_id);

        $order_history = $this->db->select("toch.*, u.nickname")
            ->join('users as u', 'u.id=toch.user_id')
            ->where("order_id", $order_id)
            ->where("status_id", $status_id)
            ->get($this->table_name." as toch")
            ->result();

        if (count($order_history) > 0)
            return $order_history[0];
        else
            return array();
    }

}
