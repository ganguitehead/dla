<?php

class Faculty extends CI_Model
{
    public $firstname;
    public $lastname;
    public $email;
    public $username;
    public $password;
    public $user_type;
    public $department;
    public $creation_date;

    /* Create a new faculty account */
    public function insert_faculty($data)
    {
        $this->firstname = $data['firstname'];
        $this->lastname  = $data['lastname'];
        $this->email     = $data['email'];
        // Making the username from the firstname and lastname - first letter in firstname and full lastname joined
        $this->username      = strtolower(substr($this->firstname, 0, 1)) . strtolower($this->lastname);
        $this->password      = $data['password'];
        $this->user_type     = 2;
        $this->department    = $data['department'];
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
}

?>