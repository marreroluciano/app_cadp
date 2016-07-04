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
}
?> 