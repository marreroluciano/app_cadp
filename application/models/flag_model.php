<?php
  class Flag_model extends CI_Model{
      
    function __construct(){
      parent::__construct();      
    }

    /* obtiene un flag */
    function get_flag($key_value){
      $this->db->where('key_value', $key_value);
      $query = $this->db->get('flag');
      return($query->result());
    }    
}
?> 