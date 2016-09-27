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

    /* alta de un nuevo usuario */
    function insert_user($data){
      $this->db->insert('user', $data);
      return($this->db->insert_id());
    }

    /* se cierra la sesión actual */
    public function close_session() {      
      return $this->session->sess_destroy();
    }

    /* busca un usuario por dni */
    /*function get_user_dni($dni){
      $this->db->select('id');
      $this->db->where('dni',$dni);
      $query = $this->db->get('user');
      return($query->result());
    }*/

    /* busca un usuario por nombre de usuario */
    function get_user_username($user_name){
      $this->db->select('id, user, pass');
      $this->db->where('user',$user_name);
      $query = $this->db->get('user');
      return($query->result());
    }

    /* retorna la cantidad de solicitudes para un usuario */
    function count_requests ($user_id){      
      $this->db->from('user');
      $this->db->join('request', 'user_id = user.id');
      $this->db->where('user.id',$user_id);
      return($this->db->count_all_results());
    }
}
?> 