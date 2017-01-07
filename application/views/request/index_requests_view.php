<div class="row">
<div class="col-xs-12">
  <h5><strong>LISTADO DE SOLICITUDES REALIZADAS</strong></h5>
</div> 
</div>

<!-- fila para proyectar resultados de las acciones posibles para una solicitud -->
<div class="row">
  <div class="col-xs-12" id="result">
  </div>
</div>

<hr/>
<div class="row">
<div class="col-xs-12">
  <a href="<?php echo base_url();?>request/new_request"> <button type="button" class="btn btn-success" data-toggle="tooltip" title="Agregar una nueva solicitud"><i class="glyphicon glyphicon-plus-sign"></i> Nueva Solicitud</button> </a>
</div>
</div>

<div class="row"> 
<div class="col-xs-12">

  <table class="table table-hover table table-condensed">
  <thead>
    <tr>      
      <th><small>Fecha y hora</small></th>
      <th><small>Tipo de Solicitud</small></th>      
      <th><small>Estado</small></th>
      <th><small>Acciones</small></th>
    </tr>
  </thead>
  <tbody id="">  
  <?php foreach ($requests as $key => $value) { ?>
  <?php $style = ''; ?>
  <?php if ($value->id_request_state == 5) { $style.= 'text-decoration: line-through;'; } ?>
  <tr id="row_<?=$value->id; ?>" style="<?=$style;?>">
    <?php $date = date_create($value->date); ?>
  	<td><small><?=date_format($date, 'd/m/Y - h:i'); ?></small></td>
  	<td><small><?=$value->type_request_detail; ?></small></td>    
  	<td id="state_<?=$value->id; ?>"><i class="<?=$value->request_class; ?>" aria-hidden="true" data-toggle="tooltip" title="<?=$value->request_state_detail; ?>"></i></td>
  	<td><small>
  	  <a href="<?php echo base_url();?>request/view/<?=$value->id; ?>"><button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" title="Ver m&aacute;s..."><i class="fa fa-eye" aria-hidden="true"></i></button></a>
      <?php if ($value->id_request_state == 1) { ?>        
        <button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Cancelar solicitud" onclick='cancel_request("<?=base_url()?>",<?=$value->id; ?>)' id="cancel_button_<?=$value->id; ?>"><i class="fa fa-ban" aria-hidden="true"></i></button>
      <?php } ?>
  	</small></td>
  </tr>	 
  <?php } /* end del foreach */ ?> 
  </tbody>
  </table>
  
</div>
</div>

<!-- Modal para el alta de paciente -->
<a data-toggle="modal" href="#modal_insert" id="modal_running_operation" style="display: none"></a>
<div class="modal fade" id="modal_insert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="close_modal_running_operation">&times;</button>
        <h5 class="modal-title">Cancelando la solicitud, espere por favor...</h5>
      </div>
      <div class="modal-body">
        <img src="<?php echo base_url()?>images/loading.gif" class="img-responsive center-block" alt="Procesando ...">
      </div>        
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
  $(document).ready(function(){
    change_class('menu', 'active');
    change_class('request', 'active');
    change_class('start', '');
    change_class('absent', '');
    change_class('evaluation', '');
  });
</script>