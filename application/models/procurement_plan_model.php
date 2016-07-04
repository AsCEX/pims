<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Procurement_plan_model extends CI_Model
{
    /**
     * Holds an array of tables used
     *
     * @var array
     **/
    public $procurement_plan_table = "tbl_procurement_plans";
    public $procurement_schedules_table = "tbl_procurement_plan_schedules";
    public $units_table = "tbl_units";
    public $pr_items_tbl = "tbl_purchase_request_items";

    public function __construct()
    {
        parent::__construct();
    }

    public function getProcurementPlan($id = null){

        $this->db->select("
            ppmp_id,
            ppmp_code,
            ppmp_description,
            ppmp_budget,
            unit_name,
            COALESCE(sum(pps_value), 0) as qty,
            GROUP_CONCAT( pps_month) as scheds,
            GROUP_CONCAT( pps_value) as sched_values
        ");

        if($id){
            $this->db->where("ppmp_id", $id);
        }

        $this->db->join($this->units_table, "unit_id = ppmp_unit","left");
        $this->db->join($this->procurement_schedules_table, "pps_ppmp_id = ppmp_id","left");
        $this->db->group_by("ppmp_id");
        $this->db->order_by("ppmp_created_date");
        $rs = $this->db->get($this->procurement_plan_table);

        return $rs->result();
    }

    public function getProcurementPlanById($id = null, $where = array('quarter'=>'', 'office'=>'')){

        $fields = "
                ppmp_id,
                ppmp_code,
                ppmp_description,
                ppmp_unit,
                ppmp_office_id,
                ppmp_source_fund,
                ppmp_category_id,
                ppmp_budget,
                unit_name,
                COALESCE(sum(pps_value), 0) as qty,
                GROUP_CONCAT( pps_month) as scheds,
                GROUP_CONCAT( pps_value) as sched_values,
                tot_budget.tot_qty,
                FORMAT((ppmp_budget/tot_budget.tot_qty), 2) as cost_per_qty,
                FORMAT((ppmp_budget/tot_budget.tot_qty) *  COALESCE(sum(pps_value), 0), 2) as qty_cost,
            ";


        $this->db->select($fields);

        $this->db->where("ppmp_id", $id);

        $this->db->join($this->units_table, "unit_id = ppmp_unit","left");
        $this->db->join($this->procurement_schedules_table, "pps_ppmp_id = ppmp_id","left");
        $this->db->join("(
                    SELECT sum(pps_value) as tot_qty, pps_ppmp_id  FROM $this->procurement_schedules_table GROUP BY pps_ppmp_id
        ) as tot_budget","tot_budget.pps_ppmp_id = ppmp_id","left");



        $this->db->where("ppmp_id", $id);

        if($where['office']){
            $office = ($where['office']) ? $where['office'] : 0;
            $this->db->where("ppmp_office_id" , $office);
        }

        if($where['quarter']){
            $q = (($where['quarter']-1) * 3) + 1;
            $this->db->where_in("pps_month", array($q, $q+1, $q+2));
        }


        $this->db->group_by("ppmp_id");
        $this->db->order_by("ppmp_created_date");
        $rs = $this->db->get($this->procurement_plan_table);

        return $rs->row();
    }

    public function getLimitProcurementPlan($pr_id = null, $where = array(), $curPage = 1, $rowsPerPage = 10){


        $fields = ($pr_id) ? "IF(pri_id,'checked','') as pri_chk," : "";
        $fields .= "
                ppmp_id,
                ppmp_code,
                ppmp_description,
                ppmp_unit,
                ppmp_office_id,
                ppmp_source_fund,
                ppmp_category_id,
                ppmp_budget,
                unit_name,
                COALESCE(sum(pps_value), 0) as qty,
                GROUP_CONCAT( pps_month) as scheds,
                GROUP_CONCAT( pps_value) as sched_values,
                tot_budget.tot_qty,
                FORMAT((ppmp_budget/tot_budget.tot_qty), 2) as cost_per_qty,
                FORMAT((ppmp_budget/tot_budget.tot_qty) *  COALESCE(sum(pps_value), 0), 2) as qty_cost,
            ";


        $this->db->select($fields);


        $this->db->join($this->units_table, "unit_id = ppmp_unit","left");
        $this->db->join($this->procurement_schedules_table, "pps_ppmp_id = ppmp_id","left");
        $this->db->join("(
                    SELECT sum(pps_value) as tot_qty, pps_ppmp_id  FROM $this->procurement_schedules_table GROUP BY pps_ppmp_id
        ) as tot_budget","tot_budget.pps_ppmp_id = ppmp_id","left");

        if($pr_id)
            $this->db->join($this->pr_items_tbl, "pri_ppmp_id = ppmp_id AND pri_pr_id = " . $pr_id, "left");


        if($where['quarter']){
            $q = (($where['quarter']-1) * 3) + 1;
            $this->db->where_in("pps_month", array($q, $q+1, $q+2));
        }

        if($where['office']){
            $office = ($where['office']) ? $where['office'] : 0;
            $this->db->where("ppmp_office_id" , $office);
        }


        $this->db->group_by("ppmp_id");
        $this->db->order_by("ppmp_created_date");
        $this->db->limit( $rowsPerPage, ($curPage-1) * $rowsPerPage);

        $rs = $this->db->get($this->procurement_plan_table);

        return $rs->result();
    }

    public function getLimitProcurementPlanPR($pr_id = null, $where = array(), $curPage = 1, $rowsPerPage = 10){


        $fields = ($pr_id) ? "IF(pri_id,'checked','') as pri_chk," : "";
        $fields .= "
                ppmp_id,
                ppmp_code,
                ppmp_description,
                ppmp_unit,
                ppmp_office_id,
                ppmp_source_fund,
                ppmp_category_id,
                ppmp_budget,
                unit_name,
                COALESCE(sum(pps_value), 0) as qty,
                GROUP_CONCAT( pps_month) as scheds,
                GROUP_CONCAT( pps_value) as sched_values,
                tot_budget.tot_qty,
                FORMAT((ppmp_budget/tot_budget.tot_qty), 2) as cost_per_qty,
                FORMAT((ppmp_budget/tot_budget.tot_qty) *  COALESCE(sum(pps_value), 0), 2) as qty_cost,
            ";


        $this->db->select($fields);


        $this->db->join($this->units_table, "unit_id = ppmp_unit","left");
        $this->db->join($this->procurement_schedules_table, "pps_ppmp_id = ppmp_id","left");
        $this->db->join("(
                    SELECT sum(pps_value) as tot_qty, pps_ppmp_id  FROM $this->procurement_schedules_table GROUP BY pps_ppmp_id
        ) as tot_budget","tot_budget.pps_ppmp_id = ppmp_id","left");

        if($pr_id)
            $this->db->join($this->pr_items_tbl, "pri_ppmp_id = ppmp_id AND pri_pr_id = " . $pr_id, "left");


        if($where['quarter']){
            $q = (($where['quarter']-1) * 3) + 1;
            $this->db->where_in("pps_month", array($q, $q+1, $q+2));
        }else{
            $this->db->where_in("pps_month", array(0));
        }

        $office = ($where['office']) ? $where['office'] : 0;
        $this->db->where("ppmp_office_id" , $office);


        $this->db->group_by("ppmp_id");
        if($pr_id)
            $this->db->order_by("pri_id", "DESC");
        $this->db->order_by("ppmp_created_date");
        $this->db->limit( $rowsPerPage, ($curPage-1) * $rowsPerPage);

        $rs = $this->db->get($this->procurement_plan_table);

        return $rs->result();
    }

    public function countRows(){

        $this->db->select("count(*) as cnt");
        $rs = $this->db->get($this->procurement_plan_table);

        return $rs->row()->cnt;
    }

    public function getProcurementPlanWhere($office_id, $quarter, $ppmp_id = null){

        $this->db->select("
            ppmp_id,
            ppmp_code,
            ppmp_description,
            ppmp_unit,
            ppmp_office_id,
            ppmp_source_fund,
            ppmp_category_id,
            ppmp_budget,
            unit_name,
            COALESCE(sum(pps_value), 0) as qty,
            GROUP_CONCAT( pps_month) as scheds,
            GROUP_CONCAT( pps_value) as sched_values,
            tot_budget.tot_qty,
            (ppmp_budget/tot_budget.tot_qty) as cost_per_qty
        ");

        $q = (($quarter-1) * 3) + 1;

        $this->db->where("ppmp_office_id" , $office_id);
        $this->db->where_in("pps_month", array($q, $q+1, $q+2));

        if($ppmp_id){
            $this->db->where("ppmp_id", $ppmp_id);
        }

        $this->db->join($this->units_table, "unit_id = ppmp_unit", "left");
        $this->db->join($this->procurement_schedules_table, "ppmp_id = pps_ppmp_id","left");
        $this->db->join("(
                    SELECT sum(pps_value) as tot_qty, pps_ppmp_id  FROM $this->procurement_schedules_table GROUP BY pps_ppmp_id
        ) as tot_budget","tot_budget.pps_ppmp_id = ppmp_id","left");
        $this->db->group_by("ppmp_id");
        $this->db->order_by("ppmp_created_date");
        $rs = $this->db->get($this->procurement_plan_table);


        return $rs->result();
    }

    public function save($data, $id = null){
        $insert = array(
            'ppmp_code'          => $data['ppmp_code'],
            'ppmp_description'   => $data['ppmp_description'],
            'ppmp_unit'          => $data['ppmp_unit'],
            'ppmp_budget'        => $data['ppmp_budget'],
            'ppmp_category_id'     => $data['ppmp_category'],
            'ppmp_office_id'     => $data['ppmp_office_id'],
            'ppmp_source_fund'   => $data['ppmp_source_fund'],
            'ppmp_created_date'  => date('Y-m-d'),
            'ppmp_created_by'    => $this->session->userdata('user_id')
        );

        if($id){
            $this->db->where('ppmp_id', $id);
            $this->db->update($this->procurement_plan_table, $insert);

            $ppmp = $id;
        }else{
            $this->db->insert($this->procurement_plan_table, $insert);
            $ppmp = $this->db->insert_id();
        }

        $this->purgeProcurementSchedule($ppmp, $data);

        return $ppmp;
    }


    public function purgeProcurementSchedule($ppmp_id, $schedule){

        $this->db->where('pps_ppmp_id', $ppmp_id);
        $this->db->delete($this->procurement_schedules_table);

        foreach($schedule['month'] as $month=>$value){

            $sched = array(
                'pps_ppmp_id'   => $ppmp_id,
                'pps_month' => $month,
                'pps_value' => $value
            );

            $this->db->insert($this->procurement_schedules_table, $sched);
        }

    }

}
