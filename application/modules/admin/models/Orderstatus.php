<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class OrderStatus extends MY_Model {

    protected $table_name = 'mst_order_status';

    public function __construct() {
        parent::__construct();
    }
}
