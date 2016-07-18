<div class="row">
<div class="col-xs-12">
  <h5><strong>LISTADO DE SOLICITUDES REALIZADAS</strong></h5>
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
  <tr id="">
    <?php $date = date_create($value->date); ?>
  	<td><small><?=date_format($date, 'd/m/Y - h:i:s'); ?></small></td>
  	<td><small><?=$value->type_request_detail; ?></small></td>    
  	<td><i class="<?=$value->request_class; ?>" aria-hidden="true" data-toggle="tooltip" title="<?=$value->request_state_detail; ?>"></i><small> </small></td>
  	<td><small>
  	  <a href="<?php echo base_url();?>request/view/<?=$value->id; ?>"><button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" title="Ver m&aacute;s..."><i class="fa fa-eye" aria-hidden="true"></i></button></a>
      <?php if ($value->id_request_state == 1) { ?>
        <a href="<?php echo base_url();?>request/edit/<?=$value->id; ?>"><button type="button" class="btn btn-warning btn-xs" data-toggle="tooltip" title="Editar"><i class="glyphicon glyphicon-edit"></i></button></a>
      <?php } ?>
  	</small></td>
  </tr>	 
  <?php } /* end del foreach */ ?> 
  </tbody>
  </table>
  
</div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    change_class('request', 'active');
    change_class('start', '');
    change_class('contact', '');
  });
</script>