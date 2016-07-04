<?php
  class Request extends CI_Controller {
    function __construct(){
      parent::__construct();
      $this->load->helper('url');
      $this->load->library('session');  
      $this->load->model('request_model');
      $this->load->model('type_request_model');
      $this->load->model('turn_model');
    }
      
    function index() {
      
      $requests = $this->request_model->get_user_requests($this->session->userdata['id']);

      $view_data['requests'] = $requests;      

      $datos_layout["title"] = "CADP - Solicitudes";
      $datos_layout["user_menu"] = $this->load->view('user/menu_view', '', true);
      $datos_layout["content"] = $this->load->view('request/index_requests_view', $view_data, true);
      $this->load->view('layout_view', $datos_layout);
   }

   function new_request(){

     $request_types = $this->type_request_model->get_requests_types();
     $turns = $this->turn_model->get_turns();
     
     $view_data['request_types'] = $request_types;
     $view_data['turns'] = $turns;

     $datos_layout["title"] = "CADP - Nueva Solicitud";
     $datos_layout["user_menu"] = $this->load->view('user/menu_view', '', true);
     $datos_layout["content"] = $this->load->view('request/new_request_view', $view_data, true);
     $this->load->view('layout_view', $datos_layout);
   }

} 
?> 