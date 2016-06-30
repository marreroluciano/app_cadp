<?php  $atr_label = array('class' => 'col-sm-4 control-label'); ?>

<div class="row"> 
<div class="col-xs-12"> 
  <h5><strong> NUEVA SOLICITUD </strong></h5>
</div>
</div>

<div class="row"> 
<div class="col-xs-12">
  <?php $attributes = array('class' => 'form-horizontal', 'role'=>'form', 'id' => 'form_request'); ?>
  <?php echo form_open('', $attributes); ?>

  <div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Datos de la solicitud </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-xs-6">
        <div class="form-group form-group-sm">
          <?=form_label('<small> Tipo solicitud </small>', 'tipo_doc', $atr_label); ?>
          <div class="col-sm-8">
          <?php
            $options = array();
            foreach ($request_types as $key => $value):
              $options[$request_types[$key]->id] = $request_types[$key]->detail;
            endforeach;
          ?>
          <?=form_dropdown('request_types', $options, '', 'class="form-control" id="request_types"'); ?>
          </div>
        </div>
        <div class="form-group form-group-sm">
          <?=form_label('<small> Fecha desde </small>', 'tipo_doc', $atr_label); ?>
          <div class="col-sm-8">
            <div class='input-group date' id='date_from'>
              <input type='text' id="value_date_from" name="date_from" class="form-control" readonly/>
              <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
              </span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-6">
      </div>
    </div>      
  </div>
  </div>
    
  <div class="row"> 
  <div class="col-xs-12">
    <?php $attributes = array('name' => 'accept', 'id' => 'accept', 'type' => 'button', 'class' => 'btn btn-success', 'content' => '<span class="glyphicon glyphicon-ok"></span> Aceptar', 'onClick' => '', 'title' => 'Aceptar');?>
    <?=form_button($attributes);?>
    <a href="<?php echo base_url();?>request" title="Cancelar"><button type="button" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Cancelar</button></a>
  </div>
  </div>
  <?=form_close(); ?>
</div>
</div>

<!-- Modal para el alta de paciente -->
<a data-toggle="modal" href="#modal_insert" id="modal_insert_click" style="display: none"></a>
<div class="modal fade" id="modal_insert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="close_modal_insert">&times;</button>
        <h5 class="modal-title">Enviando la nueva solicitud, espere por favor...</h5>
      </div>
      <div class="modal-body">
        <img src="<?php echo base_url()?>images/loading.gif" class="img-responsive center-block" alt="Procesando ...">
      </div>        
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- recuperamos los datos del paciente si es que existe -->
<script type="text/javascript">
  $(document).ready(function(){
   change_class('request', 'active');
   change_class('start', '');
   change_class('contact', ''); 
   
   $('#date_from').datepicker({
     format: 'dd/mm/yyyy',     
     language: 'es'
     //dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
   });

   $( "input" ).keypress(function( event ) {
     if ( event.which == 13 ) {
       event.preventDefault();
     }      
   });
  });
</script>
