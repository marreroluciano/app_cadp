<?php
  class Sign_in extends CI_Controller {
    function __construct(){
      parent::__construct();
      $this->load->helper('url');
      $this->load->model('user_model');
      $this->load->model('request_model');
      $this->load->model('student_model');
      $this->load->model('student_attendance_list_model');
      $this->load->model('evaluation_model');      
      $this->load->model('flag_model');
      $this->load->library('encrypt');
      $this->load->library('session');
    }
      
   function index () {
     if (!$this->user_model->isLogin()) {
       $datos_layout["title"]   = ACRONYM." - Ingreso al sistema";
       $datos_layout["content"] = $this->load->view('sign_in_view', '', true);
       $this->load->view('layout_view', $datos_layout);
      } else {         
         $student = $this->student_model->get_student($this->session->userdata['student_id']);
         if (($student[0]->file_number) == NULL) {
           $file_number = 'Sin cargar';
         } else { $file_number = $student[0]->file_number; }

         $has_turn = false;
         if (($student[0]->turn) == NULL) {
           $turn = 'Sin turno';
         } else { $turn = $student[0]->turn; $has_turn = true; }

         $flag = $this->flag_model->get_flag(FLAG_TURN_KEY_VALUE);
         $data_view['count_requests'] = $this->request_model->count_requests($this->session->userdata['student_id']);
         $data_view['number_absences'] = $this->student_attendance_list_model->number_absences($this->session->userdata['student_id'], 1);
         $data_view['number_evaluations'] = $this->evaluation_model->number_evaluations($this->session->userdata['student_id']);
         $data_view['student'] = $student[0];
         $data_view['flag_value'] = $flag[0]->value;
         $data_view['file_number'] = $file_number;
         $data_view['turn'] = $turn;
         $data_view['has_turn'] = $has_turn;

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
         $data_session = array('id' => $user[0]->id,'user' => $user[0]->user, 'student_id' => $user[0]->student_id);
         $student = $this->student_model->get_student($user[0]->student_id);

         if (($student[0]->file_number) == NULL) {
           $file_number = 'Sin cargar';
         } else { $file_number = $student[0]->file_number; }

         $has_turn = false;
         if (($student[0]->turn) == NULL) {
           $turn = 'Sin turno';
         } else { $turn = $student[0]->turn; $has_turn = true; }

         $flag = $this->flag_model->get_flag(FLAG_TURN_KEY_VALUE);

         $this->session->set_userdata($data_session);

         $data_view['count_requests'] = $this->request_model->count_requests($this->session->userdata['student_id']);
         $data_view['number_absences'] = $this->student_attendance_list_model->number_absences($this->session->userdata['student_id'], 1);
         $data_view['number_evaluations'] = $this->evaluation_model->number_evaluations($this->session->userdata['student_id']);
         $data_view['student'] = $student[0];
         $data_view['file_number'] = $file_number;
         $data_view['turn'] = $turn;
         $data_view['flag_value'] = $flag[0]->value;
         $data_view['has_turn'] = $has_turn;

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
          $student = $this->student_model->get_student_dni($value);
          if ( sizeof($student) > 0 ) { 
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
    } else { redirect('/error_404', 'refresh'); }
   }
} 
?> 