<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Bank extends MY_Model {

    protected $table_name = 'mst_banks';

    public function __construct() {
        parent::__construct();
    }
}
