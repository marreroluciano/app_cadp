<?php
  class Sign_in extends CI_Controller {
    function __construct(){
      parent::__construct();
      $this->load->helper('url');
      $this->load->model('user_model');
      $this->load->model('student_model');
      $this->load->library('encrypt');
      $this->load->library('session');
    }
      
   function index () {    
     if (!$this->user_model->isLogin()) {
       $datos_layout["title"]   = "CADP - Ingreso al sistema";
       $datos_layout["content"] = $this->load->view('sign_in_view', '', true);
       $this->load->view('layout_view', $datos_layout);
      } else {
         $data_view['count_requests'] = $this->user_model->count_requests($this->session->userdata['id']);
         $datos_layout["title"]   = "CADP";
         $datos_layout["user_menu"] = $this->load->view('user/menu_view', '', true);
         $datos_layout["content"] = $this->load->view('user/initial_user_view', $data_view, true);
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

         $data_view['count_requests'] = $this->user_model->count_requests($user[0]->id);
         $datos_layout["title"]   = "CADP";
         $datos_layout["user_menu"] = $this->load->view('user/menu_view', '', true);
         $datos_layout["content"] = $this->load->view('user/initial_user_view', $data_view, true);
         $this->load->view('layout_view', $datos_layout);
       } else {
            $data_view['login_error'] = 1;
            $datos_layout["title"]   = "CADP - Error en el ingreso al sistema";
            $datos_layout["content"] = $this->load->view('sign_in_view', $data_view, true);
            $this->load->view('layout_view', $datos_layout);
         }
     } else { redirect(base_url().'sign_in', 'refresh');}
   }
   
   function close_session() {
     $this->user_model->close_session();
     $datos_layout["title"]   = "CADP - Ingreso al sistema";
     $datos_layout["content"] = $this->load->view('sign_in_view', '', true);
     $this->load->view('layout_view', $datos_layout);
   }

   /* solicitud de registro */
   function register(){
     $students = $this->student_model->get_unregistered_students();
     
     foreach ($students as $key => $value) {       
       $option_student[$value->id] = $value->surname_and_name;
     }

     $data_view['option_student'] = $option_student;
     $datos_layout["title"]   = "CADP - Registro de usuario";
     $datos_layout["content"] = $this->load->view('user_create_view', $data_view, true);
     $this->load->view('layout_view', $datos_layout);
   }

   /* verifica existencia de un dni de usuario */
   function get_alerts() {
    if (empty($_POST ) != true) {
      $value = $this->input->post('value');
      $model_method = $this->input->post('model_method');
      $output = '';
      switch ($model_method) {
        /*case 'dni': 
          $user = $this->user_model->get_user_dni($value);
          if ( sizeof($user) > 0 ) { 
            $output.= '<div class="row" id="alert_dni" style="display: none;">';
            $output.= '<div class="col-xs-12">';
            $output.= '<div class="alert alert-danger" role="alert"><span class=" glyphicon glyphicon-alert"></span>'.ALREADY_EXISTS_DNI.'</div>';
            $output.= '</div>';
            $output.= '</div>';
            $output.= '<script type="text/javascript">$("#accept").attr("disabled", true);</script>';
            $output.= '<script type="text/javascript">$("#alert_dni").show("slow")</script>';
          } else {
            $output.= '<script type="text/javascript"> if( (!($("#alert_user").is(":visible"))) && (!($("#alert_not_match_dni").is(":visible")))  ){ $("#accept").attr("disabled", false); } </script>';
            $output.= '<script type="text/javascript">$("#alert_dni").hide("slow")</script>';
          }
          break;*/
        case 'check_user_dni':
          $student = $this->student_model->check_user_dni($value[0], $value[1]);
          if ( sizeof($student) == 0 ) {
            $output.= '<div class="row" id="alert_not_match_dni" style="display: none;">';
            $output.= '<div class="col-xs-12">';
            $output.= '<div class="alert alert-danger" role="alert"><span class=" glyphicon glyphicon-alert"></span>'.NOT_MATCH_DNI.'</div>';
            $output.= '</div>';
            $output.= '</div>';
            $output.= '<script type="text/javascript">$("#accept").attr("disabled", true);</script>';
            $output.= '<script type="text/javascript">$("#alert_not_match_dni").show("slow")</script>';
          } else {
            $output.= '<script type="text/javascript"> if( (!($("#alert_dni").is(":visible"))) && (!($("#alert_user").is(":visible")))   ){ $("#accept").attr("disabled", false); } </script>';
            $output.= '<script type="text/javascript">$("#alert_not_match_dni").hide("slow")</script>';
          }
          break;  
        case 'user':
          $user = $this->user_model->get_user_username($value);
          if ( sizeof($user) > 0 ) { 
            $output.= '<div class="row" id="alert_user" style="display: none;">';
            $output.= '<div class="col-xs-12">';
            $output.= '<div class="alert alert-danger" role="alert"><span class=" glyphicon glyphicon-alert"></span>'.EXISTING_USER.'</div>';
            $output.= '</div>';
            $output.= '</div>';
            $output.= '<script type="text/javascript">$("#accept").attr("disabled", true);</script>';
            $output.= '<script type="text/javascript">$("#alert_user").show("slow")</script>';
          } else {
            $output.= '<script type="text/javascript"> if( (!($("#alert_not_match_dni").is(":visible"))) && (!($("#alert_dni").is(":visible")))  ){ $("#accept").attr("disabled", false); } </script>';
            $output.= '<script type="text/javascript">$("#alert_user").hide("slow")</script>';
          }
          break;
        case 'login_error':
          $output.= '<div id="alert_error_login" style="display: none;">';          
          $output.= '<div class="alert alert-danger" role="alert"><span class=" glyphicon glyphicon-alert"></span>'.LOGIN_ERROR.'</div>';
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

       $student = $this->student_model->check_user_dni($form[1]['value'], $form[0]['value']);
       $output = '';

       if (sizeof($student) == 0) { 
         $output.= '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-thumbs-down"></span>'.NEW_USER_ERROR.' '.NOT_MATCH_DNI.'</div>';
       } else {
           $user = $this->user_model->get_user_username($form[3]['value']);
           if (sizeof($user) > 0){
             $output.= '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-thumbs-down"></span>'.NEW_USER_ERROR.' '.EXISTING_USER.'</div>';
           } else {              
              /* usuario válido */              
              $pass = $this->encrypt->encode($form[4]['value']);
              $data = array('email' => $form[2]['value'], 'user' => $form[3]['value'], 'pass' => $pass, 'student_id' => $form[0]['value']);
              $id_user = $this->user_model->insert_user($data);
              /* se arma la salida */
              $output.= '<div class="row"> <div class="col-xs-12">';
              if ($id_user > 0) {
                $output.= '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-thumbs-up"></span>'.USER_CREATED_SUCCESSFULLY.'</div>';
              } else {
                $output.= '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-thumbs-down"></span>'.NEW_USER_ERROR.' '.DATABASE_ERROR.'</div>';
              }
              $output.= '</div></div>';
           }
       }

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