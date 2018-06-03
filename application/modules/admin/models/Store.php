<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Store extends MY_Model {

    protected $table_name = 'mst_stores';

    public function __construct() {
        parent::__construct();
    }
}
