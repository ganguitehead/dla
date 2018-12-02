<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends CI_Controller
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
        $this->load->view('templates/student_account/course_list');
    }
}
