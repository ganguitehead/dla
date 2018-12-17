<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coursesajax extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('course');
        $this->load->model('courseslots');
        $this->load->model('student');
        $this->load->helper('app');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function course_publish()
    {
        /* Request data */
        $request     = $this->input->post();
        $missingVars = array();
        $output      = array();

        foreach ($request as $key => $data) {
            if (strlen($data) < 1) {
                array_push($missingVars, $key);
            }
        }

        if (count($missingVars) > 0) {

            $output = json_encode(array(
                'result' => false,
                'value' => "Fill all the fields and submit."
            ));

        } else {

            $faculty_user_id = $this->session->userdata('user_id');

            $request["faculty_user_id"] = $faculty_user_id;

            $data = $this->course->insert_course($request);

            if ($data) {
                $output = json_encode(array(
                    'result' => true,
                    'value' => "Course creation success."
                ));
            } else {
                $output = json_encode(array(
                    'result' => false,
                    'value' => "Error in creating the course. Try again!"
                ));
            }
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output($output);
    }

    public function course_addschedule()
    {
        /* Request data */
        $request     = $this->input->post();
        $missingVars = array();
        $output      = array();

        foreach ($request as $key => $data) {
            if (gettype($data) == 'string') {
                if (strlen($data) < 1) {
                    array_push($missingVars, $key);
                }
            }

            if (gettype($data) == 'array') {
                if (count($data) < 1) {
                    array_push($missingVars, $key);
                }
            }
        }

        if (count($missingVars) > 0 || count($request) < 1) {

            $output = json_encode(array(
                'result' => false,
                'value' => "Fill all the fields and submit."
            ));

        } else {

            $data = $this->courseslots->insert_courseslots($request);

            if ($data) {
                $output = json_encode(array(
                    'result' => true,
                    'value' => "Course schedule created."
                ));
            } else {
                $output = json_encode(array(
                    'result' => false,
                    'value' => "Error in creating the course schedule. Try again!"
                ));
            }
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output($output);
    }

    public function code_check()
    {
        $request = $this->input->post();

        $courseCode = $request["code"];

        $data = $this->course->getIdByCourseCode($courseCode);

        if ($data) {
            $output = json_encode(array(
                'result' => false,
                'value' => "Course code is not available."
            ));
        } else {
            $output = json_encode(array(
                'result' => true,
                'value' => "Course Code is available."
            ));
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output($output);
    }

    public function course_enroll_finish()
    {
        /* Request data */
        $request     = $this->input->post();
        $missingVars = array();
        $output      = array();

        foreach ($request as $key => $data) {
            if (gettype($data) == 'string') {
                if (strlen($data) < 1) {
                    array_push($missingVars, $key);
                }
            }

            if (gettype($data) == 'array') {
                if (count($data) < 1) {
                    array_push($missingVars, $key);
                }
            }
        }

        if (count($missingVars) > 0 || count($request) < 1) {

            $output = json_encode(array(
                'result' => false,
                'value' => "Fill all the fields and submit."
            ));

        } else {
            $studentId = $this->session->userdata('user_id');

            /* Check for the available slots in the course */
            $courseAvailableSeats = $this->course->getAvailableSeats($request["course_student_enroll_course_id"]);

            /* If the number of seats is less than 1 - return with false */
            if ($courseAvailableSeats < 1) {

                $output = json_encode(array(
                    'result' => false,
                    'value' => "Not enough seats in the course to enroll."
                ));

            } else {

                /* Check if the student has already enrolled for the course before trying to enroll */
                $checkStudentCourseEnrolled = $this->student->checkIfCourseEnrolled($studentId, $request["course_student_enroll_course_id"]);

                if ($checkStudentCourseEnrolled || $checkStudentCourseEnrolled == true) {

                    $output = json_encode(array(
                        'result' => false,
                        'value' => "You have already enrolled to this course."
                    ));

                } else {

                    $request["student_id"] = $studentId;
                    $data                  = $this->course->studentEnroll($request);

                    if ($data) {
                        $output = json_encode(array(
                            'result' => true,
                            'value' => "Successfully enrolled to the course."
                        ));
                    } else {
                        $output = json_encode(array(
                            'result' => false,
                            'value' => "Error in enrolling. Try again!"
                        ));
                    }

                }
            }
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output($output);
    }

    public function course_doc_upload()
    {
        $request = $this->input->post();

        if (!array_key_exists('course_id', $request)) {

            $output = json_encode(array(
                'result' => false,
                'value' => "Unable to upload the file. Refresh the page and try again"
            ));

        } else {
            $courseId = $request["course_id"];
            $file     = $_FILES["fileData"];

            $target_dir  = FCPATH . '/assets/course_files/';
            $extension   = pathinfo($_FILES["fileData"]["name"], PATHINFO_EXTENSION);
            $fileName    = "coursefile_" . $courseId . "." . $extension;
            $target_file = $target_dir . $fileName;

            if (move_uploaded_file($_FILES["fileData"]["tmp_name"], $target_file)) {

                $this->course->updateCourseFileName($fileName, $courseId);

                $output = json_encode(array(
                    'result' => true,
                    'value' => "The file " . basename($_FILES["fileData"]["name"]) . " has been uploaded."
                ));

            } else {
                $output = json_encode(array(
                    'result' => false,
                    'value' => "Error in uploading the file. Try again!"
                ));
            }
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output($output);

    }
}
