<?php
  class Select_turn extends CI_Controller {
    function __construct(){
      parent::__construct();
      $this->load->helper('url');
      $this->load->model('user_model');
      $this->load->model('student_model');
      $this->load->model('turn_model');
      if (!$this->user_model->isLogin()) { redirect('/sign_in/', 'refresh'); }
    }

    function index () {
      if ($this->user_model->isLogin()) {
        $student = $this->student_model->get_student($this->session->userdata['student_id']);
        $turns = $this->turn_model->get_turn_promotion($student[0]->promotion);
        $data_view['student'] = $student[0];
        $data_view['turns'] = $turns;

        $datos_layout["title"] = "CADP - Elecci&oacute;n de turno";
        $datos_layout["user_menu"] = $this->load->view('user/menu_view', '', true);
        $datos_layout["content"] = $this->load->view('user/select_turn_view', $data_view, true);
        $this->load->view('layout_view', $datos_layout);
      }
    }

    function set_turn(){
      if ((empty($_POST ) != true) && ($this->user_model->isLogin())) {
        $this->db->trans_start();

        $form = $this->input->post('form');
        $turn_id = $form[0]['value'];
        $turn = $this->turn_model->get_turn($turn_id);
        $student = $this->student_model->get_student($this->session->userdata['student_id']);

        if (($turn[0]->limit > $turn[0]->current_amount) && ($student[0]->turn == NULL)) {
          $result = $this->student_model->set_turn($this->session->userdata['student_id'], $turn_id);
          if ($result > 0 ){ 
            $output = '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-thumbs-up"></span>'.SELECT_TURN_SUCCESSFULLY.'</div>'; 
          } else { $output = '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-thumbs-down"></span>'.SELECT_TURN_ERROR.'</div>'; }
        } else { $output = '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-thumbs-down"></span>'.SELECT_TURN_ERROR.'</div>'; }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
          $output = '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-thumbs-down"></span>'.SELECT_TURN_ERROR.'</div>';          
        }

        /* BOTON PARA REGRESAR */
        $output .= '<div class="row">';
        $output .= '<div class="col-xs-12">';
        $output .= '<a href="'.base_url().'" type="button" class="btn btn-success" data-toggle="tooltip" title="Volver al listado"><i class="fa fa-hand-o-left" aria-hidden="true"></i> Volver</a>';
        $output .= '</div>';
        $output .= '</div>';

        echo $output;

      } else { redirect('/error_404', 'refresh'); }
    }
  }
?> 