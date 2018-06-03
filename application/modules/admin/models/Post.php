<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Post extends MY_Model {

    protected $table_name = 'tbl_posts';

    public function __construct() {
        parent::__construct();
    }
}
