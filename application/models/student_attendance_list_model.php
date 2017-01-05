<?php
  class Student_attendance_list_model extends CI_Model{
      
    function __construct(){
      parent::__construct();      
    }

    /* obtiene las ausencias de un estudiante */
    function get_absents($student_id){
      $this->db->join('type_attendance', 'type_attendance.id = student_attendance_list.type_attendance_id');
      $this->db->where('type_attendance_id <>', 2);
      $this->db->where('student_id', $student_id);
      $this->db->order_by("date", "desc");
      $query = $this->db->get('student_attendance_list');
      return($query->result());
    }

    /* cantidad de inasistencias */ 
    function number_absences($student_id, $type_absence){
      $this->db->from('student_attendance_list');
      $this->db->where('type_attendance_id', $type_absence);
      $this->db->where('student_id', $student_id);
      return($this->db->count_all_results());
    }
  }
?> 