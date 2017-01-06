<?php
  class Evaluation extends CI_Controller {
    function __construct(){
      parent::__construct();
      $this->load->model('student_model');      
      $this->load->model('evaluation_model');
      $this->load->model('user_model');
      $this->load->helper('date');
      if (!$this->user_model->isLogin()) { redirect('/sign_in/', 'refresh'); }
    }
      
    function index() {
      $student = $this->student_model->get_student($this->session->userdata['student_id']);
      $has_turn = $student[0]->turn != NULL;

      if (($this->user_model->isLogin()) && ($has_turn)) {               
        $evaluations = $this->evaluation_model->get_evaluations($this->session->userdata['student_id']);
        $data_view['evaluations'] = $evaluations;

        $datos_layout["title"] = "CADP - Evaluaciones";
        $datos_layout["user_menu"] = $this->load->view('user/menu_view', '', true);
        $datos_layout["content"] = $this->load->view('evaluation/index_evaluation_view', $data_view, true);
        $this->load->view('layout_view', $datos_layout);

      } else { redirect('/error_404', 'refresh'); }
   }
} 
?> 