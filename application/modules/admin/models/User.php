<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class User extends MY_Model {

    protected $table_name = 'users';

    public function __construct() {
        parent::__construct();
    }

    public function get_user_by_phone($phone){
        $row = $this->db->get_where($this->table_name, array('phone' => $phone))->row();
        return $row;
    }

    public function get_user_by_name_or_phone($search_query){
        $this->db->like('nickname', $search_query);
        $this->db->or_like('phone', $search_query);
        $results = $this->db->get($this->table_name);
        return $results->result();
    }
}
