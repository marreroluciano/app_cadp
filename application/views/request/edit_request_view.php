<?php  $atr_label = array('class' => 'col-sm-4 control-label'); ?>

<div id="result">

<div class="row"> 
<div class="col-xs-12"> 
  <h5><strong> EDITANDO UNA SOLICITUD </strong></h5>
</div>
</div>

<div class="row"> 
<div class="col-xs-12">
  <?php $attributes = array('class' => 'form-horizontal', 'role'=>'form', 'id' => 'form', 'enctype' => 'multipart/form-data'); ?>
  <?php echo form_open_multipart('', $attributes); ?>

  <div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Datos de la solicitud </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-xs-6">
        <div class="form-group form-group-sm">
          <?=form_label('<small> Tipo solicitud </small>', 'request_types', $atr_label); ?>
          <div class="col-sm-8">
          <?php
            $options = array();
            foreach ($request_types as $key => $value):
              $options[$request_types[$key]->id] = $request_types[$key]->detail;
            endforeach;
          ?>
          <?=form_dropdown('request_types', $options, $request[0]->type_request_id, 'class="form-control" id="request_types" disabled'); ?>
          </div>
        </div>

        <?php if ( $request[0]->type_request_id == 1 ) { ?>

        <div class="form-group form-group-sm" id="form_group_turns">
          <?=form_label('<small> Turno elegido </small>', 'turns', $atr_label); ?>
          <div class="col-sm-8">
          <?php
            $options = array();
            foreach ($turns as $key => $value):
              $options[$turns[$key]->id] = $turns[$key]->detail.': '.$turns[$key]->day_hour;
            endforeach;
          ?>
          <?=form_dropdown('turns', $options, $request[0]->requested_shift, 'class="form-control" id="turns"'); ?>
          </div>
        </div>

        <?php } else { ?>

        <?php
          $date = date_create($request[0]->start_date_justification);
          $date = date_format($date, 'd/m/Y');
        ?>   

        <div class="form-group form-group-sm" id="form_group_date_from">
          <?=form_label('<small> Fecha desde </small>', 'date_from', $atr_label); ?>
          <div class="col-sm-8">
            <div class='input-group date' id='date_from'>
              <input type='text' id="value_date_from" name="value_date_from" class="form-control" value="<?=$date?>"/>
              <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
              </span>
            </div>
          </div>
        </div>

        <?php
          $date = date_create($request[0]->end_date_justification);
          $date = date_format($date, 'd/m/Y');
        ?>  

        <div class="form-group form-group-sm" id="form_group_date_end">
          <?=form_label('<small> Fecha hasta </small>', 'date_end', $atr_label); ?>
          <div class="col-sm-8">
            <div class='input-group date' id='date_end'>
              <input type='text' id="value_date_end" name="value_date_end" class="form-control" value="<?=$date?>"/>
              <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
              </span>
            </div>
          </div>
        </div>    

        <?php } ?>

      </div>

      <div class="col-xs-6">
        <div class="form-group form-group-sm" id="form_group_certificate">
          <?=form_label('<small> Certificado </small>', 'certificate', $atr_label); ?>
          <div class="col-sm-8">
            <input type='file' id="certificate" name="certificate" class="form-control" data-preview-file-type="text"/>            
            <span id="helpBlock" class="help-block"><small>Certificado enviado: <?=$request[0]->attached; ?> </small></span>
            <input type="hidden" name="attached" value="<?=$request[0]->attached; ?>"/>
          </div>
        </div>
        <div class="form-group form-group-sm" id="form_group_comments">          
          <?=form_label('<small> Comentarios </small>', 'comments', $atr_label); ?>
          <div class="col-sm-8">           
            <?=form_textarea('comments', $request[0]->reason, 'class="form-control" style="height:70px;" id="comments"');?>  
          </div>
        </div>        
      </div>

    </div>      
  </div>
  </div>
  <input type="hidden" name="request_id" value="<?=$request[0]->id; ?>"/>
  <div class="row"> 
  <div class="col-xs-12">
    <?php $attributes = array('name' => 'accept', 'id' => 'accept', 'type' => 'button', 'class' => 'btn btn-success', 'content' => '<span class="glyphicon glyphicon-ok"></span> Aceptar', 'onClick' => "verify_request('".base_url()."', 'edit_request')", 'data-toggle' => "tooltip", 'title' => 'Aceptar la nueva solicitud');?>
    <?=form_button($attributes);?>
    <a href="<?php echo base_url();?>request"><button type="button" class="btn btn-danger" data-toggle="tooltip" title="Cancelar"><i class="glyphicon glyphicon-remove"></i> Cancelar</button></a>
  </div>
  </div>  
  <?=form_close(); ?>
</div>
</div>

</div>

<!-- Modal para el alta de paciente -->
<a data-toggle="modal" href="#modal_insert" id="modal_running_operation" style="display: none"></a>
<div class="modal fade" id="modal_insert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="close_modal_running_operation">&times;</button>
        <h5 class="modal-title">Enviando la nueva solicitud, espere por favor...</h5>
      </div>
      <div class="modal-body">
        <img src="<?php echo base_url()?>images/loading.gif" class="img-responsive center-block" alt="Procesando ...">
      </div>        
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">  
  $(document).ready(function(){
   change_class('request', 'active');
   change_class('start', '');
   change_class('contact', '');

   $("#certificate").fileinput({showPreview: false, showUpload: false, showCaption: true, overwriteInitial: false, language: 'es', browseClass: "btn btn-primary btn-sm", removeClass: "btn btn-danger btn-sm" , allowedFileExtensions: ['jpg', 'png', 'gif']});

   $('#date_from, #date_end').datepicker({
     format: 'dd/mm/yyyy',     
     language: 'es',            
     autoclose: true     
   });

   $( "input" ).keypress(function( event ) {
     if ( event.which == 13 ) {
       event.preventDefault();
     }      
   });
  });
</script>