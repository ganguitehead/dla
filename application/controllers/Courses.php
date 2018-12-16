<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('student');
        $this->load->model('department');
        $this->load->model('course');
        $this->load->model('Courseslots');
        $this->load->helper('app');
        $this->load->library('session');
        $this->load->helper('url');

        if (!is_logged_in()) {
            redirect(base_url("/"));
        }
    }

    public function index()
    {
        if (is_logged_in()) {
            if ($loggedInUserType = getLoggedInUserType()) {
                switch ($loggedInUserType) {
                    case 1:
                        $courses = $this->course->getAllCourses();
                        $data    = array("courses" => $courses);
                        $this->load->view('templates/student_account/course_list', $data);
                        break;
                    case 2:
                        $this->load->view('templates/teacher_account/course_list');
                        break;
                }
            }
        }
    }

    public function publish()
    {
        if (is_logged_in()) {
            if ($loggedInUserType = getLoggedInUserType()) {
                switch ($loggedInUserType) {
                    case 1:
                        redirect(base_url("/"));
                        break;
                    case 2:
                        $departments = $this->department->getAllRows();
                        $this->load->view('templates/courses/publish', array("departments" => $departments));
                        break;
                }
            }
        }
    }

    public function AddSchedule()
    {
        if (is_logged_in()) {
            if ($loggedInUserType = getLoggedInUserType()) {
                switch ($loggedInUserType) {
                    case 1:
                        redirect(base_url("/"));
                        break;
                    case 2:
                        $timeSlots      = $this->course->getAvailableTimeSlots();
                        $facultyCourses = $this->course->getCoursesByFacultyId($this->session->userdata('user_id'));
                        $data           = array("slots" => $timeSlots, "courses" => $facultyCourses);

                        $this->load->view('templates/courses/add_schedule', $data);
                        break;
                }
            }
        }
    }

    public function enroll()
    {
        if (is_logged_in()) {
            if ($loggedInUserType = getLoggedInUserType()) {
                switch ($loggedInUserType) {
                    case 1:
                        if ($this->uri->segment('3') != null && $this->uri->segment('3') == 'cid') {
                            $courseId = $this->uri->segment('4');
                            $courseId = base64_decode($courseId);  /* Decode the encoded course ID */

                            $courseData = $this->course->getCourseById($courseId);

                            if (!$courseData) {
                                echo "Invalid Course ID";
                            } else {
                                $courseSlots = $this->courseslots->getSlotsByCourseId($courseId);
                                $data        = array("course" => $courseData, "sections" => $courseSlots);
                                $this->load->view('templates/courses/student_enroll', $data);
                            }

                        } else {
                            echo "Missing request details.";
                        }
                        break;
                    case 2:
                        redirect(base_url("/"));
                        break;
                }
            }
        }
    }

}
