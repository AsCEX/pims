<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suppliers extends MY_Controller {

    public function __construct(){

        parent::__construct();

        $this->load->model('suppliers_model');
    }

    public function index()
    {

        $suppliers = $this->suppliers_model->getSuppliers();

        $data['suppliers'] = $suppliers;

        $this->load->view('default/header');
        $this->load->view('default/sidebar', $this->sidebar);
        $this->load->view('suppliers/index', $data);
        $this->load->view('default/footer');
    }

    public function getSuppliers(){

        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        $groups = $this->suppliers_model->getLimitSuppliers($page);
        $rows = $this->suppliers_model->countRows();
        $info = ['totalRecords'=> $rows, 'recordCount'=> count($groups), 'currentPage'=>$page, 'totalPages'=>ceil($rows/10)];
        $resultSet['info'] = $info;
        $resultSet['data'] = $groups;

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultSet) );
    }

    public function addSupplier($id=null)
    {
        $data['suppliers'] = $this->suppliers_model->getSupplierById($id);
        $this->load->view('suppliers/modal/add', $data);
    }

    public function saveSupplier(){
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
}
