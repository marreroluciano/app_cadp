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

    /* obtiene una solicitud */
    function get_user_request($request_id, $id_user){
      $this->db->select('request.id, request.date, request.requested_shift, request.start_date_justification, request.end_date_justification, request.reason, request.attached, type_request.id as type_request_id, type_request.detail as type_request_detail, request_state.detail as request_state_detail, request_state.class as request_class, id_request_state, request.evaluation_date, request.state_reason'); 
      $this->db->join('type_request', 'type_request.id = request.id_request_type');
      $this->db->join('request_state', 'request_state.id = request.id_request_state');
      $this->db->where('request.id',$request_id);
      $this->db->where('user_id',$id_user);
      $query = $this->db->get('request');
      return($query->result());
    }

    function update_request($request_id, $data){
      $this->db->where('id', $request_id);
      return($this->db->update('request', $data));
    }
}
?> 