<div class="row">
<div class="col-xs-12">
  <h5><strong>LISTADO DE INASISTENCIAS</strong></h5>
</div>
</div>
<hr/>
<div class="row">
<div class="col-xs-12">

  <table class="table table-hover table table-condensed">
  <thead>
    <tr>      
      <th><small>Fecha de la clase</small></th>
      <th><small>Estado (Ausente o Justificado)</small></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($absents as $key => $value) { ?>
    <tr>
      <?php $datestring = '%d/%m/%Y'; $timestamp = strtotime($value->date); ?> 
      <td><small><?=mdate($datestring, $timestamp);?> </small></td>
      <td><small><?=$value->detail; ?></small></td>
    </tr>        
    <?php } ?>  
  </tbody>
  </table>

</div>
</div>

<div class="row">'
<div class="col-xs-6">
  <h4><small><span class="label label-danger"><?=$number_absences; ?></span> Inasistencia/s - <span class="label label-warning"><?=$number_excused_absences; ?></span> Justificadas </small></h4>
</div>
</div>
<div class="row">'
<div class="col-xs-12">
  <a href="<?=base_url()?>" type="button" class="btn btn-success" data-toggle="tooltip" title="Volver al inicio"><i class="fa fa-hand-o-left" aria-hidden="true"></i> Volver al inicio </a>
</div>
</div>