<?php

class MY_Controller extends CI_Controller {

    public $sidebar;
    function __construct()
    {
        parent::__construct();

        $this->load->library(array('ion_auth','form_validation'));
        $this->load->helper(array('url','language'));

        if(!$this->ion_auth->logged_in())
            redirect('auth/login');

        $this->sidebar = array("sidebar"=>"LSDKJFS","ss"=>"SDJFLS");
        //$this->output->enable_profiler(TRUE);
    }

}