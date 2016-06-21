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
        $this->load->view('default/sidebar');
        $this->load->view('procurement_plan/index', $data);

        $this->load->view('procurement_plan/modals/add', $data);

        $this->load->view('default/footer');
    }

    public function add_procurement_plan(){


        $ppmp_id = $this->ppmp_model->create($_POST);

        if($ppmp_id){
            $this->ppmp_model->addProcurementSchedule($ppmp_id, $_POST);
        }


        echo $ppmp_id;


        exit;

    }
}
