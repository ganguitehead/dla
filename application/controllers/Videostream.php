<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Videostream extends CI_Controller
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
        $userId = $this->session->userdata('user_id');

        if (is_logged_in()) {
            if ($loggedInUserType = getLoggedInUserType()) {
                switch ($loggedInUserType) {
                    case 1:
                        $courses = $this->course->getAllCoursesByStudentId($userId);
                        $data    = array("courses" => $courses);
                        $this->load->view('templates/student_account/videostream', $data);
                        break;
                    case 2:
                        $courses = $this->course->getAllCoursesByFacultyId($userId);
                        $data    = array("courses" => $courses);
                        $this->load->view('templates/teacher_account/videostream', $data);
                        break;
                }
            }
        }
    }

}
