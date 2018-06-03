<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class UserBonusHistory extends MY_Model {

    protected $table_name = 'tbl_users_bonus_history';

    public function __construct() {
        parent::__construct();
    }
}
