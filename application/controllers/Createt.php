<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Createt extends CI_Controller
{
    public function index()
    {
        $this->load->view('templates/teacher_account/create_account_teacher');
    }
}
