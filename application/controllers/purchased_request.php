<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchased_request extends MY_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('purchased_request_model', 'pr_model');
        $this->load->model('procurement_plan_model', 'ppmp_model');
        $this->load->model('offices_model', 'office_model');
        $this->load->model('categories_model', 'cat_model');
        $this->load->model('units_model');
        $this->load->model('source_funds_model');
    }

    public function index()
    {

        $pr = $this->pr_model->getPurchasedRequest();

        $data['pr'] = $pr;

        $this->load->view('default/header');
        $this->load->view('default/sidebar');
        $this->load->view('purchased_request/index', $data);
        $this->load->view('default/footer');
    }

    public function view($pr_id)
    {

        $data['pr'] = $this->pr_model->viewPurchasedRequest($pr_id);

        $this->load->view('default/header');
        $this->load->view('default/sidebar');
        $this->load->view('purchased_request/view', $data);
        $this->load->view('default/footer');
    }


    public function create(){
        $data['ppmp'] = $this->pr_model->getProcurementPlan();

        $data['offices'] = $this->office_model->getOffices();
        $data['categories'] = $this->cat_model->getCategories();
        $data['units'] = $this->units_model->getUnits();
        $data['funds'] = $this->source_funds_model->getFunds();

        $this->load->view('default/header');
        $this->load->view('default/sidebar');
        $this->load->view('purchased_request/create_request', $data);

        $this->load->view('default/footer');
    }


    public function add_purchase_request(){
        $pr_id = $this->pr_model->create($_POST);

       /* if($pr_id){

            foreach($_POST['ppmp_id'] as $ppmp_id) {
                $ppmp = $this->ppmp_model->getProcurementPlan($ppmp_id);
                $ppmp = reset($ppmp);

                $scheds = explode(",", $ppmp->sched_values);

                $months_in_a_year = 12;
                $quarter = 3; //3 months
                $start_month = ($_POST['quarter']-1) * $quarter;
                $qty = 0;
                $total_qty = array_sum($scheds);
                for($i = $start_month+1; $i<=$start_month+$quarter; $i++){
                    $qty += $scheds[$i];
                }

                $budget = ($ppmp->budget / $total_qty) * $qty;


                $pr_items = array(
                    'pr_id'             => $pr_id,
                    'ppmp_details_id'   => $ppmp->ppmp_detail_id,
                    'qty'               => $qty,
                    'description'       => $ppmp->description,
                    'cost'              => $budget
                );

                $this->pr_model->create_purchase_items($pr_items);

            }
        }*/

        redirect('purchased_request/edit_items/' . $pr_id);

    }

    public function add_pr_items(){

        $pr_items = (isset($_POST['ppmp_id'])) ? $_POST['ppmp_id'] : array();
        $pr_quarter = $_POST['pr_quarter'];
        $pr_id = $_POST['pr_id'];

        foreach($pr_items as $ppmp_id) {
            $ppmp = $this->ppmp_model->getProcurementPlan($ppmp_id);
            $ppmp = reset($ppmp);

            $scheds = explode(",", $ppmp->scheds);
            $sched_values = explode(",", $ppmp->sched_values);

            $months_in_a_year = 12;
            $quarter = 3; //3 months
            $start_month = ($pr_quarter-1) * $quarter;
            $qty = 0;
            $total_qty = array_sum($sched_values);

            foreach($scheds as $key=>$sched){
                if($sched > $start_month && $sched < $start_month+$quarter){
                    $qty += $sched_values[$key];
                }
            }

            $budget = ($ppmp->budget / $total_qty) * $qty;


            $pr_items = array(
                'pr_id'             => $pr_id,
                'ppmp_details_id'   => $ppmp->ppmp_detail_id,
                'qty'               => $qty,
                'cost'              => $budget
            );

            $this->pr_model->create_purchase_items($pr_items);

        }
    }

    public function edit_items($pr_id){


        $data['pr'] = $this->pr_model->viewPurchasedRequest($pr_id);
        $data['ppmp'] = $this->ppmp_model->getProcurementPlan();

        $this->load->view('default/header');
        $this->load->view('default/sidebar');
        $this->load->view('purchased_request/edit_purchased_request_items', $data);


        $this->load->view('purchased_request/modals/procurement_plans_modal', $data);

        $this->load->view('default/footer');
    }
}
