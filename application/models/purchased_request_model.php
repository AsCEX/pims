<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Purchased_request_model extends CI_Model
{
    /**
     * Holds an array of tables used
     *
     * @var array
     **/
    public $pr_tbl = "purchase_requests";
    public $units_tbl = "units";
    public $pr_items_tbl = "purchase_request_items";
    public $pr_item_details_tbl = "purchase_request_item_details";
    public $pr_item_detail_specs_tbl = "purchase_request_item_detail_specs";
    public $offices_tbl = "offices";
    public $procurement_schedules_table = "procurement_plan_schedules";
    public $procurement_details_table = "procurement_plan_details";

    public function __construct()
    {
        parent::__construct();
    }

    public function getPurchasedRequest($id = null){

        $this->db->select("
            {$this->pr_tbl}.id as pr_id,
            {$this->pr_tbl}.created_date,
            {$this->offices_tbl}.name as dept_name
        ");
        $this->db->from($this->pr_tbl);
        $this->db->join("{$this->offices_tbl}", "{$this->offices_tbl}.id = {$this->pr_tbl}.department_id", "left");

        $rs = $this->db->get();

        return $rs->result();
    }


    public function getProcurementPlan($id = null){

        $this->db->select("
            {$this->procurement_details_table}.id as ppmp_detail_id,
            {$this->procurement_details_table}.code,
            {$this->procurement_details_table}.description,
            {$this->units_tbl}.unit_name,
            {$this->procurement_details_table}.budget,
            COALESCE(sum({$this->procurement_schedules_table}.value), 0) as qty,
            GROUP_CONCAT( {$this->procurement_schedules_table}.month) as scheds,
            GROUP_CONCAT( {$this->procurement_schedules_table}.value) as sched_values
        ");

        $this->db->join("{$this->units_tbl}","{$this->units_tbl}.id = {$this->procurement_details_table}.unit","left");
        $this->db->join("{$this->procurement_schedules_table}","{$this->procurement_schedules_table}.ppmp_details_id = {$this->procurement_details_table}.id","left");
        $this->db->having("sum({$this->procurement_schedules_table}.value) IS NOT NULL", null);
        $this->db->or_having("sum({$this->procurement_schedules_table}.value) > 0", null);
        $this->db->group_by("{$this->procurement_details_table}.id");
        $this->db->order_by("{$this->procurement_details_table}.created_date");
        $rs = $this->db->get($this->procurement_details_table);

        return $rs->result();
    }

    public function viewPurchasedRequest($id = null){

        $this->db->select("
            {$this->pr_tbl}.id as pr_id,
            {$this->pr_tbl}.sai_no,
            {$this->pr_tbl}.sai_date,
            {$this->pr_tbl}.alobs_no,
            {$this->pr_tbl}.alobs_date,
            {$this->pr_tbl}.quarter,
            {$this->pr_tbl}.purpose,
            {$this->pr_tbl}.created_date,
            {$this->offices_tbl}.name as dept_name,
        ");
        $this->db->from($this->pr_tbl);
        $this->db->where("{$this->pr_tbl}.id", $id);
        $this->db->join("{$this->offices_tbl}", "{$this->offices_tbl}.id = {$this->pr_tbl}.department_id", "left");

        $rs = $this->db->get();

        return $rs->result();
    }

    public function getPurchaseItems($pr_id){
        $this->db->select("
            {$this->pr_items_tbl}.id,
            {$this->pr_items_tbl}.description,
            {$this->pr_items_tbl}.qty,
            {$this->units_tbl}.unit_name,
            {$this->pr_items_tbl}.cost,
            {$this->procurement_details_table}.description as ppmp_desc,
            {$this->procurement_details_table}.qty as ppmp_qty,
            {$this->procurement_details_table}.unit as ppmp_unit,
            {$this->procurement_details_table}.budget as ppmp_budget
        ");
        $this->db->from($this->pr_items_tbl);
        $this->db->where("{$this->pr_items_tbl}.pr_id", $pr_id);
        $this->db->join("{$this->procurement_details_table}", "{$this->procurement_details_table}.id = {$this->pr_items_tbl}.ppmp_details_id", "left");
        $this->db->join("{$this->units_tbl}", "{$this->units_tbl}.id = {$this->procurement_details_table}.unit", "left");
/*        $this->db->join("{$this->pr_item_details_tbl}", "{$this->pr_item_details_tbl}.pr_item_id = {$this->pr_items_tbl}.id", "left");
        $this->db->join("{$this->pr_item_detail_specs_tbl}", "{$this->pr_item_detail_specs_tbl}.prid_id = {$this->pr_item_details_tbl}.id", "left");*/

        $rs = $this->db->get();

        return $rs->result();
    }

    public function getPurchaseItemDetails($pr_item_id){
        $this->db->select("*");
        $this->db->from($this->pr_item_details_tbl);
        $this->db->where("{$this->pr_item_details_tbl}.pr_item_id", $pr_item_id);
        //$this->db->join("{$this->pr_item_details_tbl}", "{$this->pr_item_details_tbl}.pr_item_id = {$this->pr_items_tbl}.id", "left");
        //$this->db->join("{$this->pr_item_detail_specs_tbl}", "{$this->pr_item_detail_specs_tbl}.prid_id = {$this->pr_item_details_tbl}.id", "left");

        $rs = $this->db->get();

        return $rs->result();
    }

    public function getPRItemSpecs($prid_id){
        $this->db->select("*");
        $this->db->from($this->pr_item_detail_specs_tbl);
        $this->db->where("{$this->pr_item_detail_specs_tbl}.prid_id", $prid_id);
        $this->db->join("{$this->units_tbl}", "{$this->units_tbl}.id = {$this->pr_item_detail_specs_tbl}.unit", "left");

        $rs = $this->db->get();

        return $rs->result();
    }

    public function create($data){
        $insert = array(
            'department_id' => $data['office_id'],
            'sai_no'        => $data['sai_no'],
            'sai_date'      => $data['sai_date'],
            'alobs_no'      => $data['alobs_date'],
            'alobs_date'    => $data['alobs_date'],
            'quarter'       => $data['quarter'],
            'purpose'       => $data['purpose'],
            'created_date'  => date('Y-m-d'),
            'created_by'    => $this->session->userdata('user_id')
        );

        $ppmp = $this->db->insert($this->pr_tbl, $insert);

        if($ppmp){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    public function create_purchase_items($data){

        pre_print($data);
        $ppmp = $this->db->insert($this->pr_items_tbl, $data);

        if($ppmp){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

}
