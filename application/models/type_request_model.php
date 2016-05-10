<?php
  class Type_request_model extends CI_Model{
      
    function __construct(){
      parent::__construct();      
    }

    /* obtiene los tipos de solicitudes */
    function get_requests_types(){      
      $query = $this->db->get('type_request');
      return($query->result());
    }    
}
?> 