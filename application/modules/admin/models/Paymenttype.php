<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class PaymentType extends MY_Model {

    protected $table_name = 'mst_payment_types';

    public function __construct() {
        parent::__construct();
    }
}
