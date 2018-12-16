<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller
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

            $courseDetailArray = array();

            if ($loggedInUserType = getLoggedInUserType()) {
                switch ($loggedInUserType) {
                    case 1:
                        $userCourses = $this->course->getAllCoursesByStudentId($user_id);

                        foreach ($userCourses as $userCourse) {
                            $detail = $this->course->getCourseById($userCourse["course_id"]);

                            array_push($courseDetailArray, $detail);
                        }

                        break;

                    case 2:
                        $courseDetailArray = $this->course->getAllCoursesByFacultyId($user_id);
                        break;
                }
            }
        }

        $data = array("userCourses" => $courseDetailArray);

        $this->load->view('templates/common/chat', $data);
    }


}
