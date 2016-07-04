
/* cambia el atributto class de un tag */
function change_class(tag_id, new_class){
  $('#'+tag_id).attr('class', new_class);
}

/* verifica si existe un usuario por dni */
function get_alerts(url, controller, method, model_method, value){
  var parameters = {
    "value": value,
    "model_method": model_method
  };

  $.ajax({
    data:  parameters,
    url:   url+controller+'/'+method,
    type:  'post',
    beforeSend: function () {
    },
    success: function (response) {
      $("#alerts").append(response);
    }
  });
}

/* comprueba los datos mínimos del formulario de registro de usuario */
function verify_new_user_data(url){
  var input = document.querySelectorAll("input");  
  for (i = 0; i < input.length; i++) {
    var value = input[i].value;
    if (value.trim().length < 1){ alertify.notify('Faltan completar campos en el formulario.', 'error', 5, function(){  console.log('dismissed'); }); /*alertify.error('Faltan completar campos en el formulario.');*/ return false; }
  }

  if ( ($('#dni').val().trim().length) < 7 ) { alertify.error('El DNI debe tener al menos 7 d&iacute;gitos.'); return false; }

  var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;

  // Se utiliza la funcion test() nativa de JavaScript
  if (!(regex.test($('#email').val().trim()))) {
    alertify.error('La direcci&oacute;n de correo electr&oacute;nico no es v&aacute;lida.'); return false;
  }

  if ( ($('#pass').val().trim().length) < 6 ) { alertify.error('La contrase&ntilde;a debe tener al menos 6 caracteres.'); return false; }


  if  (($('#pass').val().trim()) != ($('#confirm_pass').val().trim())) { alertify.error('Las contrase&ntilde;as no coinciden.'); return false; }
  
  alertify.defaults.glossary.title = '<strong>Confirmaci&oacute;n</strong>';  
  alertify.confirm('Por favor, confirme la creaci&oacute;n del usuario.', function (e) {
           if (e) {
             ajax_method(url, 'sign_in', 'insert_user');
           }
  }).set('modal', true);
}

/* comprueba los datos mínimos del formulario de solicitudes */
function verify_new_request(url){
  var input = document.querySelectorAll("input");
  for (i = 0; i < input.length; i++) {
    var value = input[i].value;    
    if (value.trim().length < 1){
      $( "#form_group_certificate" ).addClass( "has-error" );
      $( "#certificate" ).focus();
      alertify.notify('Faltan completar campos en el formulario. Verifique si ha adjuntado un certificado.', 'error', 5, function(){  console.log('dismissed'); });
      setTimeout(
      function(){
        $( "#form_group_certificate" ).removeClass( "has-error" );
      }, 5000);
      return false;      
    }
  }

  var textarea = document.querySelectorAll("textarea");
  for (i = 0; i < textarea.length; i++) {
    var value = textarea[i].value;
    if (value.trim().length < 1){ 
      $( "#form_group_comments" ).addClass( "has-error" );      
      $( "#comments" ).focus();    
      alertify.notify('Faltan completar campos en el formulario. Verifique si ha ingresado alg&uacute;n comentario.', 'error', 5, function(){  console.log('dismissed'); });
      setTimeout(
      function(){
        $( "#form_group_comments" ).removeClass( "has-error" );
      }, 5000);
      return false;
    }
  }

  alertify.defaults.glossary.title = '<strong>Confirmaci&oacute;n</strong>';  
  alertify.confirm('Por favor, confirme la creaci&oacute;n de la nueva solicitud.', function (e) {
           if (e) {
             ajax_method(url, 'request', 'insert_request');
           }
  }).set('modal', true);
}

/* método ajax */
function ajax_method(url, controller, method){
  var form = $('#form').serializeArray();  
  var parameters = {
    "form": form
  };
  $.ajax({
    data:  parameters,
    url:   url+'index.php/'+controller+'/'+method+'/',
    type:  'post',
    beforeSend: function () {
      $("#result").html("Procesando, espere por favor...");
      $( "#modal_running_operation" ).trigger( "click" );
    },
    success:  function (response) {
      $("#result").html(response);
      $( "#close_modal_running_operation" ).trigger( "click" );        
    }
  });
}