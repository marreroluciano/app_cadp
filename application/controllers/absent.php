<?php
  class Absent extends CI_Controller {
    function __construct(){
      parent::__construct();
      $this->load->model('user_model');
      $this->load->model('student_model');
      $this->load->model('student_attendance_list_model');
      $this->load->helper('date');
      if (!$this->user_model->isLogin()) { redirect('/sign_in/', 'refresh'); }
    }
      
    function index() {
      $student = $this->student_model->get_student($this->session->userdata['student_id']);
      $has_turn = $student[0]->turn != NULL;

      if (($this->user_model->isLogin()) && ($has_turn)) {

        $absents = $this->student_attendance_list_model->get_absents($this->session->userdata['student_id']);
        $number_absences = $this->student_attendance_list_model->number_absences($this->session->userdata['student_id'], 1);
        $number_excused_absences = $this->student_attendance_list_model->number_absences($this->session->userdata['student_id'], 3);

        $data_view['absents'] = $absents;
        $data_view['number_absences'] = $number_absences;
        $data_view['number_excused_absences'] = $number_excused_absences;

        $data_menu_view['has_turn'] = $has_turn;

        $datos_layout["title"] = "CADP - Inasistencias";
        $datos_layout["user_menu"] = $this->load->view('user/menu_view', $data_menu_view, true);
        $datos_layout["content"] = $this->load->view('absent/index_absent_view', $data_view, true);
        $this->load->view('layout_view', $datos_layout);

      } else { redirect('/error_404', 'refresh'); }
   }
} 
?> 