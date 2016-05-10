<?php
  class Request_model extends CI_Model{
      
    function __construct(){
      parent::__construct();      
    }

    /* obtiene las solicitudes de un usuario */
    function get_user_requests($id_user){            
      $this->db->where('user_id',$id_user);
      $query = $this->db->get('request');
      return($query->result());
    }    
}
?> 