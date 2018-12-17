<?php

class Student extends CI_Model
{
    public $firstname;
    public $lastname;
    public $email;
    public $username;
    public $password;
    public $user_type;
    public $department;
    public $creation_date;

    /* Create a new student account */
    public function insert_student($data)
    {
        $this->firstname     = $data['firstname'];
        $this->lastname      = $data['lastname'];
        $this->email         = $data['email'];
        $this->username      = strtolower(substr($this->firstname, 0, 1)) . strtolower($this->lastname); // Making the username from the firstname and lastname - first letter in firstname and full lastname joined
        $this->password      = $data['password'];
        $this->user_type     = 1;
        $this->department    = 1;
        $this->creation_date = date('Y-m-d');

        $this->db->set($this);
        $this->db->insert('users');
        return $this->db->insert_id(); // Inserted Student ID
    }

    public function getIdByEmail($email)
    {
        $this->db->select("id");
        $query = $this->db->get_where('users', array('email' => $email));

        if ($query->num_rows() == 1) {
            return $query->first_row()->id;
        }
        return false;
    }

    public function getIdByEmailAndPassword($email, $password)
    {
        $this->db->select("id");
        $query = $this->db->get_where('users', array('email' => $email, 'password' => $password));

        if ($query->num_rows() == 1) {
            return $query->first_row()->id;
        }
        return false;
    }

    public function getUserTypeById($userId)
    {
        $this->db->select("user_type");
        $query = $this->db->get_where('users', array('id' => $userId));

        if ($query->num_rows() == 1) {
            return $query->first_row()->user_type;
        }
        return false;
    }

    public function getUserDetailById($userId)
    {
        $this->db->select("*");
        $query = $this->db->get_where('users', array('id' => $userId));

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
        return false;
    }

    /* Check if the student is enrolled to the course ID */
    public function checkIfCourseEnrolled($studentId, $courseId)
    {
        $this->db->select("id");
        $query = $this->db->get_where('course_enrolled', array('student_id' => $studentId, 'course_id' => $courseId));

        if ($query->num_rows() > 0) {
            /* Student has already enrolled for the Course */
            return true;
        }
        return false;
    }

    public function updatePassword($userId, $password)
    {
        $this->db->set('password', $password);
        $this->db->where('id', $userId);
        $this->db->update('users');

        if ($this->db->affected_rows()) {
            return true;
        }
        return false;

    }

}

?>