<div id="result">

<?php  $atr_label = array('class' => 'col-sm-4 control-label'); ?>
<div class="row"> 
<div class="col-xs-12"> 
  <h5><strong> CONFIGURAR CONTRASE&Ntilde;A </strong></h5>
</div>
</div>

<div class="row">
<div class="col-xs-12">
  <?php $attributes = array('class' => 'form-horizontal', 'role'=>'form', 'id' => 'form'); ?>
  <?php echo form_open('', $attributes); ?>  

  <div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-unlock" aria-hidden="true"></i> Datos de contrase&ntilde;a</div>
  <div class="panel-body">

    <div class="row">
      <div class="col-xs-6">


      </div>
      <div class="col-xs-6">
        
        
      </div>
    </div>  
    
  </div>
  </div>

  <div class="row"> 
  <div class="col-xs-12">
    <?php $attributes = array('name' => 'accept', 'id' => 'accept', 'type' => 'button', 'class' => 'btn btn-success', 'content' => '<span class="glyphicon glyphicon-ok"></span> Aceptar', 'onClick' => "verify_change_password('".base_url()."');", 'data-toggle' => 'tooltip', 'title' => 'Aceptar');?>
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
        <h5 class="modal-title"><?=CHANGE_PASSWORD_DATA; ?></h5>
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
    change_class('my_data', '');
    change_class('change_password', 'active');
  });
</script>