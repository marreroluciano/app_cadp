<div class="row">
<div class="col-xs-12">
  <h5><strong>LISTADO DE EVALUACIONES</strong></h5>
</div>
</div>
<hr/>
<div class="row">
<div class="col-xs-12">

  <table class="table table-hover table table-condensed">
  <thead>
    <tr>      
      <th><small>Fecha de evaluaci&oacute;n</small></th>
      <th><small>Instancia</small></th>
      <th><small>Calificaci&oacute;n</small></th>
      <th><small>Fecha de publicaci&oacute;n</small></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($evaluations as $key => $value) { ?>    
      <tr>
        <?php $datestring = '%d/%m/%Y %h:%ihs.'; $timestamp = strtotime($value->date_hour); ?>
        <td><small><?=mdate($datestring, $timestamp);?></small></td>
        <td><small><?=$value->instance;?></small></td>
        <td><small><?=$value->mark;?></small></td>
        <?php $datestring = '%d/%m/%Y %h:%ihs.'; $timestamp = strtotime($value->publication_date); ?>
        <td><small><?=mdate($datestring, $timestamp);?></small></td>
      </tr>  
    <?php } ?>
  </tbody>
  </table>

</div>
</div>

<div class="row">
<div class="col-xs-12">
  <a href="<?=base_url()?>" type="button" class="btn btn-success" data-toggle="tooltip" title="Volver al inicio"><i class="fa fa-hand-o-left" aria-hidden="true"></i> Volver al inicio </a>
</div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    change_class('menu', 'active');
    change_class('request', '');
    change_class('start', '');
    change_class('absent', '');
    change_class('evaluation', 'active');
    change_class('user_menu', '');
    change_class('my_data', '');
    change_class('change_password', '');
  });
</script>