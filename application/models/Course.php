<?php

class Course extends CI_Model
{
    /* Creates a new course */
    public function insert_course($data)
    {
        $courseName      = $data['course_name'];
        $courseCode      = $data['course_code'];
        $courseDept      = $data['course_dept'];
        $courseDesc      = $data['course_desc'];
        $courseSeats     = $data['course_seats_available'];
        $faculty_user_id = $data['faculty_user_id'];

        $data = array(
            'name' => $courseName,
            'code' => $courseCode,
            'description' => $courseDesc,
            'seats_available' => $courseSeats,
            'department_id' => $courseDept,
            'faculty_user_id' => $faculty_user_id
        );

        $this->db->set($data);
        $this->db->insert('courses');
        return $this->db->insert_id(); // Inserted course ID
    }

    public function getIdByCourseCode($code)
    {
        $this->db->select("id");
        $query = $this->db->get_where('courses', array('code' => $code));

        if ($query->num_rows() > 0) {
            return $query->first_row()->id;
        }
        return false;
    }

    public function getCoursesByFacultyId($userId)
    {
        $this->db->select("*");
        $query = $this->db->get_where('courses', array('faculty_user_id' => $userId));

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function getAvailableTimeSlots()
    {
        $query = $this->db->get('timeslots_available');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function getAllCourses()
    {
        $query = $this->db->get('courses');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function getCourseById($id)
    {
        $this->db->select("*");
        $query = $this->db->get_where('courses', array('id' => $id));

        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }

    public function getAvailableSeats($courseId)
    {
        $this->db->select("*");
        $query = $this->db->get_where('courses', array('id' => $courseId));

        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }


    public function studentEnroll($data)
    {
        $courseSection = $data['course_student_enroll_section'];
        $courseId      = $data['course_student_enroll_course_id'];
        $seats         = $data['course_student_enroll_course_seats_avbl'];
        $studentId     = $data['student_id'];

        $data = array(
            'student_id' => $studentId,
            'course_id' => $courseId,
            'section_id' => $courseSection,
            'date' => date('Y-m-d'),
        );

        $this->db->set($data);
        $this->db->insert('course_enrolled');
        return $this->db->insert_id(); // Inserted course ID
    }
}

?>