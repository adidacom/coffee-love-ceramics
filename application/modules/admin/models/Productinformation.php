<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class ProductInformation extends MY_Model {

    protected $table_name = 'tbl_products_informations';

    public function __construct() {
        parent::__construct();
    }

    public function get_all($fields = '', $where = Array(), $table = '', $limit = '', $order_by = '', $group_by = ''){
        $query = $this->db->select('tp.*, mpk.kind_name, mtc.category_name')
            ->from($this->table_name . " as tp")
            ->join('mst_product_kinds as mpk', 'mpk.id=tp.product_kind_id', 'left')
            //->join('mst_colors as mc', 'mc.id=tp.color_id', 'left')
            ->join('mst_tile_category as mtc', 'mtc.id=tp.tile_category_id', 'left')
            ->order_by('id', 'desc')
            ->get();

        return $query->result();
    }

    public function get_one($id){
        //$query = $this->db->select('tp.*, mpk.kind_name, mc.name as color_name, mtc.category_name')
        $query = $this->db->select('tp.*, mpk.kind_name, mtc.category_name')
            ->from($this->table_name . " as tp")
            ->join('mst_product_kinds as mpk', 'mpk.id=tp.product_kind_id', 'left')
            //->join('mst_colors as mc', 'mc.id=tp.color_id', 'left')
            ->join('mst_tile_category as mtc', 'mtc.id=tp.tile_category_id', 'left')
            ->where("tp.id", $id)
            ->order_by('id', 'desc')
            ->get();

        return $query->result();
    }

    /*public function is_already_registered_product_sn($product_sn, $color_id, $id = '0'){
        $query = $this->db->select("*")
            ->where("product_sn", $product_sn)
            ->where("color_id", $color_id)
            ->where("id != ", $id)
            ->get($this->table_name);

        $result = $query->result();

        if ( count($result) > 0)
            return TRUE;
        else
            return FALSE;
    }*/

    public function is_already_registered_product_sn($product_sn, $id = '0'){
        $query = $this->db->select("*")
            ->where("product_sn", $product_sn)
            ->where("id != ", $id)
            ->get($this->table_name);

        $result = $query->result();

        if ( count($result) > 0)
            return TRUE;
        else
            return FALSE;
    }

    public function get_by_sn_or_color($search_query){
        //$this->db->select("tpi.*, mc.name as color_name, mpk.kind_name");
        $this->db->select("tpi.*, mpk.kind_name");
        $this->db->like('product_sn', $search_query);
        //$this->db->or_like('mc.name', $search_query);
        //$this->db->join("mst_colors as mc", "mc.id=tpi.color_id");
        $this->db->join("mst_product_kinds as mpk", "mpk.id=tpi.product_kind_id");
        $results = $this->db->get($this->table_name." as tpi");
        return $results->result();
    }
}
