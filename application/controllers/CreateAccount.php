<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CreateAccount extends CI_Controller
{
    public function index()
    {
        $this->load->view('templates/student_account/create_account_student');
    }
}
