<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Groups extends MY_Controller {

    public function __construct(){

        parent::__construct();

        $this->load->model('groups_model');
    }

    public function index()
    {

        $groups = $this->groups_model->getGroups();

        $data['groups'] = $groups;

        $this->load->view('default/header');
        $this->load->view('default/sidebar', $this->sidebar);
        $this->load->view('users/groups', $data);
        $this->load->view('default/footer');
    }

    public function getGroups(){

        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        $groups = $this->groups_model->getLimitGroups($page);
        $rows = $this->groups_model->countRows();
        $info = ['totalRecords'=> $rows, 'recordCount'=> count($groups), 'currentPage'=>$page, 'totalPages'=>ceil($rows/10)];
        $resultSet['info'] = $info;
        $resultSet['data'] = $groups;

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultSet) );
    }

    public function addGroup($id=null)
    {
        $data['groups'] = $this->groups_model->getGroupsById($id);
        $this->load->view('users/modal/add_group', $data);
    }

    public function saveGroup(){
        $post = $_POST;

        $data = array(
            'name' => $post['name'],
            'description'   => $post['description']
        );

        $rs = $this->groups_model->save($data, $post['id']);

        if($rs){
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('action'=>$post['action'], 'status'=>'success', 'lastid' => $rs )) );
        }
    }
}
