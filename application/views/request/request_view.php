<div class="row"> 
<div class="col-xs-12"> 
  <h5><strong> SOLICITUD </strong></h5>
</div>
</div>

<div class="row"> 
<div class="col-xs-12">
<div class="panel panel-default">
<div class="panel-heading"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Datos de la solicitud</div>
<div class="panel-body">
  <div class="row">    
    <div class="col-xs-6">
      <ul class="list-group">
        <li class="list-group-item"><small><strong>Tipo de solicitud: </strong><?=$request[0]->type_request_detail;?></small></li>
        <?php 
          switch ($request[0]->type_request_id) {
            case 1:
              $turn = $this->turn_model->get_turn($request[0]->requested_shift);
              echo '<li class="list-group-item"><small><strong>Pasar al:</strong> '.$turn[0]->detail.'</small></li>';
            break;
            case 2:
              $date_from = date_create($request[0]->start_date_justification);
              $date_end = date_create($request[0]->end_date_justification);
              $date_from = date_format($date_from, 'd/m/Y');
              $date_end = date_format($date_end, 'd/m/Y');
              echo '<li class="list-group-item"><small><strong>Fecha desde:</strong> '.$date_from.'</small></li>';
              echo '<li class="list-group-item"><small><strong>Fecha hasta:</strong> '.$date_end.'</small></li>';
            break;
        }?>
        <li class="list-group-item"><small><strong>Comentarios: </strong><?=$request[0]->reason;?></small></li>
        <?php if ($request[0]->id_request_state == 1) {  $evaluation_date = 'SIN DEFINIR'; $state_reason = 'SIN DEFINIR'; } else { ?>
        <?php $evaluation_date = date_create($request[0]->evaluation_date); ?>
        <?php $evaluation_date = date_format($evaluation_date, 'd/m/Y'); ?>
        <?php $state_reason = $request[0]->state_reason; ?>
        <?php } ?>
        <li class="list-group-item"><small><strong>Estado: </strong><?=$request[0]->request_state_detail;?> -- <strong>Fecha de proceso: </strong><?=$evaluation_date;?></small></li>
        <li class="list-group-item"><small><strong>Comentarios del estado: </strong><?=$state_reason;?></small></li>
      </ul>	
    </div>

    <div class="col-xs-6">
    </div>

  </div>  
</div>
</div>
</div>
</div>

<div class="row">'
<div class="col-xs-12">
  <a href="<?=base_url()?>request" type="button" class="btn btn-success" data-toggle="tooltip" title="Volver al listado"><i class="fa fa-hand-o-left" aria-hidden="true"></i> Volver al listado </a>
</div>
</div>
  
<script type="text/javascript">  
  $(document).ready(function(){
   change_class('request', 'active');
   change_class('start', '');
   change_class('contact', '');
  });
</script>
