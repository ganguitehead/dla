<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notify extends CI_Controller
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
        $this->load->model('messages');
        $this->load->library('email');
    }

    public function index()
    {
        $todayDayIndex = date("N");

        /* Get the courses on that day and enrolled student emails */
        $allCourseSlots = $this->courseslots->getAllSlots();

        foreach ($allCourseSlots as $courseSlot) {
            $courseId               = $courseSlot["course_id"];
            $courseDetail           = $this->course->getCourseById($courseId);
            $slotDays               = explode("-", $courseSlot["day"]);
            $courseEnrolledStudents = $this->course->getStudentsFromCourse($courseId);

            foreach ($slotDays as $slotDay) {

                /* Current day is class Day - send an notification email*/
                if ($todayDayIndex == intval($slotDay)) {

                    /* Time slot id */
                    $timeSlotStartId = $courseSlot["timeslot_start"];

                    /* Get the timeslot value from slot id */
                    $timeSlotValue          = $this->courseslots->getTimeBySlotId($timeSlotStartId);
                    $timeSlotValueFormatted = date("h:i", strtotime($timeSlotValue));

                    /* Current time + 5 minutes */
                    $currentTimePlus5Minutes       = strtotime('+15 minutes', time());
                    $currentTimePlus5MinutesFormat = date("h:i", $currentTimePlus5Minutes);

                    $classStartTime = $timeSlotValueFormatted;

                    /* Send email  if the times  match*/
                    if ($classStartTime == $currentTimePlus5MinutesFormat) {

                        foreach ($courseEnrolledStudents as $courseEnrolledStudent) {

                            $studentDetail = $this->student->getUserDetailById($courseEnrolledStudent["student_id"]);
                            $studentEmail  = $studentDetail["email"];

                            $this->email->from('info@ela.com', 'ela-notification');
                            $this->email->to($studentEmail);
                            $this->email->set_mailtype("html");

                            $this->email->subject('Your class starts in 15 minutes');

                            $data = array("course" => $courseDetail, "student" => $studentDetail, "time" => $timeSlotValue);

                            $message = $this->load->view('templates/common/email_notify', $data, true);
//                            $this->load->view('templates/common/email_notify', $data, true);

                            $this->email->message($message);
                            $this->email->send();
                        }

                    } else {
                        // Do  not send email
                        echo $timeSlotValueFormatted . " not equal to " . $currentTimePlus5MinutesFormat;
                    }
                }
            }
        }

//        $this->email->from('info@ela.com', 'ela-help');
//        $this->email->to('chitta.sharan@gmail.com');
//        $this->email->set_mailtype("html");
//
//        $this->email->subject('Your class starts in 5 minutes');
//
//        $message = $this->load->view('templates/common/email_notify', '', true);
//
//        $this->email->message($message);
//
//        $this->email->send();
    }

    public function addCronSchedules()
    {
        $allCourseSlots = $this->courseslots->getAllSlots();

        foreach ($allCourseSlots as $allCourseSlot) {

            $slotStartId = $allCourseSlot["timeslot_start"];

            $slotTimeStart = $this->courseslots->getTimeBySlotId($slotStartId);

        }
    }

    public function now()
    {
        $todayDayIndex = date("N");

        /* Get the courses on that day and enrolled student emails */
        $allCourseSlots = $this->courseslots->getAllSlots();

        foreach ($allCourseSlots as $courseSlot) {
            $courseId               = $courseSlot["course_id"];
            $courseDetail           = $this->course->getCourseById($courseId);
            $slotDays               = explode("-", $courseSlot["day"]);
            $courseEnrolledStudents = $this->course->getStudentsFromCourse($courseId);

            foreach ($slotDays as $slotDay) {

                /* Current day is class Day - send an notification email*/
                if ($todayDayIndex == intval($slotDay)) {

                    /* Time slot id */
                    $timeSlotStartId = $courseSlot["timeslot_start"];

                    /* Get the timeslot value from slot id */
                    $timeSlotValue          = $this->courseslots->getTimeBySlotId($timeSlotStartId);
                    $timeSlotValueFormatted = date("h:i", strtotime($timeSlotValue));

                    /* Current time + 5 minutes */
                    $currentTimePlus5Minutes       = strtotime('+15 minutes', time());
                    $currentTimePlus5MinutesFormat = date("h:i", $currentTimePlus5Minutes);

                    foreach ($courseEnrolledStudents as $courseEnrolledStudent) {

                        $studentDetail = $this->student->getUserDetailById($courseEnrolledStudent["student_id"]);
                        $studentEmail  = $studentDetail["email"];

                        $this->email->from('info@ela.com', 'ela-notification');
                        $this->email->to($studentEmail);
                        $this->email->set_mailtype("html");

                        $this->email->subject('Your class starts in 5 minutes');
                        $data = array("course" => $courseDetail, "student" => $studentDetail, "time" => $timeSlotValue);

                        $message = $this->load->view('templates/common/email_notify', $data, true);

                        $this->email->message($message);
                        $this->email->send();

                    }
                }
            }
        }


    }
}
