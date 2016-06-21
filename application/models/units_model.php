<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Units_model extends CI_Model
{
    /**
     * Holds an array of tables used
     *
     * @var array
     **/
    public $units_tbl = "units";

    public function __construct()
    {
        parent::__construct();
    }

    public function getUnits($id = null){

        $this->db->select("*");
        $rs = $this->db->get($this->units_tbl);

        return $rs->result();
    }

}
