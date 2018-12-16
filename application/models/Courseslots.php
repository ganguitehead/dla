<?php

class Courseslots extends CI_Model
{
    /* Creates a new course slot */
    public function insert_courseslots($data)
    {
        $courseId    = $data['course_schedule_selectcourse'];
        $sectionCode = $data['course_schedule_sectioncode'];
        $days        = implode("-", $data['course_schedule_days']);
        $slotStart   = $data['course_schedule_fromtime'];
        $slotEnd     = $data['course_schedule_totime'];

        $data = array(
            'course_id' => $courseId,
            'section_code' => $sectionCode,
            'day' => $days,
            'timeslot_start' => $slotStart,
            'timeslot_end' => $slotEnd,
        );

        $this->db->set($data);
        $this->db->insert('course_timeslots');
        return $this->db->insert_id(); // Inserted course ID
    }

    public function getSlotsByCourseId($id)
    {
        $this->db->select("*");
        $query = $this->db->get_where('course_timeslots', array('course_id' => $id));

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function getAllSlots()
    {
        $query = $this->db->get('course_timeslots');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function getTimeBySlotId($id)
    {
        $this->db->select("time_start");
        $query = $this->db->get_where('timeslots_available', array('id' => $id));

        if ($query->num_rows() > 0) {
            return $query->first_row()->time_start;
        }
        return false;
    }

}
?>