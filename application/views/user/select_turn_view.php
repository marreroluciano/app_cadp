<?php
  
  //print_r('<pre>'); print_r($student); print_r('</pre>');
  //print_r('<pre>'); print_r($turns); print_r('</pre>');

?>

<div id="result">

<?php  $atr_label = array('class' => 'col-sm-4 control-label'); ?>
<div class="row"> 
<div class="col-xs-12"> 
  <h5><strong> ELECCI&Oacute;N DE TURNO </strong></h5>
</div>
</div>

<div id="alerts"></div>

<div class="row">
<div class="col-xs-12">
  <?php $attributes = array('class' => 'form-horizontal', 'role'=>'form', 'id' => 'form'); ?>
  <?php echo form_open('', $attributes); ?>  

  <div class="panel panel-default">
  <div class="panel-heading"><span class="glyphicon glyphicon-time"></span> Elecci&oacute;n de la banda horaria </div>
  <div class="panel-body">

    <div class="row">
      <div class="col-xs-12">
        <h3><?=SELECT_TURN_TITLE;?></h3>
        <span><?=SELECT_TURN_TEXT?></span>
        <hr/>
      </div>

      <div class="col-xs-6">
        <div class="radio">
        <label>
          <?php if ($turns[0]->limit > $turns[0]->current_amount) { ?>
            <input type="radio" name="turns" id="turn_<?=$turns[0]->id; ?>" value="<?=$turns[0]->id; ?>">
            <?php $commentary = ''; ?>
          <?php } else { $commentary = '(completo)'; } ?>
          <strong><?=$turns[0]->detail.' '.$commentary;?></strong><br/>
          - TEOR&Iacute;A: <?=$turns[0]->day_hour_theory;?><br/>
          - PR&Aacute;CTICA: <?=$turns[0]->day_hour;?>
        </label>
        </div>
      </div>
      
      <div class="col-xs-6">
        <div class="radio">
        <label>
          <?php if ($turns[1]->limit > $turns[1]->current_amount) { ?>
            <input type="radio" name="turns" id="turn_<?=$turns[1]->id; ?>" value="<?=$turns[1]->id; ?>">
            <?php $commentary = ''; ?>
          <?php } else { $commentary = '(completo)'; } ?>
          <strong><?=$turns[1]->detail.' '.$commentary;?></strong><br/>
          - TEOR&Iacute;A: <?=$turns[1]->day_hour_theory;?><br/>
          - PR&Aacute;CTICA: <?=$turns[1]->day_hour;?>
        </label>
        </div>
      </div>
      
    </div>  
    
  </div>
  </div>

  <div class="row"> 
  <div class="col-xs-12">
    <?php $attributes = array('name' => 'confirm', 'id' => 'confirm', 'type' => 'button', 'class' => 'btn btn-success', 'content' => '<span class="glyphicon glyphicon-ok"></span> Confirmar', 'onClick' => "veryfy_checked_input('".base_url()."', 'turns', 'select_turn', 'set_turn', 'result', 'modal_running_operation', 'close_modal_running_operation');", 'data-toggle' => 'tooltip', 'title' => 'Confirmar turno');?>
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
        <h5 class="modal-title"><?=SELECTING_TURN; ?></h5>
      </div>
      <div class="modal-body">
        <img src="<?php echo base_url()?>images/loading.gif" class="img-responsive center-block" alt="Procesando ...">
      </div>        
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->