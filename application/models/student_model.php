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

    /* recupera un estudiante por su id */
    function get_student($student_id){
      $this->db->select('student.id as student_id, dni, surname_and_name, file_number, turn.detail as turn, student.promotion');
      $this->db->join('turn', 'turn.id = student.turn_id', 'left');
      $this->db->where('student.id', $student_id);
      $query = $this->db->get('student');
      return($query->result());
    }
    
    /* edita los datos del estudiante */
    function edit_student($student_id, $data){
      $this->db->where('id', $student_id);
      return($this->db->update('student', $data));
    }

    /* setea el turno del alumno */
    function set_turn($student_id, $turn_id){
      $data = array('turn_id' => $turn_id);
      $this->db->where('id', $student_id);
      return($this->db->update('student', $data));
    }
}
?> 