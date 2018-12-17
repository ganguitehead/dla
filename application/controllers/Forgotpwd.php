<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgotpwd extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('student');
        $this->load->helper('app');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index()
    {
        if (is_logged_in()) {
            redirect(base_url("/home"));
        }

        // Based on the User type - show the Student / Faculty Dashboard
        $this->load->view('templates/common/forgot_password');
    }


}
