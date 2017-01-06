<?php
  class Evaluation_model extends CI_Model{
      
    function __construct(){
      parent::__construct();      
    }

    /* obtiene las evaluaciones de un estudiante */
    function get_evaluations ($student_id){
      $this->db->select('date_hour, evaluation_instance.detail as instance, mark.detail as mark, publication_date');
      $this->db->from('student_evaluation_mark');
      $this->db->join('evaluation', 'evaluation.id = student_evaluation_mark.evaluation_id');
      $this->db->join('evaluation_instance', 'evaluation_instance.id = evaluation.evaluation_instance_id');
      $this->db->join('mark', 'mark.id = student_evaluation_mark.mark_id');
      $this->db->where('student_id', $student_id);
      $query = $this->db->get();
      return($query->result());
    }

    /* cantidad de evaluaciones de un estudiante */
    function number_evaluations ($student_id){
      $this->db->from('student_evaluation_mark');      
      $this->db->where('student_id', $student_id);
      return($this->db->count_all_results());
    }
}
?> 