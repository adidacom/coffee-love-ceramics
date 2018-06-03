<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class OrderProduction extends MY_Model {

    protected $table_name = 'tbl_orders_production';

    public function __construct() {
        parent::__construct();
    }

    public function get_all($fields = '', $where = Array(), $table = '', $limit = '', $order_by = '', $group_by = ''){
        $query = $this->db->select('tp.*, mpk.kind_name, mc.name as color_name, mu.unit_name')
            ->from($this->table_name . " as tp")
            ->join('mst_product_kinds as mpk', 'mpk.id=tp.product_kind_id', 'left')
            ->join('mst_colors as mc', 'mc.id=tp.color_id', 'left')
            ->join('mst_units as mu', 'mu.id=tp.unit_id', 'left')
            ->order_by('id', 'desc')
            ->get();

        return $query->result();
    }
}
