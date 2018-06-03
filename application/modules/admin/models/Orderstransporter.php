<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class OrdersTransporter extends MY_Model {

    protected $table_name = 'tbl_orders_customer_transporters';

    public function __construct() {
        parent::__construct();
    }

    public function get_transporters($creator_id = ''){
        if($creator_id != '') {
            $query = $this->db->select('toct.*, u.nickname as username, tpi.product_sn, toc.product_id, mc.name as color_name')
                ->join('tbl_orders_customer as toc', 'toc.id=toct.order_id', 'left')
                ->join('tbl_products_informations as tpi', 'toc.product_id=tpi.id', 'left')
                ->join('users as u', 'toc.user_id=u.id', 'left')
                ->join('mst_colors as mc', 'toc.color_id=mc.id', 'left')
                ->where('toc.status_id >', 4)
                ->where('toct.creator_id ', $creator_id)
                ->order_by('id', 'desc')
                ->get($this->table_name . " as toct");
        } else {
            $query = $this->db->select('toct.*, u.nickname as username, tpi.product_sn, toc.product_id, mc.name as color_name')
                ->join('tbl_orders_customer as toc', 'toc.id=toct.order_id', 'left')
                ->join('tbl_products_informations as tpi', 'toc.product_id=tpi.id', 'left')
                ->join('users as u', 'toc.user_id=u.id', 'left')
                ->join('mst_colors as mc', 'toc.color_id=mc.id', 'left')
                ->where('toc.status_id >', 4)
                ->order_by('id', 'desc')
                ->get($this->table_name . " as toct");
        }

        return $query->result();
    }

    public function get_by_id($id){
        $query = $this->db->select('toct.*, toc.product_id')
            ->join('tbl_orders_customer as toc', 'toc.id=toct.order_id', 'left')
            ->where('toct.id', $id)
            ->get($this->table_name . " as toct");

        return $query->result();
    }

    public function get_already_transported_for_order($id){
        $this->db->select_sum('quantity');
        $this->db->from($this->table_name);
        $this->db->where('order_id', $id);
        $query = $this->db->get();

        return $query->row()->quantity;
    }
}
