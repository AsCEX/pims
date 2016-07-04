<?php
class my404 extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->output->set_status_header('404');
        $this->load->view('default/header');
        $this->load->view('default/sidebar');
        $this->load->view('default/my404');
        $this->load->view('default/footer');
    }
}
?>