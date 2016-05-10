<?php
  class Sign_in extends CI_Controller {
    function __construct(){
      parent::__construct();
      $this->load->helper('url');
      $this->load->model('user_model');
      $this->load->library('encrypt');
      $this->load->library('session');
    }
      
   function index () {     
     if (!$this->user_model->isLogin()) {
       $datos_layout["title"]   = "CADP - Ingreso al sistema";
       $datos_layout["content"] = $this->load->view('sign_in_view', '', true);
       $this->load->view('layout_view', $datos_layout);
      } else {
         $datos_layout["title"]   = "CADP";
         $datos_layout["user_menu"] = $this->load->view('user/menu_view', '', true);
         $datos_layout["content"] = $this->load->view('user/initial_user_view','', true);
         $this->load->view('layout_view', $datos_layout);
      }
   }

   function login(){
     if (empty($_POST ) != true) {
       $user_name = $this->input->post('user_name');
       $user_pass = $this->input->post('user_pass');
       $user = $this->user_model->get_user_username($user_name);
       if ( (sizeof($user) > 0) && (($this->encrypt->decode($user[0]->pass)) == $user_pass) ) {         
         $data_session = array('id' => $user[0]->id,'user' => $user[0]->user);
         $this->session->set_userdata($data_session);

         $datos_layout["title"]   = "CADP";
         $datos_layout["user_menu"] = $this->load->view('user/menu_view', '', true);
         $datos_layout["content"] = $this->load->view('user/initial_user_view','', true);
         $this->load->view('layout_view', $datos_layout);
       } else {
            $data_view['login_error'] = 1;
            $datos_layout["title"]   = "CADP - Error en el ingreso al sistema";
            $datos_layout["content"] = $this->load->view('sign_in_view', $data_view, true);
            $this->load->view('layout_view', $datos_layout);
         }
     } else { redirect(base_url().'sign_in', 'refresh');}
   }
   
   function destroy() {
     //destruimos la sesión
     /* 
     $this->load->model('usuario_model');
     $this->usuario_model->close();

     $datos_content['usuario_value'] = '';
     $datos_content['clave_value']   = '';
     $datos_content['isLogin']       = false;

     $datos_layout["title"] = "Sesión finalizada";
     $datos_layout["content"] = $this->load->view('sign_in_view', $datos_content, true);
     $this->load->view('layout_view', $datos_layout);  */
     
   }

   /* solicitud de registro */
   function register(){
     $datos_layout["title"]   = "CADP - Registro de usuario";
     $datos_layout["content"] = $this->load->view('user_create_view', '', true);
     $this->load->view('layout_view', $datos_layout);
   }

   /* verifica existencia de un dni de usuario */
   function get_alerts() {
    if (empty($_POST ) != true) {
      $value = $this->input->post('value');
      $model_method = $this->input->post('model_method');
      $output = '';
      switch ($model_method) {
        case 'dni': 
          $user = $this->user_model->get_user_dni($value);
          if ( sizeof($user) > 0 ) { 
            $output.= '<div class="row" id="alert_dni" style="display: none;">';
            $output.= '<div class="col-xs-12">';
            $output.= '<div class="alert alert-danger" role="alert"><span class=" glyphicon glyphicon-alert"></span>Ya existe un usuario con el mismo DNI.</div>';
            $output.= '</div>';
            $output.= '</div>';
            $output.= '<script type="text/javascript">$("#accept").attr("disabled", true);</script>';
            $output.= '<script type="text/javascript">$("#alert_dni").show("slow")</script>';
          } else {
            $output.= '<script type="text/javascript"> if(  !($("#alert_user").is(":visible"))  ){ $("#accept").attr("disabled", false); } </script>';
            $output.= '<script type="text/javascript">$("#alert_dni").hide("slow")</script>';
          }
          break;
        case 'user':
          $user = $this->user_model->get_user_username($value);
          if ( sizeof($user) > 0 ) { 
            $output.= '<div class="row" id="alert_user" style="display: none;">';
            $output.= '<div class="col-xs-12">';
            $output.= '<div class="alert alert-danger" role="alert"><span class=" glyphicon glyphicon-alert"></span>Ya existe el nombre de usuario.</div>';
            $output.= '</div>';
            $output.= '</div>';
            $output.= '<script type="text/javascript">$("#accept").attr("disabled", true);</script>';
            $output.= '<script type="text/javascript">$("#alert_user").show("slow")</script>';
          } else {
            $output.= '<script type="text/javascript"> if(  !($("#alert_dni").is(":visible"))  ){ $("#accept").attr("disabled", false); } </script>';
            $output.= '<script type="text/javascript">$("#alert_user").hide("slow")</script>';
          }
          break;
        case 'login_error':
          $output.= '<div id="alert_error_login" style="display: none;">';          
          $output.= '<div class="alert alert-danger" role="alert"><span class=" glyphicon glyphicon-alert"></span> El usuario y/o la contrase&ntilde;a son incorrectos.</div>';
          $output.= '</div>';
          $output.= '<script type="text/javascript">$("#alert_error_login").show("slow")</script>';
          break;
      }      
      echo $output;
    }
   }

   /* realiza el insert de un nuevo usuario en el sistema */
   function insert_user(){
     if (empty($_POST ) != true) {
       $form = $this->input->post('form');
       $pass = $this->encrypt->encode($form[4]['value']);
       $data = array('dni' => $form[0]['value'], 'apellido_nombre' => $form[1]['value'], 'correo' => $form[2]['value'], 'user' => $form[3]['value'], 'pass' => $pass);
       $id_user = $this->user_model->insert_user($data);

       /* se arma la salida */
       $output = '';
       $output.= '<div class="row"> <div class="col-xs-12">';
       if ($id_user > 0){
         $output.= '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-thumbs-up"></span> Usuario creado correctamente. Ya puede ingresar utilizando su usuario y clave.</div>';
       } else {
         $output.= '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-thumbs-down"></span> El usuario no ha podido ser creado.</div>';
       }       
       $output.= '</div></div>';

       /* BOTON PARA REGRESAR */
       $output .= '<div class="row">';
       $output .= '<div class="col-xs-12">';

       $output .= '<a href="'.base_url().'" type="button" class="btn btn-success"><span class="glyphicon glyphicon-hand-left"></span> Volver </a>';

       $output .= '</div>';
       $output .= '</div>';

       echo $output;

     } else { redirect('/error_404', 'refresh'); }
   }


} 
?> 