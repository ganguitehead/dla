<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('app');
        $this->load->helper('url');
    }

    public function index()
    {
        $this->load->view('templates/prelogin_index');
    }
}
