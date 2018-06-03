<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class OrderType extends MY_Model {

    protected $table_name = 'mst_order_type';

    public function __construct() {
        parent::__construct();
    }

    public function get_saler_order_type(){
        $types = $this->get_all("*", array("id > "=>1));
        return $types;
    }
}
