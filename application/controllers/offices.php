<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Offices extends MY_Controller {

    public function __construct(){

        parent::__construct();

        $this->load->model('offices_model');
    }

    public function index()
    {

        $groups = $this->offices_model->getOffices();

        $data['groups'] = $groups;

        $this->load->view('default/header');
        $this->load->view('default/sidebar', $this->sidebar);
        $this->load->view('offices/index', $data);
        $this->load->view('default/footer');
    }

    public function getOffices(){

        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        $groups = $this->offices_model->getLimitOffices($page);
        $rows = $this->offices_model->countRows();
        $info = ['totalRecords'=> $rows, 'recordCount'=> count($groups), 'currentPage'=>$page, 'totalPages'=>ceil($rows/10)];
        $resultSet['info'] = $info;
        $resultSet['data'] = $groups;

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultSet) );
    }

    public function addOffice($id=null)
    {
        $data['offices'] = $this->offices_model->getOfficeById($id);
        $this->load->view('offices/modal/add', $data);
    }

    public function saveOffice(){
        $post = $_POST;

        $data = array(
            'code' => $post['code'],
            'initial'   => $post['initial'],
            'name' => $post['name']
        );

        $rs = $this->offices_model->save($data, $post['id']);

        if($rs){
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('action'=>$post['action'], 'status'=>'success', 'lastid' => $rs )) );
        }
    }
}
