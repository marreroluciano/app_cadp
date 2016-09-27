<div id="result">

<?php  $atr_label = array('class' => 'col-sm-4 control-label'); ?>
<div class="row"> 
<div class="col-xs-12"> 
  <h5><strong> REGISTRO DE USUARIO </strong></h5>
</div>
</div>

<div id="alerts"></div>

<div class="row">
<div class="col-xs-12">
  <?php $attributes = array('class' => 'form-horizontal', 'role'=>'form', 'id' => 'form'); ?>
  <?php echo form_open('', $attributes); ?>

  <div class="panel panel-default">
  <div class="panel-heading"><span class="glyphicon glyphicon-user"></span> Datos de usuario</div>
  <div class="panel-body">

    <div class="row">
      <div class="col-xs-6">

        <div class="form-group form-group-sm">
          <?=form_label('<small> Alumno </small>', 'name', $atr_label); ?>
          <div class="col-sm-8">            
            <?=form_dropdown('student', $option_student, '', 'class="chosen-select" id="student"'); ?>
          </div>
        </div>

        <div class="form-group form-group-sm" id="form_group_dni">
          <?=form_label('<small> DNI </small>', 'dni', $atr_label); ?>
          <div class="col-sm-8">            
            <?php $atributes = array('type'=>'text', 'id' => 'dni', 'name' => 'dni', 'placeholder' => 'DNI', 'class' => 'form-control', 'maxlength' => 20); ?>
            <?=form_input($atributes); ?>
          </div>
        </div>       

        <div class="form-group form-group-sm" id="form_group_email">
          <?=form_label('<small> Correo electr&oacute;nico </small>', 'email', $atr_label); ?>
          <div class="col-sm-8">
            <?php $atributes = array('type'=>'email', 'id' => 'email', 'name' => 'email', 'placeholder' => 'Correo electr&oacute;nico', 'class' => 'form-control', 'maxlength' => 50); ?>
            <?=form_input($atributes); ?>
          </div>
        </div>

      </div>
      <div class="col-xs-6">
        
        <div class="form-group form-group-sm" id="form_group_user">
          <?=form_label('<small> Usuario </small>', 'user', $atr_label); ?>
          <div class="col-sm-8">
            <?php $atributes = array('type'=>'text', 'id' => 'user', 'name' => 'user', 'placeholder' => 'Nombre de usuario', 'class' => 'form-control', 'maxlength' => 10); ?>
            <?=form_input($atributes); ?>
          </div>
        </div>

        <div class="form-group form-group-sm" id="form_group_pass">
          <?=form_label('<small> Contrase&ntilde;a de usuario </small>', 'pass', $atr_label); ?>
          <div class="col-sm-8">
            <?php $atributes = array('type'=>'password', 'id' => 'pass', 'name' => 'pass', 'placeholder' => 'Contrase&ntilde;a del nuevo usuario', 'class' => 'form-control', 'maxlength' => 10); ?>
            <?=form_input($atributes); ?>
          </div>
        </div>

        <div class="form-group form-group-sm" id="form_group_confirm_pass">
          <?=form_label('<small> Confirmar contrase&ntilde;a </small>', 'confirm_pass', $atr_label); ?>
          <div class="col-sm-8">
            <?php $atributes = array('type'=>'password', 'id' => 'confirm_pass', 'name' => 'confirm_pass', 'placeholder' => 'Confirmar contrase&ntilde;a del nuevo usuario', 'class' => 'form-control', 'maxlength' => 10); ?>
            <?=form_input($atributes); ?>
          </div>
        </div>

      </div>
    </div>  
    
  </div>
  </div>

  <div class="row"> 
  <div class="col-xs-12">
    <?php $attributes = array('name' => 'accept', 'id' => 'accept', 'type' => 'button', 'class' => 'btn btn-success', 'content' => '<span class="glyphicon glyphicon-ok"></span> Aceptar', 'onClick' => "verify_new_user_data('".base_url()."');", 'data-toggle' => 'tooltip', 'title' => 'Aceptar');?>
    <?=form_button($attributes);?> 
    <a href="<?php echo base_url(); ?>"><button type="button" class="btn btn-danger" data-toggle="tooltip" title="Cancelar"><i class="glyphicon glyphicon-remove"></i> Cancelar</button></a>
  </div>
  </div>
  <?=form_close(); ?>
</div>
</div>

</div>

<!-- Modal para al actualización de los datos de usuario -->
<a data-toggle="modal" href="#running_operation" id="modal_running_operation" style="display: none"></a>
<div class="modal fade" id="running_operation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="close_modal_running_operation">&times;</button>
        <h5 class="modal-title">Agregando el nuevo usuario, espere por favor...</h5>
      </div>
      <div class="modal-body">
        <img src="<?php echo base_url()?>images/loading.gif" class="img-responsive center-block" alt="Procesando ...">
      </div>        
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
  $(document).ready(function(){

    $(".chosen-select").chosen({no_results_text: "¡No se encuentra!", width: "100%"});

    $("#dni").keyup(function(){
      this.value = (this.value + '').replace(/[^0-9]/g, '');
      var long = $('#dni').val().length;
      var url = "<?php echo base_url(); ?>";
      if ( long > 6 ) {
        //get_alerts(url, 'sign_in', 'get_alerts', 'dni', $('#dni').val().trim());
        var values = new Array();        
        values[0] = $('#dni').val().trim();
        values[1] = $('#student').val();
        get_alerts(url, 'sign_in', 'get_alerts', 'check_user_dni', values);
      } else {
        $('#alert_dni').hide('slow');
        $('#alert_not_match_dni').hide('slow');
        if( !($('#alert_user').is(":visible")) ){ $('#accept').attr('disabled', false); }        
      }
    });

    $("#student").change(function(){
      var long = $('#dni').val().length;
      var url = "<?php echo base_url(); ?>";
      if ( long > 6 ) {
        var values = new Array();        
        values[0] = $('#dni').val().trim();
        values[1] = $('#student').val();
        get_alerts(url, 'sign_in', 'get_alerts', 'check_user_dni', values);
      }
    });

    $("#user").keyup(function(){
      var long = $('#user').val().length;
      var url = "<?php echo base_url(); ?>";
      if ( long > 5 ) {
        get_alerts(url, 'sign_in', 'get_alerts', 'user', $('#user').val().trim());
      } else {
        $('#alert_user').hide('slow');
        if( (!($('#alert_dni').is(":visible"))) && (!($('#alert_not_match_dni').is(":visible"))) ){ $('#accept').attr('disabled', false); }        
      }      
    });    
  });  
</script>