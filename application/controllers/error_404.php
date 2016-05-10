<?php
if (!defined('BASEPATH'))
   exit('No direct script access allowed');
class Error_404 extends CI_Controller { 
   public function index(){
     $datos_layout["title"]   = "CADP - Error: P&aacute;gina no encontrada";
     $datos_layout["content"] = $this->load->view('error_404_view', '', true);
     $this->load->view('layout_view', $datos_layout);       
   }
}
?>