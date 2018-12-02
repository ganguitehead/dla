<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('student');
        $this->load->model('faculty');
        $this->load->helper('app');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index()
    {
        if (!is_logged_in()) {
            redirect(base_url("/"));
        }

        $this->load->view('templates/common/chat');
    }
}
