<?php
  class User_model extends CI_Model{
      
    function __construct(){
      parent::__construct();      
      $this->load->library('encrypt');
      $this->load->library('session');
    }

    /* verifica si hay una sesión iniciada */
    public function isLogin() {     
      return (isset($this->session->userdata['user']));
    }

    /* obtiene un usuario por su id */
    function get_user($user_id){
      $this->db->select('email, user');
      $this->db->where('id',$user_id);
      $query = $this->db->get('user');
      return($query->result());
    }

    /* alta de un nuevo usuario */
    function insert_user($data){
      $this->db->insert('user', $data);
      return($this->db->insert_id());
    }

    /* edición de los datos de un usuario */
    function edit_user($user_id, $data){
      $this->db->where('id', $user_id);
      return($this->db->update('user', $data));
    }

    /* se cierra la sesión actual */
    public function close_session() {      
      return $this->session->sess_destroy();
    }

    /* busca un usuario por nombre de usuario */
    function get_user_username($user_name){
      $this->db->select('id, user, pass, student_id');
      $this->db->where('user',$user_name);
      $query = $this->db->get('user');
      return($query->result());
    }    
}
?> 