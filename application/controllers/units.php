<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Units extends MY_Controller {

    public function __construct(){

        parent::__construct();

        $this->load->model('units_model');
    }

    public function index()
    {

        $units = $this->units_model->getUnits();

        $data['units'] = $units;

        $this->load->view('default/header');
        $this->load->view('default/sidebar', $this->sidebar);
        $this->load->view('units/index', $data);
        $this->load->view('default/footer');
    }

    public function getUnits(){

        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        $groups = $this->units_model->getLimitUnits($page);
        $rows = $this->units_model->countRows();
        $info = ['totalRecords'=> $rows, 'recordCount'=> count($groups), 'currentPage'=>$page, 'totalPages'=>ceil($rows/10)];
        $resultSet['info'] = $info;
        $resultSet['data'] = $groups;

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultSet) );
    }

    public function addUnit($id=null)
    {
        $data['units'] = $this->units_model->getUnitById($id);
        $this->load->view('units/modal/add', $data);
    }

    public function saveUnit(){
        $post = $_POST;

        $data = array(
            'unit_name' => $post['unit_name']
        );

        $rs = $this->units_model->save($data, $post['id']);

        if($rs){
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('action'=>$post['action'], 'status'=>'success', 'lastid' => $rs )) );
        }
    }
}
