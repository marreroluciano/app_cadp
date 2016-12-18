<?php
  $file_number = $student->file_number;
  if ($file_number == NULL) {
    $file_number = 'Sin cargar';
  }
  $turn = $student->turn;
  if ($turn == NULL) {
    $turn = 'Sin turno';
  }
?>
<div class="row">
<div class="col-lg-12"><h3 class="page-header"><?=$student->surname_and_name;?> <small>(Legajo: <?=$file_number;?>)</small></h3></div>
</div>

<div class="row">

<div class="col-lg-3 col-md-6">
  <div class="panel panel-yellow">
    <div class="panel-heading">
      <div class="row">
        <div class="col-xs-3"><i class="fa fa-clock-o fa-5x"></i></div>
        <div class="col-xs-9 text-right">
          <div class="huge"><?=$turn;?></div>
          <div>Elcci&oacute;n de turno</div>
        </div>
      </div>
    </div>
    <a href="<?php echo base_url();?>select_turn/" data-toggle="tooltip" title="Elección de turno">
    <div class="panel-footer">
      <span class="pull-left">Elecci&oacute;n de turno</span>
      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
      <div class="clearfix"></div>
    </div>
    </a>
  </div>
  </div>

  <div class="col-lg-3 col-md-6">
  <div class="panel panel-green-water">
    <div class="panel-heading">
      <div class="row">
        <div class="col-xs-3"><i class="fa fa-inbox fa-5x"></i></div>
        <div class="col-xs-9 text-right">
          <div class="huge"><?=$count_requests;?></div>
          <div>Mis solicitudes</div>
        </div>
      </div>
    </div>
    <a href="<?php echo base_url();?>request/" data-toggle="tooltip" title="Mis solicitudes">
    <div class="panel-footer">
      <span class="pull-left">Solicitudes</span>
      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
      <div class="clearfix"></div>
    </div>
    </a>
  </div>
  </div>
</div>