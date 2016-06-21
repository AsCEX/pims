<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

    public function __construct(){

        parent::__construct();

        $this->load->model('users_model');
    }

    public function index()
    {

        $users = $this->users_model->getUsers();

        $data['users'] = $users;

        $this->load->view('default/header');
        $this->load->view('default/sidebar', $this->sidebar);
        $this->load->view('users/index', $data);
        $this->load->view('default/footer');
    }
}
