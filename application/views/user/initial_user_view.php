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
          <div class="huge"><small><?=$turn; ?></small></div>
          <div>Turno de asistencia</div>
        </div>
      </div>
    </div>
    <?php if ((!$has_turn) && ($flag_value)) { ?>
      <a href="<?php echo base_url();?>select_turn/" data-toggle="tooltip" title="Elección de turno">
      <div class="panel-footer">
        <span class="pull-left">Elecci&oacute;n de turno</span>
        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
        <div class="clearfix"></div>
      </div>
      </a>
    <?php } ?>
  </div>
  </div>

  <div class="col-lg-3 col-md-6">
  <div class="panel panel-green-water">
    <div class="panel-heading">
      <div class="row">
        <div class="col-xs-3"><i class="fa fa-inbox fa-5x"></i></div>
        <div class="col-xs-9 text-right">
          <div class="huge"><?=$count_requests; ?></div>
          <div>Mis solicitudes</div>
        </div>
      </div>
    </div>
    <?php if ($has_turn) { ?>
    <a href="<?php echo base_url();?>request/" data-toggle="tooltip" title="Mis solicitudes">
    <div class="panel-footer">
      <span class="pull-left">Solicitudes</span>
      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
      <div class="clearfix"></div>
    </div>
    </a>
    <?php } ?>
  </div>
  </div>

  <div class="col-lg-3 col-md-6">
  <div class="panel panel-red">
    <div class="panel-heading">
      <div class="row">
        <div class="col-xs-3"><i class="fa fa-calendar-times-o fa-5x"></i></div>
        <div class="col-xs-9 text-right">
          <div class="huge"><?=$number_absences; ?></div>
          <div>Mis inasistencias</div>
        </div>
      </div>
    </div>
    <?php if ($has_turn) { ?>
    <a href="<?php echo base_url();?>absent/" data-toggle="tooltip" title="Mis inasistencias">
    <div class="panel-footer">
      <span class="pull-left">Inasistencias</span>
      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
      <div class="clearfix"></div>
    </div>
    </a>
    <?php } ?>
  </div>
  </div>

  <div class="col-lg-3 col-md-6">
  <div class="panel panel-green">
    <div class="panel-heading">
      <div class="row">
        <div class="col-xs-3"><i class="fa fa-pencil-square-o fa-5x"></i></div>
        <div class="col-xs-9 text-right">
          <div class="huge"><?=$number_evaluations; ?></div>
          <div>Mis evaluaciones</div>
        </div>
      </div>
    </div>
    <?php if ($has_turn) { ?>
    <a href="<?php echo base_url();?>evaluation/" data-toggle="tooltip" title="Mis evaluaciones">
    <div class="panel-footer">
      <span class="pull-left">Evaluaciones</span>
      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
      <div class="clearfix"></div>
    </div>
    </a>
    <?php } ?>
  </div>
  </div>

</div>

<script type="text/javascript">
  $(document).ready(function(){
    change_class('menu', '');
    change_class('request', '');
    change_class('start', 'active');
    change_class('absent', '');
    change_class('evaluation', '');
    change_class('user_menu', '');
    change_class('my_data', '');
    change_class('change_password', '');
  });
</script>