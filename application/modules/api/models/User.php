<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class User extends MY_Model {

    protected $table_name = 'users';

    public function __construct() {
        parent::__construct();
    }

    public function update_user_token($data, $id){
        $this->db->update($this->table_name, $data, array('id' => $id));
        return true;
    }

    public function get_user_by_token($token){
        $user = $this->get_all("*", array("access_token"=>$token));

        $query = $this->db->select('us.*, gc.name as group_name, gc.description')
            ->join('users_groups as ug', 'us.id=ug.user_id', 'left')
            ->join('groups as gc', 'gc.id=ug.group_id', 'left')
            ->where("us.access_token", $token)
            ->get($this->table_name." as us");

        return $query->result();

        return $user;
    }

}
