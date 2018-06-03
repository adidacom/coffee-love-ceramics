<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Product extends MY_Model {

    protected $table_name = 'tbl_products';

    public function __construct() {
        parent::__construct();
    }

    public function get_all($fields = '', $where = Array(), $table = '', $limit = '', $order_by = '', $group_by = ''){
        $query = $this->db->select('tp.*, tpi.product_type_no, tpi.product_sn, tp.product_license_no, tpi.size_width, tpi.size_height, tpi.weight, tpi.production_price, tpi.bulk_sale_price, tpi.sale_price, tpi.internet_price, tpi.discount_price,tpi.loading_fee,  tpi.photo_1, tpi.photo_2, tpi.photo_3, tpi.photo_4, tpi.photo_5, tpi.description, mpk.kind_name, mc.name as color_name, ms.store_name, mtc.category_name')
            ->join('tbl_products_informations as tpi', 'tpi.id=tp.product_information_id', 'left')
            ->join('mst_product_kinds as mpk', 'mpk.id=tpi.product_kind_id', 'left')
            ->join('mst_colors as mc', 'mc.id=tp.color_id', 'left')
            ->join('mst_stores as ms', 'ms.id=tp.store_id', 'left')
            ->join('mst_tile_category as mtc', 'mtc.id=tpi.tile_category_id', 'left')
            ->order_by('id', 'desc')
            ->get($this->table_name . " as tp");

        return $query->result();
    }

    public function get($id){
        $query = $this->db->select('tp.*, tpi.product_type_no, tpi.product_sn, tp.product_license_no, tpi.size_width, tpi.size_height, tpi.weight, tpi.production_price, tpi.bulk_sale_price, tpi.sale_price, tpi.internet_price, tpi.discount_price,tpi.loading_fee,  tpi.photo_1, tpi.photo_2, tpi.photo_3, tpi.photo_4, tpi.photo_5, tpi.description, mpk.kind_name, mc.name as color_name, ms.store_name, mtc.category_name')
            ->join('tbl_products_informations as tpi', 'tpi.id=tp.product_information_id', 'left')
            ->join('mst_product_kinds as mpk', 'mpk.id=tpi.product_kind_id', 'left')
            ->join('mst_colors as mc', 'mc.id=tp.color_id', 'left')
            ->join('mst_stores as ms', 'ms.id=tp.store_id', 'left')
            ->join('mst_tile_category as mtc', 'mtc.id=tpi.tile_category_id', 'left')
            ->where('tp.id',$id)
            ->order_by('id', 'desc')
            ->get($this->table_name . " as tp");

        return $query->result();
    }

    public function getproductcolors($product_information_id){
        $query = $this->db
            ->select('color_id, mc.name as color_name')
            ->join('mst_colors as mc', 'mc.id=tp.color_id', 'left')
            ->where("tp.product_information_id", $product_information_id)
            ->group_by('color_id')
            ->get($this->table_name ." as tp");

        return $query->result();
    }
}
