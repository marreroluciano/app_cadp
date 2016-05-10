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
  <ul class="nav nav-tabs">
  <li class="active"><a href="#panel_new_user" data-toggle="tab"><span class="glyphicon glyphicon-user"></span> Datos de usuario</a></li>
  </ul>
  <div class="tab-content"> <!--Contenedor de los paneles -->
    <hr/>
    <div class="tab-pane active" id="panel_new_user">
      <div class="col-xs-6">

        <div class="form-group form-group-sm">
          <?=form_label('<small> DNI </small>', 'dni', $atr_label); ?>
          <div class="col-sm-8">            
            <?php $atributes = array('type'=>'text', 'id' => 'dni', 'name' => 'dni', 'placeholder' => 'DNI', 'class' => 'form-control', 'maxlength' => 20); ?>
            <?=form_input($atributes); ?>
          </div>
        </div>        

        <div class="form-group form-group-sm">
          <?=form_label('<small> Apellido y Nombre </small>', 'name', $atr_label); ?>
          <div class="col-sm-8">            
            <?php $atributes = array('type'=>'text', 'id' => 'name', 'name' => 'name', 'placeholder' => 'Apellido y Nombre', 'class' => 'form-control', 'maxlength' => 80); ?>
            <?=form_input($atributes); ?>
          </div>
        </div>

        <div class="form-group form-group-sm">
          <?=form_label('<small> Correo electr&oacute;nico </small>', 'email', $atr_label); ?>
          <div class="col-sm-8">
            <?php $atributes = array('type'=>'email', 'id' => 'email', 'name' => 'email', 'placeholder' => 'Correo electr&oacute;nico', 'class' => 'form-control', 'maxlength' => 50); ?>
            <?=form_input($atributes); ?>
          </div>
        </div>   

      </div>

      <div class="col-xs-6">

        <div class="form-group form-group-sm">
          <?=form_label('<small> Usuario </small>', 'user', $atr_label); ?>
          <div class="col-sm-8">
            <?php $atributes = array('type'=>'text', 'id' => 'user', 'name' => 'user', 'placeholder' => 'Nombre de usuario', 'class' => 'form-control', 'maxlength' => 10); ?>
            <?=form_input($atributes); ?>
          </div>
        </div>

        <div class="form-group form-group-sm">
          <?=form_label('<small> Contrase&ntilde;a de usuario </small>', 'pass', $atr_label); ?>
          <div class="col-sm-8">
            <?php $atributes = array('type'=>'password', 'id' => 'pass', 'name' => 'pass', 'placeholder' => 'Contrase&ntilde;a del nuevo usuario', 'class' => 'form-control', 'maxlength' => 10); ?>
            <?=form_input($atributes); ?>
          </div>
        </div>

        <div class="form-group form-group-sm">
          <?=form_label('<small> Confirmar contrase&ntilde;a </small>', 'confirm_pass', $atr_label); ?>
          <div class="col-sm-8">
            <?php $atributes = array('type'=>'password', 'id' => 'confirm_pass', 'name' => 'confirm_pass', 'placeholder' => 'Confirmar contrase&ntilde;a del nuevo usuario', 'class' => 'form-control', 'maxlength' => 10); ?>
            <?=form_input($atributes); ?>
          </div>
        </div>        
      </div>

    </div>  
  </div>

  <div class="row"> 
  <div class="col-xs-12">
    <?php $attributes = array('name' => 'accept', 'id' => 'accept', 'type' => 'button', 'class' => 'btn btn-success', 'content' => '<span class="glyphicon glyphicon-ok"></span> Aceptar', 'onClick' => "verify_new_user_data('".base_url()."');", 'title' => 'Aceptar');?>
    <?=form_button($attributes);?> 
    <a href="<?php echo base_url(); ?>" title="Cancelar"><button type="button" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Cancelar</button></a>
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

    $("#dni").change(function(){
      var long = $('#dni').val().length;
      var url = "<?php echo base_url(); ?>";
      if ( long > 6 ) {
        get_alerts(url, 'sign_in', 'get_alerts', 'dni', $('#dni').val().trim());
      } else {
        if(  !($('#alert_user').is(":visible"))  ){ $('#accept').attr('disabled', false); }
        $('#alert_dni').hide('slow');
      }
    });

    $("#user").change(function(){
      var long = $('#user').val().length;
      var url = "<?php echo base_url(); ?>";
      if ( long > 5 ) {
        get_alerts(url, 'sign_in', 'get_alerts', 'user', $('#user').val().trim());
      } else {
        if(  !($('#alert_dni').is(":visible"))  ){ $('#accept').attr('disabled', false); }
        $('#alert_user').hide('slow');
      }      
    });

    $('#dni').keyup(function (){
      this.value = (this.value + '').replace(/[^0-9]/g, '');
    });
  });  
</script>