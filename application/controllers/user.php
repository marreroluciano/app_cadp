<?php
  class User extends CI_Controller {
    function __construct(){
      parent::__construct();
      $this->load->helper('url');
      $this->load->model('user_model');
      $this->load->model('student_model');      
      if (!$this->user_model->isLogin()) { redirect('/sign_in/', 'refresh'); }
    }
      
    function my_data () {
      $student = $this->student_model->get_student($this->session->userdata['student_id']);
      $has_turn = $student[0]->turn != NULL;

      if ($this->user_model->isLogin()) {
        $user = $this->user_model->get_user($this->session->userdata['id']);
        $student = $this->student_model->get_student($this->session->userdata['student_id']);
        $data_view['user'] = $user[0];
        $data_view['student'] = $student[0];

        $data_menu_view['has_turn'] = $has_turn;

        $datos_layout["title"] = ACRONYM.' - '.MY_USER_DATA_TITLE;
        $datos_layout["user_menu"] = $this->load->view('user/menu_view', $data_menu_view, true);
        $datos_layout["content"] = $this->load->view('user/my_data_view', $data_view, true);
        $this->load->view('layout_view', $datos_layout);
      }      
    }

    /* realiza el insert de un nuevo usuario en el sistema */
    function insert_user(){
      if ((empty($_POST ) != true) && ($this->user_model->isLogin())){
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

    /* realiza el update de un usuario en el sistema */
    function edit_user(){
      if ((empty($_POST ) != true) && ($this->user_model->isLogin())) {
        $form = $this->input->post('form');

        $data = array('email' => $form[3]['value']);
        $user_id = $this->user_model->edit_user($this->session->userdata['id'], $data);

        if ($user_id > 0){
          $data = array('file_number' => $form[4]['value']);
          $student_id = $this->student_model->edit_student($form[0]['value'], $data);
          if ($student_id > 0 ) { 
            $output = '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-thumbs-up"></span>'.USER_EDITED_SUCCESSFULLY.'</div>';
          } else { $output = '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-thumbs-down"></span>'.USER_EDITED_ERROR.'</div>'; }
        } else { $output = '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-thumbs-down"></span>'.USER_EDITED_ERROR.'</div>'; }

        /* BOTON PARA REGRESAR */
        $output .= '<div class="row">';
        $output .= '<div class="col-xs-12">';
        $output .= '<a href="'.base_url().'sign_in" type="button" class="btn btn-success" data-toggle="tooltip" title="Volver al listado"><i class="fa fa-hand-o-left" aria-hidden="true"></i> Volver</a>';
        $output .= '</div>';
        $output .= '</div>';
        echo $output;

      } else { redirect('/error_404', 'refresh'); }
    }

    function change_password(){
      $student = $this->student_model->get_student($this->session->userdata['student_id']);
      $has_turn = $student[0]->turn != NULL;

      if ($this->user_model->isLogin()) {
        $data_menu_view['has_turn'] = $has_turn;

        $datos_layout["title"] = ACRONYM.' - Configurar contrase&ntilde;a';
        $datos_layout["user_menu"] = $this->load->view('user/menu_view', $data_menu_view, true);
        $datos_layout["content"] = $this->load->view('user/change_password_view', '', true);
        $this->load->view('layout_view', $datos_layout);
      }
    }
  }
?> 