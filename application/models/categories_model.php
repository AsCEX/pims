<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Categories_model extends CI_Model
{
    /**
     * Holds an array of tables used
     *
     * @var array
     **/
    public $categories_tbl = "categories";
    public $sub_categories_tbl = "sub_categories";

    public function __construct()
    {
        parent::__construct();
    }

    public function getCategories($id = null){

        $this->db->select("*");
        $rs = $this->db->get($this->categories_tbl);

        return $rs->result();
    }

}
