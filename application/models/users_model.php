<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Users_model extends CI_Model
{
    /**
     * Holds an array of tables used
     *
     * @var array
     **/
    public $users_table = "users";
    public $users_group_table = "users_groups";
    public $groups_table = "groups";
    public $office_table = "offices";

    public function __construct()
    {
        parent::__construct();
    }

    public function getUsers($id = null){

        $this->db->select("
            {$this->users_table}.id as user_id,
            {$this->users_table}.first_name,
            {$this->users_table}.last_name,
            {$this->users_table}.company,
            {$this->office_table}.name as office,
            GROUP_CONCAT( {$this->groups_table}.description SEPARATOR ' | ') as user_roles
        ");
        $this->db->join("{$this->users_group_table}", "{$this->users_group_table}.user_id = {$this->users_table}.id", "left");
        $this->db->join("{$this->groups_table}", "{$this->groups_table}.id = {$this->users_group_table}.group_id", "left");
        $this->db->join("{$this->office_table}", "{$this->office_table}.id = {$this->users_table}.company", "left");
        $this->db->group_by("{$this->users_table}.id");

        $rs = $this->db->get($this->users_table);

        return $rs->result();
    }

}
