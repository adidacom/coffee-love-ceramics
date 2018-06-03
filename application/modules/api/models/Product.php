<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Product extends MY_Model {

    protected $table_name = 'tbl_products_informations';

    public function __construct() {
        parent::__construct();
    }

    public function check_token($token){
        $query = $this->db->select('access_token, expires_in, id ')
            ->where('access_token', $token)
            ->order_by('id', 'asc')
            ->limit(1)
            ->get('users');

        if( $query->num_rows() == 0 )
            return FALSE;

        $user = $query->result();

        $current_time = strtotime(date("Y-m-d H:i:s"));

        if($current_time < $user[0]->expires_in) {
            $expire_time = strtotime(date("Y-m-d H:i:s"))+24*60*60;
            $data = array('expires_in'=>$expire_time);
            $user_id = $user[0]->id;
            $this->db->update('users', $data, array('id' => $user_id));
            return TRUE;
        }
        else
            return FALSE;
    }

    public function get_product_kinds(){
        $query = $this->db->select('id as value, kind_name as text')
            ->order_by('id', 'asc')
            ->get('mst_product_kinds');

        return $query->result();
    }

    public function get_products_by_kind($kind_id){
        /*$query = $this->db->select('tp.*, tpi.product_type_no, tpi.product_sn, tpi.size_width, tpi.size_height, tpi.weight, tpi.production_price, tpi.bulk_sale_price, tpi.sale_price, tpi.internet_price, tpi.discount_price,tpi.loading_fee,  tpi.photo_1, tpi.photo_2, tpi.photo_3, tpi.photo_4, tpi.photo_5, tpi.description ')
            ->join('tbl_products_informations as tpi', 'tpi.id=tp.product_information_id', 'left')
            ->where("product_kind_id", $kind_id)
            ->order_by('id', 'asc')
            ->get($this->table_name." as tp");*/

        $query = $this->db->select('tpi.id, tpi.product_type_no, tpi.product_sn, tpi.size_width, tpi.size_height, tpi.weight, tpi.production_price, tpi.bulk_sale_price, tpi.sale_price, tpi.internet_price, tpi.discount_price,tpi.loading_fee,  tpi.photo_1, tpi.photo_2, tpi.photo_3, tpi.photo_4, tpi.photo_5, tpi.description ')
            ->where("product_kind_id", $kind_id)
            ->order_by('id', 'asc')
            ->get("tbl_products_informations as tpi");

        return $query->result();
    }

    public function get_all_products(){
        $query = $this->db->select('tpi.id, tpi.product_type_no, tpi.product_sn, tpi.size_width, tpi.size_height, tpi.weight, tpi.production_price, tpi.bulk_sale_price, tpi.sale_price, tpi.internet_price, tpi.discount_price,tpi.loading_fee,  tpi.photo_1, tpi.photo_2, tpi.photo_3, tpi.photo_4, tpi.photo_5, tpi.description ')
            ->order_by('id', 'asc')
            ->get("tbl_products_informations as tpi");

        return $query->result();
    }

    public function get_by_id($product_id){
        /*$query = $this->db->select('tp.*, tpi.tile_category_id, tpi.product_kind_id, tpi.color_id, tpi.product_type_no, tpi.product_sn, tpi.size_width, tpi.size_height, tpi.weight, tpi.production_price, tpi.bulk_sale_price, tpi.sale_price, tpi.internet_price, tpi.discount_price,tpi.loading_fee,  tpi.photo_1, tpi.photo_2, tpi.photo_3, tpi.photo_4, tpi.photo_5, tpi.description, mpk.kind_name, mc.name as color_name, ms.store_name, mtc.category_name')
            ->join('tbl_products_informations as tpi', 'tpi.id=tp.product_information_id', 'left')
            ->join('mst_product_kinds as mpk', 'mpk.id=tpi.product_kind_id', 'left')
            ->join('mst_colors as mc', 'mc.id=tpi.color_id', 'left')
            ->join('mst_stores as ms', 'ms.id=tp.store_id', 'left')
            ->join('mst_tile_category as mtc', 'mtc.id=tpi.tile_category_id', 'left')
            ->where("tp.id", $product_id)
            ->order_by('id', 'asc')
            ->get($this->table_name." as tp");*/

        $query = $this->db->select('tpi.id, tpi.tile_category_id, tpi.product_kind_id, tpi.product_type_no, tpi.product_sn, tpi.size_width, tpi.size_height, tpi.weight, tpi.production_price, tpi.bulk_sale_price, tpi.sale_price, tpi.internet_price, tpi.discount_price,tpi.loading_fee,  tpi.photo_1, tpi.photo_2, tpi.photo_3, tpi.photo_4, tpi.photo_5, tpi.description, mpk.kind_name, mtc.category_name')
            ->join('mst_product_kinds as mpk', 'mpk.id=tpi.product_kind_id', 'left')
            //->join('mst_colors as mc', 'mc.id=tpi.color_id', 'left')
            ->join('mst_tile_category as mtc', 'mtc.id=tpi.tile_category_id', 'left')
            ->where("tpi.id", $product_id)
            ->get("tbl_products_informations as tpi");

        return $query->result();
    }

    public function create_order($data){
        $success = $this->db->insert("tbl_orders_customer", $data);
        if ($success) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    public function orders_by_user($user_id){
        /*$query = $this->db->select('tp.*, mpk.kind_name, mc.name as color_name, tpi.photo_1, mos.status_name')
            ->join('tbl_products as tpu', 'tpu.id=tp.product_id', 'left')
            ->join('tbl_products_informations as tpi', 'tpi.id=tpu.product_information_id', 'left')
            ->join('mst_product_kinds as mpk', 'mpk.id=tpi.product_kind_id', 'left')
            ->join('mst_colors as mc', 'mc.id=tpi.color_id', 'left')
            ->join('mst_order_status as mos', 'mos.id=tp.status_id', 'left')
            ->where("tp.user_id", $user_id)
            ->order_by('id', 'asc')
            ->get("tbl_orders_customer as tp");*/

        //$query = $this->db->select('tp.*, mpk.kind_name, mc.name as color_name, tpi.photo_1, mos.status_name')
        $query = $this->db->select('tp.*, mpk.kind_name, tpi.photo_1, mos.status_name')
            ->join('tbl_products_informations as tpi', 'tpi.id=tp.product_id', 'left')
            ->join('mst_product_kinds as mpk', 'mpk.id=tpi.product_kind_id', 'left')
            //->join('mst_colors as mc', 'mc.id=tpi.color_id', 'left')
            ->join('mst_order_status as mos', 'mos.id=tp.status_id', 'left')
            ->where("tp.user_id", $user_id)
            ->order_by('id', 'asc')
            ->get("tbl_orders_customer as tp");


        return $query->result();
    }

    public function order_by_id($order_id){
        /*$query = $this->db->select('tp.*, mpk.kind_name, mc.name as color_name, tpi.photo_1, mos.status_name')
            ->join('tbl_products as tpu', 'tpu.id=tp.product_id', 'left')
            ->join('tbl_products_informations as tpi', 'tpi.id=tpu.product_information_id', 'left')
            ->join('mst_product_kinds as mpk', 'mpk.id=tpi.product_kind_id', 'left')
            ->join('mst_colors as mc', 'mc.id=tpi.color_id', 'left')
            ->join('mst_order_status as mos', 'mos.id=tp.status_id', 'left')
            ->where("tp.id", $order_id)
            ->get("tbl_orders_customer as tp");*/

        //$query = $this->db->select('tp.*, mpk.kind_name, mc.name as color_name, tpi.photo_1, tpi.product_sn, tpi.product_type_no,  mos.status_name')
        $query = $this->db->select('tp.*, mpk.kind_name, tpi.photo_1, tpi.product_sn, tpi.product_type_no,  mos.status_name')
            ->join('tbl_products_informations as tpi', 'tpi.id=tp.product_id', 'left')
            ->join('mst_product_kinds as mpk', 'mpk.id=tpi.product_kind_id', 'left')
            //->join('mst_colors as mc', 'mc.id=tpi.color_id', 'left')
            ->join('mst_order_status as mos', 'mos.id=tp.status_id', 'left')
            ->where("tp.id", $order_id)
            ->get("tbl_orders_customer as tp");

        return $query->result();
    }

    public function get_retailers($user_id){

        $condition = array("parent_id" => $user_id);

        $childs = $this->get_all("*", $condition, "users");

        foreach($childs as $ind => $child){
            $child_orders = $this->get_all("*", array("user_id" => $child['id']), "tbl_orders_customer" );

            $paid_amount = 0;

            foreach($child_orders as $child_order){
                $child_order_history = $this->get_all("*", array("order_id" => $child_order['id']), "tbl_orders_customer_history" );

                $percent_30_calculated = false;
                $percent_70_calculated = false;

                foreach($child_order_history as $history) {
                    if (!$percent_30_calculated && ($history['status_id'] == 3 || $history['status_id'] == 4)) {
                        $paid_amount += $history['deposit_amount'];
                        $percent_30_calculated = true;
                    }

                    if (!$percent_70_calculated && ($history['status_id'] == 5 || $history['status_id'] == 7 || $history['status_id'] == 8)) {
                        $paid_amount += $history['deposit_amount']+$history['deposit_amount_70'];
                        $percent_70_calculated = true;
                    }
                }
            }

            $childs[$ind]['total_paid'] = $paid_amount;

            $child_childs = $this->get_all("*", array('parent_id' => $child['id']), "users");
            $childs[$ind]['childs'] = count($child_childs);
        }

        return $childs;
    }
}
