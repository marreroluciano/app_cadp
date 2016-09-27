<?php
  class Student_model extends CI_Model{
      
    function __construct(){
      parent::__construct();      
    }  

    /* recupera todos los estudiantes no registrados como usuario */
    function get_unregistered_students(){
      $this->db->select('student_id');
      $query = $this->db->get('user');
      $query = $query->result();
      $ignore = array();
      foreach ($query as $key => $value) {
        $ignore[] = $value->student_id;       
      }
      $this->db->select('id, dni, surname_and_name, file_number');
      $this->db->where_not_in('id', $ignore);
      $query = $this->db->get('student');      
      return($query->result());
    }

    /* recupera el estudiante que posea el id y el dni recibido como parámetro */
    function check_user_dni($dni, $student_id){
      $this->db->where('id', $student_id);
      $this->db->where('dni', $dni);
      $query = $this->db->get('student');
      return($query->result());
    }
}
?> 