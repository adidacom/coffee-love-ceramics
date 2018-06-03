<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Distribution extends MY_Model {

    protected $table_name = 'tbl_distributions';

    public function __construct() {
        parent::__construct();
    }

    public function get_all($fields = '', $where = Array(), $table = '', $limit = '', $order_by = '', $group_by = ''){
        $query = $this->db->select('td.*, tdl.level_name')
            ->from($this->table_name . " as td")
            ->join('tbl_distribution_level as tdl', 'tdl.id=td.distribution_level_id', 'left')
            ->order_by('id', 'desc')
            ->get();

        return $query->result();
    }
}
