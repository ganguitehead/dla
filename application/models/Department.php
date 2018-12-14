<?php

class Department extends CI_Model
{
    public function getAllRows()
    {
        $query = $this->db->get('department');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

//    public function getIdByEmail($email)
//    {
//        $this->db->select("id");
//        $query = $this->db->get_where('users', array('email' => $email));
//
//        if ($query->num_rows() == 1) {
//            return $query->first_row()->id;
//        }
//        return false;
//    }
}

?>