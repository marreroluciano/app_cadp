<div id="result">

<?php  $atr_label = array('class' => 'col-sm-4 control-label'); ?>
<div class="row"> 
<div class="col-xs-12"> 
  <h5><strong> MIS DATOS </strong></h5>
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

        <?php $atributes = array('type'=>'hidden', 'id' => 'student_id', 'name' => 'student_id', 'value' => $student->student_id); ?>
        <?=form_input($atributes); ?>

        <div class="form-group form-group-sm">
          <?=form_label('<small> Alumno </small>', 'student', $atr_label); ?>
          <div class="col-sm-8">
            <?php $atributes = array('type'=>'text', 'id' => 'student', 'name' => 'student', 'placeholder' => 'Ingrese su apeliido y nombre', 'class' => 'form-control', 'maxlength' => 50, 'value' => $student->surname_and_name, 'disabled'=>'disabled'); ?>
            <?=form_input($atributes); ?>
          </div>
        </div>

        <div class="form-group form-group-sm" id="form_group_dni">
          <?=form_label('<small> DNI </small>', 'dni', $atr_label); ?>
          <div class="col-sm-8">            
            <?php $atributes = array('type'=>'text', 'id' => 'dni', 'name' => 'dni', 'placeholder' => 'Ingrese su DNI', 'class' => 'form-control', 'maxlength' => 10, 'value' => $student->dni, 'disabled'=>'disabled'); ?>
            <?=form_input($atributes); ?>
          </div>
        </div>

      </div>
      <div class="col-xs-6">
        
        <div class="form-group form-group-sm" id="form_group_email">
          <?=form_label('<small> Correo electr&oacute;nico </small>', 'email', $atr_label); ?>
          <div class="col-sm-8">
            <?php $atributes = array('type'=>'email', 'id' => 'email', 'name' => 'email', 'placeholder' => 'Ingrese un correo electr&oacute;nico', 'class' => 'form-control', 'maxlength' => 50, 'value' => $user->email); ?>
            <?=form_input($atributes); ?>
          </div>
        </div>

        <div class="form-group form-group-sm" id="form_group_file_number">
          <?=form_label('<small> Legajo </small>', 'file_number', $atr_label); ?>
          <div class="col-sm-8">
            <?php $atributes = array('type'=>'text', 'id' => 'file_number', 'name' => 'file_number', 'placeholder' => 'Ingrese su legajo', 'class' => 'form-control', 'maxlength' => 7, 'value' => $student->file_number); ?>
            <?=form_input($atributes); ?>  
          </div>
        </div>

      </div>
    </div>  
    
  </div>
  </div>

  <div class="row"> 
  <div class="col-xs-12">
    <?php $attributes = array('name' => 'accept', 'id' => 'accept', 'type' => 'button', 'class' => 'btn btn-success', 'content' => '<span class="glyphicon glyphicon-ok"></span> Aceptar', 'onClick' => "verify_edit_user_data('".base_url()."');", 'data-toggle' => 'tooltip', 'title' => 'Aceptar');?>
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
        <h5 class="modal-title"><?=EDITING_USER_DATA; ?></h5>
      </div>
      <div class="modal-body">
        <img src="<?php echo base_url()?>images/loading.gif" class="img-responsive center-block" alt="Procesando ...">
      </div>        
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
  $(document).ready(function(){
    change_class('menu', '');
    change_class('request', '');
    change_class('start', '');
    change_class('absent', '');
    change_class('evaluation', '');
    change_class('user_menu', 'active');
    change_class('my_data', 'active');
    change_class('change_password', '');
  });
</script>