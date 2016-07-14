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

    /* obtiene un tipo de solicitud */
    function get_request_type($id_request_type){
      $this->db->where('id', $id_request_type);
      $query = $this->db->get('type_request');
      return($query->result());
    }
}
?> 