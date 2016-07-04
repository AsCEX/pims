<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchased_order extends MY_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('purchased_request_model', 'pr_model');
        $this->load->model('purchased_po_model', 'po_model');
        $this->load->model('procurement_plan_model', 'ppmp_model');
        $this->load->model('offices_model', 'office_model');
        $this->load->model('categories_model', 'cat_model');
        $this->load->model('units_model');
        $this->load->model('source_funds_model');
    }

    public function index()
    {

        $pr = $this->po_model->getPurchasedRequest();
        $data['pr'] = $pr;

        $this->load->view('default/header');
        $this->load->view('default/sidebar');
        $this->load->view('purchased_order/index', $data);
        $this->load->view('default/footer');
    }

}
