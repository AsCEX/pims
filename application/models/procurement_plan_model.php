<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Procurement_plan_model extends CI_Model
{
    /**
     * Holds an array of tables used
     *
     * @var array
     **/
    public $procurement_plan_table = "procurement_plans";
    public $procurement_schedules_table = "procurement_plan_schedules";
    public $procurement_details_table = "procurement_plan_details";
    public $units_table = "units";

    public function __construct()
    {
        parent::__construct();
    }

    public function getProcurementPlan($id = null){

        /*$this->db->select("
            {$this->procurement_plan_table}.id as ppmp_id,
            {$this->procurement_details_table}.id as ppmp_detail_id,
            {$this->procurement_details_table}.code,
            {$this->procurement_details_table}.description,
            {$this->procurement_details_table}.unit,
            {$this->procurement_details_table}.budget,
            sum({$this->procurement_schedules_table}.value) as qty,
            GROUP_CONCAT( {$this->procurement_schedules_table}.month) as scheds,
            GROUP_CONCAT( {$this->procurement_schedules_table}.value) as sched_values
        ");*/
        $this->db->select("
            {$this->procurement_details_table}.id as ppmp_detail_id,
            {$this->procurement_details_table}.code,
            {$this->procurement_details_table}.description,
            {$this->units_table}.unit_name,
            {$this->procurement_details_table}.budget,
            COALESCE(sum({$this->procurement_schedules_table}.value), 0) as qty,
            GROUP_CONCAT( {$this->procurement_schedules_table}.month) as scheds,
            GROUP_CONCAT( {$this->procurement_schedules_table}.value) as sched_values
        ");

        if($id){
            $this->db->where("{$this->procurement_details_table}.id", $id);
        }

        $this->db->join("{$this->units_table}","{$this->units_table}.id = {$this->procurement_details_table}.unit","left");
        $this->db->join("{$this->procurement_schedules_table}","{$this->procurement_schedules_table}.ppmp_details_id = {$this->procurement_details_table}.id","left");
        $this->db->group_by("{$this->procurement_details_table}.id");
        $this->db->order_by("{$this->procurement_details_table}.created_date");
        $rs = $this->db->get($this->procurement_details_table);

        return $rs->result();
    }

    public function getProcurementPlanWhere($param = array()){

        /*$this->db->select("
            {$this->procurement_plan_table}.id as ppmp_id,
            {$this->procurement_details_table}.id as ppmp_detail_id,
            {$this->procurement_details_table}.code,
            {$this->procurement_details_table}.description,
            {$this->procurement_details_table}.unit,
            {$this->procurement_details_table}.budget,
            sum({$this->procurement_schedules_table}.value) as qty,
            GROUP_CONCAT( {$this->procurement_schedules_table}.month) as scheds,
            GROUP_CONCAT( {$this->procurement_schedules_table}.value) as sched_values
        ");*/
        $this->db->select("
            {$this->procurement_details_table}.id as ppmp_detail_id,
            {$this->procurement_details_table}.code,
            {$this->procurement_details_table}.description,
            {$this->units_table}.unit_name,
            {$this->procurement_details_table}.budget,
            COALESCE(sum({$this->procurement_schedules_table}.value), 0) as qty,
            GROUP_CONCAT( {$this->procurement_schedules_table}.month) as scheds,
            GROUP_CONCAT( {$this->procurement_schedules_table}.value) as sched_values
        ");

        if($param){
            foreach($param as $k=>$p){
                $this->db->where("{$this->procurement_details_table}." . $k , $p);
            }
        }

        $this->db->join("{$this->units_table}","{$this->units_table}.id = {$this->procurement_details_table}.unit","left");
        $this->db->join("{$this->procurement_schedules_table}","{$this->procurement_schedules_table}.ppmp_details_id = {$this->procurement_details_table}.id","left");
        $this->db->group_by("{$this->procurement_details_table}.id");
        $this->db->order_by("{$this->procurement_details_table}.created_date");
        $rs = $this->db->get($this->procurement_details_table);

        return $rs->result();
    }

    public function create($data){
        $insert = array(
            'code'          => $data['code'],
            'description'   => $data['description'],
//            'qty'           => $data['qty'],
            'unit'          => $data['unit_id'],
            'budget'        => $data['budget'],
            'office_id'     => $data['office_id'],
            'source_fund'   => $data['source_fund'],
            'created_date'  => date('Y-m-d'),
            'created_by'    => $this->session->userdata('user_id')
        );

        $ppmp = $this->db->insert($this->procurement_details_table, $insert);

        if($ppmp){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }


    public function addProcurementSchedule($ppmp_id, $schedule){

        foreach($schedule['month'] as $month=>$value){

            $sched = array(
                'ppmp_details_id'   => $ppmp_id,
                'month'             => $month,
                'value'             => $value
            );

            $this->db->insert($this->procurement_schedules_table, $sched);
        }

    }

}
