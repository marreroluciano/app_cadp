<?php
  class Turn_model extends CI_Model{
      
    function __construct(){
      parent::__construct();      
    }

    /* obtiene los turnos */
    function get_turns(){      
      $query = $this->db->get('turn');
      return($query->result());
    }

    /* obtiene un turno */
    function get_turn($id_turn){
      $this->db->where('id', $id_turn);
      $query = $this->db->get('turn');
      return($query->result());
    }
}
?> 