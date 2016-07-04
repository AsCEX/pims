<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

    public function __construct(){

        parent::__construct();

        $this->load->model('users_model');
    }

    public function index()
    {

        $this->load->view('default/header');
        $this->load->view('default/sidebar', $this->sidebar);
        $this->load->view('users/index');
        $this->load->view('default/footer');
    }


    public function getUsers(){

        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        $groups = $this->users_model->getLimitUsers($page);
        $rows = $this->users_model->countRows();
        $info = ['totalRecords'=> $rows, 'recordCount'=> count($groups), 'currentPage'=>$page, 'totalPages'=>ceil($rows/10)];
        $resultSet['info'] = $info;
        $resultSet['data'] = $groups;

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultSet) );
    }

    public function addUser($id=null)
    {
        $data['users'] = $this->users_model->getUserById($id);
        $this->load->view('users/modal/add', $data);
    }

    public function saveUser(){
        $post = $_POST;

        $data = array(
            'u_username' => $post['username'],
            'u_password' => md5('123456'),
            'u_email'   => $post['u_email'],
            'u_firstname'   => $post['u_firstname'],
            'u_middlename'   => $post['u_middlename'],
            'u_lastname'   => $post['u_lastname'],
            'u_extname'   => $post['u_extname'],
            'u_department_id'   => $post['u_department_id'],
        );

        $rs = $this->users_model->save($data, $post['id']);

        if($rs){
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('action'=>$post['action'], 'status'=>'success', 'lastid' => $rs )) );
        }
    }
}
