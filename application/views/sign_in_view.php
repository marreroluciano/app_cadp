<?php 
  $attributes = array('class' => 'form-horizontal', 'id'=>'form_sign_in');  
  echo form_open('sign_in/login', $attributes);
?>

<div class="row">
  <div class="col-xs-4">

  <div id="alerts"></div>

  <div class="form-group form-group-sm">
    <label class="col-sm-4 control-label"></label>
    <div class="col-sm-8"><h3>Ingrese sus datos</h3></div>
  </div>

  <div class="form-group form-group-sm">
    <label for="user_name" class="col-sm-4 control-label">Usuario</label>
    <div class="col-sm-8">
      <input type="user" class="form-control" id="user_name" placeholder="Nombre del Usuario" name="user_name" required value="" maxlength="20">
    </div>
  </div>
  <div class="form-group form-group-sm">
    <label for="user_pass" class="col-sm-4 control-label">Contrase&ntilde;a</label>
    <div class="col-sm-8">
      <input type="password" class="form-control" id="user_pass" placeholder="Contraseña del Usuario" name="user_pass" required value="" maxlength="15">
    </div>
  </div>  

  <div class="form-group form-group-sm">
    <label for="clave" class="col-sm-4 control-label"></label>
    <div class="col-sm-8">
      <button type="submit" class="btn btn-login" title="Ingresar al Sistema"><i class="fa fa-sign-in" aria-hidden="true"></i> Ingresar</button>
    </div>
  </div>

  </div>

  <div class="col-xs-2"> </div>


  <div class="col-xs-6">     
    <h3> CADP - Gesti&oacute;n de cambios de turnos </h3>
    <span>Si a&uacute;n no se encuentra registrado, haga click en </span>
    <a href="<?php echo base_url(); ?>/sign_in/register" title="Registrarme como nuevo usuario">registrarme</a>
  </div>
  
</div>
<?=form_close(); ?>

<?php if ((isset($login_error)) && ($login_error == 1)) { ?>
  <script languaje="javascript">
    get_alerts("<?=base_url();?>", 'sign_in', 'get_alerts', 'login_error', null);
  </script> 
<?php } ?>