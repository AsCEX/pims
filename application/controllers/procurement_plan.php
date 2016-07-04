<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Procurement_plan extends MY_Controller {

    public function __construct(){

        parent::__construct();

        $this->load->model('procurement_plan_model', 'ppmp_model');
        $this->load->model('offices_model', 'office_model');
        $this->load->model('categories_model', 'cat_model');
        $this->load->model('units_model');
        $this->load->model('source_funds_model');
    }

    public function index()
    {

        $data['ppmp'] = $this->ppmp_model->getProcurementPlan();

        $data['offices'] = $this->office_model->getOffices();
        $data['categories'] = $this->cat_model->getCategories();
        $data['units'] = $this->units_model->getUnits();
        $data['funds'] = $this->source_funds_model->getFunds();

        $this->load->view('default/header');
        $this->load->view('default/sidebar', $this->sidebar);
        $this->load->view('procurement_plan/index', $data);


        $this->load->view('default/footer');
    }

    public function getProcurementPlans(){

        $page = (isset($_GET['page']) && $_GET['page'] != 'undefined' ) ? $_GET['page'] : 1;

        $pr_id = $this->input->get('pr_id');
        $where = array(
            'office' => $this->input->get('office'),
            'quarter' => $this->input->get('quarter')
        );


        $ppmp = $this->ppmp_model->getLimitProcurementPlan($pr_id, $where, $page);
        $rows = $this->ppmp_model->countRows();
        $new_ppmp = array();
        foreach($ppmp as $p){
            $temp = (array) $p;
            $scheds = explode(",", $temp['scheds']);
            $sched_values = explode(",", $temp['sched_values']);

            $temp['id'] = $p->ppmp_id;
            for($i=1;$i<=12;$i++){
                $temp['sched_' . $i ] = 0;
            }

            foreach($scheds as $key=>$sched ){
                $temp['sched_' . $sched] = $sched_values[$key];
            }

            $new_ppmp[] = $temp;
        }

        $info = ['totalRecords'=> $rows, 'recordCount'=> count($new_ppmp), 'currentPage'=>$page, 'totalPages'=>ceil($rows/10)];
        $resultSet['info'] = $info;
        $resultSet['data'] = $new_ppmp;

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultSet) );

    }

    public function create($id = null){
        $ppmp = $this->ppmp_model->getProcurementPlanById($id);

        $new_ppmp=array();
        if($ppmp){

            $new_ppmp = (array) $ppmp;
            $scheds = explode(",", $new_ppmp['scheds']);
            $sched_values = explode(",", $new_ppmp['sched_values']);

            $new_ppmp['id'] = $ppmp->ppmp_id;
            for($i=1;$i<=12;$i++){
                $new_ppmp['sched_' . $i ] = 0;
            }

            foreach($scheds as $key=>$sched ){
                $new_ppmp['sched_' . $sched] = $sched_values[$key];
            }
        }


        $data['ppmp'] = $new_ppmp;

        $data['offices'] = $this->office_model->getOffices();
        $data['categories'] = $this->cat_model->getCategories();
        $data['units'] = $this->units_model->getUnits();
        $data['funds'] = $this->source_funds_model->getFunds();


        $this->load->view('procurement_plan/modals/add', $data);
    }

    public function add_procurement_plan(){

        $post = $_POST;
        $ppmp_id = $this->ppmp_model->save($post, $post['id']);


        if($ppmp_id){
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('action'=>$post['action'], 'status'=>'success', 'lastid' => $ppmp_id )) );
        }

    }


    public function savePPMP(){
        $post = $_POST;

        $data = array(
            'business_name'   => $post['business_name'],
            'first_name'   => $post['first_name'],
            'middle_name'   => $post['middle_name'],
            'last_name'   => $post['last_name'],
            'ext_name'   => $post['ext_name'],
            'address'   => $post['address'],
        );

        $rs = $this->suppliers_model->save($data, $post['id']);

        if($rs){
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('action'=>$post['action'], 'status'=>'success', 'lastid' => $rs )) );
        }
    }


    // For datatables
    public function getProcurement(){

        $office = isset($_POST['office']) ? $_POST['office'] : 1;
        $quarter = isset($_POST['quarter']) ? $_POST['quarter'] : 3;

        $ppmp = $this->ppmp_model->getProcurementPlanWhere($office, $quarter);

        $data['data'] = array();

        $new_ppmp = array();
        foreach($ppmp as $p){
            if($p->qty > 0)
                $new_ppmp[] = $p;
        }

        foreach($new_ppmp as $p){
            $budget = $p->ppmp_budget / $p->tot_qty;
            $data['data'][] = array($p->ppmp_id, $p->ppmp_code, $p->ppmp_description, $p->qty, $p->unit_name, $p->qty * $budget);
        }

        echo json_encode($data);
    }


    public function getProcurementPlanById($id = null){

        $ppmp = $this->ppmp_model->getProcurementPlanWhere(array('id' => $id));

        echo json_encode(reset($ppmp));
    }
}
