<div class="row">
<div class="col-xs-12">
  <h5><strong>LISTADO DE SOLICITUDES REALIZADAS</strong></h5>
</div> 
</div>

<hr/>
<div class="row">
<div class="col-xs-12">
  <a href="<?php echo base_url();?>request/new_request" title="Nueva Solicitud"> <button type="button" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Nueva Solicitud</button> </a>
</div>
</div>

<div class="row"> 
<div class="col-xs-12">

  <table class="table table-hover table table-condensed">
  <thead>
    <tr>      
      <th><small>Fecha</small></th>
      <th><small>Tipo de Solicitud</small></th>
      <th><small>Estado</small></th>
      <th><small>Acciones</small></th>
    </tr>
  </thead>
  <tbody id="">  
  <?php foreach ($requests as $key => $value) { ?>
  <tr id="">
  	<td><small></small></td>
  	<td><small></small></td>   
  	<td><small></small></td>      
  	<td><small>
  	  <a href="<?php echo base_url();?>request/view/<?=$value['id']; ?>" title="Ver"><button type="button" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-info-sign"></i> Ver</button></a>
      <a href="<?php echo base_url();?>request/edit/<?=$value['id']; ?>" title="Editar"><button type="button" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Editar</button></a>
  	</small></td>
  </tr>	 
  <?php } /* end del foreach */ ?> 
  </tbody>
  </table>
  
</div>
</div>