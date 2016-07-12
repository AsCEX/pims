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
        $this->load->model('users_model');
        $this->load->model('source_funds_model');
    }

    public function index()
    {

        $pr = $this->pr_model->getPurchasedRequest();

        $data['pr'] = $pr;

        $this->load->view('default/header');
        $this->load->view('default/sidebar', $this->sidebar);
        $this->load->view('purchased_request/index', $data);
        $this->load->view('default/footer');
    }



    public function getPurchasedRequest(){

        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        $groups = $this->pr_model->getLimitRequest($page);
        $rows = $this->pr_model->countRows();
        $info = ['totalRecords'=> $rows, 'recordCount'=> count($groups), 'currentPage'=>$page, 'totalPages'=>ceil($rows/10)];
        $resultSet['info'] = $info;
        $resultSet['data'] = $groups;

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultSet) );

    }


    public function getProcurementPlans(){

        $page = (isset($_GET['page']) && $_GET['page'] != 'undefined' ) ? $_GET['page'] : 1;

        $pr_id = $this->input->get('pr_id');
        $where = array(
            'office' => $this->input->get('office'),
            'quarter' => $this->input->get('quarter')
        );


        $ppmp = $this->ppmp_model->getLimitProcurementPlanPR($pr_id, $where, $page);
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


    public function addRequest($pr_id = null, $id=null)
    {
        $data['pr_id'] = $pr_id;

        $request = array(
            'pr_id' => $pr_id,
            'pr_department_id' => "",
            'pr_sai_no' => "",
            'pr_sai_date' => "",
            'pr_alobs_no' => "",
            'pr_alobs_date' => "",
            'pr_quarter' => "",
            'pr_purpose' => "",
            'pr_section' => "",
            'pr_requested_by'   => ''
        );

        $pr = $this->pr_model->getRequestById($pr_id);
        if($pr){
            $data['requests'] = $pr;
        }else{
            $data['requests'] = (object) $request;
        }

        $data['offices'] = $this->office_model->getOffices();
        $data['users'] = $this->users_model->getUsers();
        $this->load->view('purchased_request/modal/add', $data);
    }


    public function editItems($ppmp_id=null)
    {


        $quarter = $this->input->get('quarter');
        $office = $this->input->get('office');
        $pr_id = $this->input->get('pr_id');



        $items = (array) $this->pr_model->getItems($ppmp_id, $pr_id);

        if($items){
            $items['pr_items'] = $this->pr_model->getItemDetails($items['pri_id']);

            if($items['pr_items']){

                foreach($items['pr_items'] as &$pr_item){
                    $pr_item['item_details'] = $this->pr_model->getItemSpecs($pr_item['prid_id']);
                }
            }

        }else{
            $items = $this->session->userdata("pri_{$ppmp_id}");
        }


//        pre_print($items);

        if($items){
            $data['items'] = (array)$items;
        }else{
            $ppmp = $this->ppmp_model->getProcurementPlanWhere($office, $quarter, $ppmp_id);
            $ppmp = reset($ppmp);


            $data['items'] = array(
                                'pri_id' => '',
                                'pri_pr_id'     => '',
                                'pri_ppmp_id'     => $ppmp_id,
                                'pri_qty'    => $ppmp->qty,
                                'pri_description' => '',
                                'pri_cost'   => $ppmp->qty * $ppmp->cost_per_qty,
                                'pr_id'   => '',
                                'pr_items'      => array()
                            );
        }


        $data['ppmp_id'] = $ppmp_id;
        $data['pr_id'] = $pr_id;
        $data['requests'] = $this->pr_model->getRequestById($ppmp_id);
        $data['units'] = $this->units_model->getUnits();
        $this->load->view('purchased_request/modal/pr_items', $data);
    }

    public function save_request(){

        $pr_id = $this->input->post('pr_id');
        $old_pr = ($pr_id) ? true : false;

        $insert = array(
            'pr_department_id' => $this->input->post('office_id'),
            'pr_sai_no'        => $this->input->post('pr_sai_no'),
            'pr_sai_date'      => $this->input->post('pr_sai_date'),
            'pr_alobs_no'      => $this->input->post('pr_alobs_no'),
            'pr_alobs_date'    => $this->input->post('pr_alobs_date'),
            'pr_quarter'       => $this->input->post('pr_quarter'),
            'pr_purpose'       => $this->input->post('pr_purpose'),
            'pr_section'       => $this->input->post('pr_section'),
            'pr_requested_by'  => $this->input->post('pr_requested_by')
        );

        $pr_id = $this->pr_model->savePurchasedRequest($insert, $pr_id);


        $ppmp_ids = $this->input->post('pr_ppmp_id') ? $this->input->post('pr_ppmp_id') : array();
        $items = $this->pr_model->getItemsWithPPMP($pr_id);
        $deleted_items = get_deleted_items($items, $ppmp_ids);

        foreach($deleted_items as $deleted_item){
            $this->pr_model->deleteItem($deleted_item);
        }

        foreach($ppmp_ids as $ppmp_id){
            if(!in_array($ppmp_id, $items)){
                $pp = $this->ppmp_model->getProcurementPlanById($ppmp_id, array('quarter'=> $this->input->post('pr_quarter'), 'office'=>$this->input->post('office_id') ));

                $pri = array(
                    'pri_pr_id' => $pr_id,
                    'pri_ppmp_id'   => $pp->ppmp_id,
                    'pri_qty'   => $pp->qty,
                    'pri_description'   => '',
                    'pri_cost'  => str_replace(",","",$pp->qty_cost)
                );

                $pri_id = $this->pr_model->saveItems($pri);

                $this->ppmp_model->assignPRtoPPMP($pr_id, $pp->ppmp_id, $this->input->post('pr_quarter'));

                $this->processTempItems($pr_id, $pp->ppmp_id, $pri_id);
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('action'=> ($this->input->post('pr_id')) ? 'add':'edit', 'status'=>'success', 'lastid' => $pr_id )) );

    }

    private function processTempItems($pr_id, $ppmp_id=null, $pri_id = null){
        $item = $this->session->userdata('pri_' . $ppmp_id);

        $pri = array(
            'pri_description'   => $item['pri_description'],
        );
//        pre_print("ITEMS");
//        pre_print($pri);

        $this->pr_model->saveItems($pri, $pri_id);

        if($item['pr_items']){
//            pre_print("DETAILS");
            foreach($item['pr_items'] as $detail){
                $prid = array(
                    'prid_pri_id'       => $pri_id,
                    'prid_title'        => $detail['prid_title'],
                    'prid_description'  => $detail['prid_description'],
                    'prid_cost'         => str_replace(",","", $detail['prid_cost'])
                );

//                pre_print($prid);

                $prid_id = $this->pr_model->saveItemDetails($prid);
                if($detail['item_details']){
//                    pre_print("SPECS");
                    foreach($detail['item_details'] as $spec){

                        $prs = array(
                            'prs_prid_id'   => $prid_id,
                            'prs_qty'       => $spec['prs_qty'],
                            'prs_unit'      => $spec['prs_unit'],
                            'prs_name'      => $spec['prs_name'],
                            'prs_cost'      => str_replace(",","", $spec['prs_cost'])
                        );
//                        pre_print($prs);

                        $prs_id = $this->pr_model->saveItemSpecs($prs);

                    }
                }
            }
        }

        $this->session->unset_userdata("pri_{$ppmp_id}");
    }

    public function saveItems(){

        $items = $_POST;
        // unset the index 0 of pr_items, serves as a template for the repeater fields
        unset($items['pr_items'][0]);


//        pre_print($items);
        $ppmp_id = $this->input->post('pri_ppmp_id');
        $pri_id = $this->input->post('pri_id');
        $pr_id = $this->input->post('pri_pr_id');

        if($pri_id){
            $desc = $this->input->post('pri_description');
            $pri = array(
                'pri_description'   => $desc,
            );
            $this->pr_model->saveItems($pri, $pri_id);

            if($items['pr_items']){
                foreach($items['pr_items'] as $detail){
                    $prid = array(
                        'prid_pri_id'       => $pri_id,
                        'prid_title'        => $detail['prid_title'],
                        'prid_description'  => $detail['prid_description'],
                        'prid_cost'         => $detail['prid_cost']
                    );

                    $prid_id = $this->pr_model->saveItemDetails($prid, $detail['prid_id']);
                    if($detail['item_details']){
                        foreach($detail['item_details'] as $spec){

                            $prs = array(
                                'prs_prid_id'   => $prid_id,
                                'prs_qty'       => $spec['prs_qty'],
                                'prs_unit'      => $spec['prs_unit'],
                                'prs_name'      => $spec['prs_name'],
                                'prs_cost'      => $spec['prs_cost']
                            );

                            $prs_id = $this->pr_model->saveItemSpecs($prs, $spec['prs_id']);

                        }
                    }
                }
            }

        }else{
            $this->session->set_userdata("pri_{$ppmp_id}" , $items);
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('action'=> ($pr_id) ? 'add':'edit', 'status'=>'success', 'lastid' => $pr_id )) );

    }

    public function getRequestItems(){


        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        $items = $this->pr_model->getRequestItems($page);
        $rows = $this->pr_model->countItemRows();
        $info = ['totalRecords'=> $rows, 'recordCount'=> count($items), 'currentPage'=>$page, 'totalPages'=>ceil($rows/10)];
        $resultSet['info'] = $info;
        $resultSet['data'] = $items;

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultSet) );
    }

}
