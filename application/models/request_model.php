<?php
  class Request_model extends CI_Model{
      
    function __construct(){
      parent::__construct();      
    }

    /* obtiene las solicitudes de un usuario */
    function get_user_requests($id_user){
      $this->db->select('request.id, date, start_date_justification, end_date_justification, type_request.detail as type_request_detail, request_state.detail as request_state_detail, request_state.class as request_class, id_request_state');
      $this->db->join('type_request', 'type_request.id = request.id_request_type');
      $this->db->join('request_state', 'request_state.id = request.id_request_state');
      $this->db->where('user_id',$id_user);
      $this->db->order_by("date", "desc");
      $query = $this->db->get('request');
      return($query->result());
    }

    /* inserta una nueva solicitud */
    function insert_request($data){
      return($this->db->insert('request', $data));
    }
}
?> 