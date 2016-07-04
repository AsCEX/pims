<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Access_lists extends MY_Controller {

    public function __construct(){

        parent::__construct();

        $this->load->model('users_model');
    }

    public function restricted()
    {

        $this->load->view('default/header');
        $this->load->view('default/sidebar', $this->sidebar);
        $this->load->view('default/restricted');
        $this->load->view('default/footer');
    }
}
