<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('student');
        $this->load->model('faculty');
        $this->load->model('course');
        $this->load->helper('app');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('messages');
    }

    public function index()
    {
        if (!is_logged_in()) {
            redirect(base_url("/"));
        }

        if (is_logged_in()) {
            $user_id = $this->session->userdata('user_id');
            $this->load->view('templates/common/change_password');
        }

    }


}
