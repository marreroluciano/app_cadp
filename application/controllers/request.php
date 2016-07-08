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

   function insert_request(){
     //$certificate = $this->input->post('certificate');     
     $config['upload_path'] = 'D:\app_cadp\uploads';
     $config['allowed_types'] = 'gif|jpg|png';

     $this->load->library('upload', $config);
     $this->upload->initialize($config);

     if (!$this->upload->do_upload("certificate")){
        $error = $this->upload->display_errors();
     } else { 
         $file_data = $this->upload->data();
         $certificate = $file_data['file_name'];
         $request_types = $this->input->post('request_types');

         switch ($request_types) {
           case 1:
             $turn = $this->input->post('turn');
             $value_date_from = null;
             $value_date_end = null;
             break;
           case 2:
             $date_from = date_create($this->input->post('value_date_from'));
             $date_end = date_create($this->input->post('value_date_end'));
             $value_date_from = date_format($date_from, 'Y-m-d');
             $value_date_end = date_format($date_from, 'Y-m-d');
             $turn = null;
             break;
         }         
         //$comments = $this->input->post('comments');
         date_default_timezone_set('America/Argentina/Buenos_Aires');
         $date = date("Y-m-d h:i:s");         
         $data = array('date' => $date, 
                       'current_turn' => null, 
                       'requested_shift' => $turn, 
                       'start_date_justification' => $value_date_from, 
                       'end_date_justification' => $value_date_end, 
                       'reason' => $this->input->post('comments'),
                       'attached' => $certificate,
                       'id_request_type' => $request_types,
                       'user_id' => $this->session->userdata['id'],
                       'id_request_state' => 1);
         $valid_insert = $this->request_model->insert_request($data);
     }
     print_r('<pre>');
     print_r($valid_insert);
     print_r('</pre>');

   }

} 
?> 