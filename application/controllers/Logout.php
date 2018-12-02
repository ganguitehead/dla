<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller
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
        if (is_logged_in()) {
            $this->session->unset_userdata('user_id');
            $this->session->unset_userdata('email');
            $this->session->unset_userdata('logged_in');
            $this->session->unset_userdata('user_type');
        }
        redirect(base_url('/'));
    }
}
