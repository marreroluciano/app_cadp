<?php
  class Request extends CI_Controller {
    function __construct(){
      parent::__construct();
      $this->load->helper('url');
      $this->load->library('session');
      $this->load->model('user_model');
      $this->load->model('request_model');
      $this->load->model('type_request_model');
      $this->load->model('turn_model');
      if (!$this->user_model->isLogin()) { redirect('/sign_in/', 'refresh'); }
    }
      
    function index() {      
      if ($this->user_model->isLogin()) {
        $requests = $this->request_model->get_user_requests($this->session->userdata['id']);
        $view_data['requests'] = $requests;
        $datos_layout["title"] = "CADP - Solicitudes";
        $datos_layout["user_menu"] = $this->load->view('user/menu_view', '', true);
        $datos_layout["content"] = $this->load->view('request/index_requests_view', $view_data, true);
        $this->load->view('layout_view', $datos_layout);
      } else { redirect('/error_404', 'refresh'); }
   }

   function new_request(){
     if ($this->user_model->isLogin()) {
       $request_types = $this->type_request_model->get_requests_types();
       $turns = $this->turn_model->get_turns();     
       $view_data['request_types'] = $request_types;
       $view_data['turns'] = $turns;
       $datos_layout["title"] = "CADP - Nueva Solicitud";
       $datos_layout["user_menu"] = $this->load->view('user/menu_view', '', true);
       $datos_layout["content"] = $this->load->view('request/new_request_view', $view_data, true);
       $this->load->view('layout_view', $datos_layout);
     } else { redirect('/error_404', 'refresh'); }
   }

   function insert_request(){
     if ((empty($_POST ) != true) && ($this->user_model->isLogin())) {
       date_default_timezone_set('America/Argentina/Buenos_Aires');      
     
       $config['upload_path'] = 'C:\xampp_v1.8\htdocs\app_cadp\images\uploads';     
       $config['allowed_types'] = 'gif|jpg|png';     

       $this->load->library('upload', $config);
       $this->upload->initialize($config);

       $valid_operation = false;

       if (!$this->upload->do_upload("certificate")){
         $error = $this->upload->display_errors();
         echo $error;
       } else { 
         $file_data = $this->upload->data();
         $certificate = $file_data['file_name'];
         $id_request_type = $this->input->post('request_types');

         switch ($id_request_type) {
           case 1:
             $id_turn = $this->input->post('turn');
             $date_from = null;
             $date_end = null;
             break;
           case 2:
             $date_from = str_replace('/', '-', $this->input->post('value_date_from'));
             $date_end = str_replace('/', '-', $this->input->post('value_date_end'));
             $date_from = date('Y-m-d', strtotime($date_from));
             $date_end = date('Y-m-d', strtotime($date_end));
             $id_turn = null;
             break;
         }        
         
         $date = date("Y-m-d h:i:s");
         $data = array('date' => $date,
                       'date_update' => $date,
                       'current_turn' => null, 
                       'requested_shift' => $id_turn, 
                       'start_date_justification' => $date_from, 
                       'end_date_justification' => $date_end, 
                       'reason' => $this->input->post('comments'),
                       'attached' => $certificate,
                       'id_request_type' => $id_request_type,
                       'user_id' => $this->session->userdata['id'],
                       'id_request_state' => 1);
         $valid_insert = $this->request_model->insert_request($data);         
         if ($valid_insert > 0) { $valid_operation = true; }
       }

       /* se arma la salida */
       $output = '';
       if ($valid_operation) {
         $output.= '<div class="row">';
         $output.= '<div class="col-xs-12">';
         $output.= '<div class="alert alert-success" role="alert"><i class="fa fa-thumbs-up" aria-hidden="true"></i> La solicitud ha sido enviada y en breve ser&aacute; procesada.</div>';
         $output.= '</div>';
         $output.= '</div>';

         $output.= '<div class="row">';
         $request_type = $this->type_request_model->get_request_type($id_request_type);
         $output.= '<div class="col-xs-6">';
         $output.= '<ul class="list-group">';
         $output.= '<li class="list-group-item"><strong>Tipo de solicitud:</strong> '.$request_type[0]->detail.'</li>';
         switch ($id_request_type) {
         case 1:
           $turn = $this->turn_model->get_turn($id_turn);
           $output.= '<li class="list-group-item"><strong>Pasar al:</strong> '.$turn[0]->detail.'</li>';
           break;
         case 2:
           $output.= '<li class="list-group-item"><strong>Fecha desde:</strong> '.$this->input->post('value_date_from').'</li>';
           $output.= '<li class="list-group-item"><strong>Fecha hasta:</strong> '.$this->input->post('value_date_end').'</li>';
           break;
         }
         $output.= '<li class="list-group-item"><strong>Comentarios:</strong> '.$this->input->post('comments').'</li>';
         $output.= '</ul>';
         $output.= '</div>';

         $output.= '<div class="col-xs-6">';
       
         /* The Bootstrap Image Gallery lightbox */
         $output.= '<div id="blueimp-gallery" class="blueimp-gallery">';
         $output.= '<div class="slides"></div>';
         $output.= '<h3 class="title"></h3>';
         $output.= '<a class="prev">‹</a>';
         $output.= '<a class="next">›</a>';
         $output.= '<a class="close">×</a>';
         $output.= '<a class="play-pause"></a>';
         $output.= '<ol class="indicator"></ol>';
       
         $output.= '<div class="modal fade">';
         $output.= '<div class="modal-dialog">';
         $output.= '<div class="modal-content">';
         $output.= '<div class="modal-header">';
         $output.= '<button type="button" class="close" aria-hidden="true">&times;</button>';
         $output.= '<h4 class="modal-title"></h4>';
         $output.= '</div>';
         $output.= '<div class="modal-body next"></div>';

         $output.= '</div>';
         $output.= '</div>';
         $output.= '</div>';
         $output.= '</div>';

         $output.= '<div id="links">';
         $output.= '<a href="../images/uploads/'.$certificate.'" title="Certificado" data-gallery>';
         $output.= '<img src="../images/uploads/'.$certificate.'" alt="Certificado" class="img-rounded img-responsive center-block" width="50%" height="50%" />';
         $output.= '</a>';
         $output.= '</div>';

         $output.= '</div>';
         $output.= '</div>';

         /* BOTON PARA REGRESAR */
         $output .= '<div class="row">';
         $output .= '<div class="col-xs-12">';
         $output .= '<a href="'.base_url().'request" type="button" class="btn btn-success" data-toggle="tooltip" title="Volver al listado"><i class="fa fa-hand-o-left" aria-hidden="true"></i> Volver al listado </a>';
         $output .= '</div>';
         $output .= '</div>';
       }
       echo $output;
     } else {redirect('/error_404', 'refresh');}
   }

   function view($request_id = null){
     if ($this->user_model->isLogin()){
       $request = $this->request_model->get_user_request($request_id, $this->session->userdata['id']);
       if (sizeof($request) > 0) {
         $view_data['request'] = $request;
         $datos_layout["title"] = "CADP - Ver solicitud";
         $datos_layout["user_menu"] = $this->load->view('user/menu_view', '', true);
         $datos_layout["content"] = $this->load->view('request/request_view', $view_data, true);
         $this->load->view('layout_view', $datos_layout);
       } else {redirect('/error_404', 'refresh');}
     } else { redirect('/sign_in/', 'refresh'); } 
   }

   function cancel_request(){
     if ((empty($_POST ) != true) && ($this->user_model->isLogin())) {
       $request_id = $this->input->post('request_id');
       $successful_operation = $this->request_model->cancel_request($request_id);

       $output = '';
       if ($successful_operation) {
         $output.='<div class="alert alert-success alert-dismissible" role="alert">
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                   <strong><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></strong> Solicitud cancelada correctamente.
                   </div>';
         $output.='<script type="text/javascript">';
         $output.= '$(document).ready(function(){';
         $output.= '$("#row_'.$request_id.'").css("text-decoration","line-through");';
         $output.= '$("#state_'.$request_id.'").html("<i class=\'fa fa-ban\' aria-hidden=\'true\' data-toggle=\'tooltip\' title=\'CANCELADA\'></i>");';
         $output.= '$("#cancel_button_'.$request_id.'").fadeOut("slow");';       
         $output.= '});';  
         $output.= '</script>';
       } 
       else {
         $output.='<div class="alert alert-danger alert-dismissible" role="alert">
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                   <strong><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></strong> La solicitud no puede ser cancelada.
                   </div>';
       }     
       echo $output;
     } else { redirect('/error_404', 'refresh'); }
   }
} 
?> 