<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class OrderCustomer extends MY_Model {

    protected $table_name = 'tbl_orders_customer';

    public function __construct() {
        parent::__construct();
    }

    public function get_all_orders($user_id = '', $user_type = ""){
        if ($user_type == 'admin' || $user_type == 'accounter') {
            $query = $this->db->select('tp.*, tpi.product_type_no, tpi.product_sn, tpi.size_width, tpi.size_height, tpi.weight, tpi.loading_fee, mpk.kind_name, mc.name as color_name, mos.status_name, u.nickname, u.phone')
                ->join('tbl_products_informations as tpi', 'tpi.id=tp.product_id', 'left')
                ->join('mst_product_kinds as mpk', 'mpk.id=tpi.product_kind_id', 'left')
                ->join('mst_colors as mc', 'mc.id=tp.color_id', 'left')
                ->join('mst_order_status as mos', 'mos.id=tp.status_id', 'left')
                ->join('users as u', 'u.id=tp.user_id', 'left')
                ->order_by('id', 'desc')
                ->get($this->table_name . " as tp");
        } else if($user_type == 'saler'){
            $query = $this->db->select('tp.*, tpi.product_type_no, tpi.product_sn, tpi.size_width, tpi.size_height, tpi.weight, tpi.loading_fee, mpk.kind_name, mc.name as color_name, mos.status_name, u.nickname, u.phone')
                ->join('tbl_products_informations as tpi', 'tpi.id=tp.product_id', 'left')
                ->join('mst_product_kinds as mpk', 'mpk.id=tpi.product_kind_id', 'left')
                ->join('mst_colors as mc', 'mc.id=tp.color_id', 'left')
                ->join('mst_order_status as mos', 'mos.id=tp.status_id', 'left')
                ->join('users as u', 'u.id=tp.user_id', 'left')
                ->where('tp.user_id', $user_id)
                ->order_by('id', 'desc')
                ->get($this->table_name . " as tp");
        }

        return $query->result();
    }

    public function get_one($order_id){

        $query = $this->db->select('tp.id, tpi.product_type_no, tpi.product_sn, tpi.size_width, tpi.size_height, tpi.weight, tpi.production_price, tpi.bulk_sale_price, tpi.sale_price, tpi.internet_price, tpi.loading_fee, tp.quantity, tp.customer_name, tp.customer_name_70, tp.shipping_address, tp.customer_phone, tp.deposit_bank, tp.deposit_bank_70, tp.deposit_amount, tp.deposit_amount_70, tp.deposit_date, tp.deposit_date_70, tp.deposit_time, tp.deposit_time_70, tp.deposit_item, tp.deposit_item_70, tp.status_id, tp.product_id, tp.user_id, mpk.kind_name, mc.name as color_name, tpi.photo_1, mos.status_name, tp.sale_price as total_price, mot.type_name, tpi.stock, tp.box_quantity, tpi.tiles_per_box_quantity, tp.total_price, tp.sale_price as item_price')
            ->join('tbl_products_informations as tpi', 'tpi.id=tp.product_id', 'left')
            ->join('mst_product_kinds as mpk', 'mpk.id=tpi.product_kind_id', 'left')
            ->join('mst_colors as mc', 'mc.id=tp.color_id', 'left')
            ->join('mst_order_status as mos', 'mos.id=tp.status_id', 'left')
            ->join('mst_order_type as mot', 'mot.id=tp.order_type_id', 'left')
            ->where("tp.id", $order_id)
            ->get("tbl_orders_customer as tp");

        return $query->result();
    }

    public function get_orders_not_processed_yet(){
        $query = $this->db->select('tp.*, mos.status_name, mot.type_name, u.nickname')
            ->join('tbl_products_informations as tpi', 'tpi.id=tp.product_id', 'left')
            ->join('mst_order_status as mos', 'mos.id=tp.status_id', 'left')
            ->join('mst_order_type as mot', 'mot.id=tp.order_type_id', 'left')
            ->join('users as u', 'u.id=tp.user_id', 'left')
            ->where("tp.status_id < ", "5")
            ->order_by('id', 'asc')
            ->get("tbl_orders_customer as tp");

        return $query->result();
    }

    public function get_paid_orders(){
        $query = $this->db->select('tp.*, mos.status_name, mot.type_name, u.nickname')
            ->join('tbl_products_informations as tpi', 'tpi.id=tp.product_id', 'left')
            ->join('mst_order_status as mos', 'mos.id=tp.status_id', 'left')
            ->join('mst_order_type as mot', 'mot.id=tp.order_type_id', 'left')
            ->join('users as u', 'u.id=tp.user_id', 'left')
            ->where("tp.status_id >= ", "5")
            ->order_by('id', 'asc')
            ->get("tbl_orders_customer as tp");

        return $query->result();
    }

    public function get_total_quantity(){
        $this->db->select_sum('quantity');
        $this->db->from($this->table_name);
        $query = $this->db->get();

        return $query->row()->quantity;
    }
}
