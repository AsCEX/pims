<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Offices_model extends CI_Model
{
    /**
     * Holds an array of tables used
     *
     * @var array
     **/
    public $offices_tbl = "offices";

    public function __construct()
    {
        parent::__construct();
    }

    public function getOffices($id = null){

        $this->db->select("*");
        $rs = $this->db->get($this->offices_tbl);

        return $rs->result();
    }

}
