
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
function verify_request(url, method){
  if( $('#request_types').val() == 2 ) {    
    date_from = $('#value_date_from').val().split("/");
    date_end = $('#value_date_end').val().split("/");   
    var date_from = new Date(date_from[2],(date_from[1]-1),date_from[0]);
    var date_end = new Date(date_end[2],(date_end[1]-1),date_end[0]);
    if (date_from > date_end) { 
      alertify.notify('<i class="fa fa-exclamation-circle" aria-hidden="true"></i> Verifique las fechas ingresadas.', 'error', 5, function(){  console.log('dismissed'); });
      return false;
    }
  }
  var input = document.querySelectorAll("input");  
  for (i = 0; i < input.length; i++) {
    var value = input[i].value;
    var id_input = input[i].id;

    if ((method == 'edit_request') && (id_input == 'certificate')){value='not verify';}
       
    if (value.trim().length < 1) {
      var msg = '';      
      switch (id_input) {
        case 'certificate':
          $( "#form_group_certificate").addClass( "has-error" );
          $( ".kv-fileinput-caption" ).focus();
          msg = 'Verifique si ha selccionado un certificado.';
          break;
        case 'value_date_from':        
          $( "#date_from").addClass( "has-error" );
          $( "#value_date_from" ).focus();
          msg = 'Verifique la fecha desde.';
          break;
        case 'value_date_end':
          $( "#date_end").addClass( "has-error" );
          $( "#value_date_end" ).focus();
          msg = 'Verifique la fecha hasta.';
          break;
        default:break;          
      }

      alertify.notify('<i class="fa fa-exclamation-circle" aria-hidden="true"></i> Faltan completar campos en el formulario. '+msg, 'error', 5, function(){  console.log('dismissed'); });
      setTimeout(
      function(){
        $( "#form_group_certificate").removeClass( "has-error" );
        $( "#date_from").removeClass( "has-error" );
        $( "#date_end").removeClass( "has-error" );
      }, 5000);
      return false;      
    }
  }

  var textarea = document.querySelectorAll("textarea");
  for (i = 0; i < textarea.length; i++) {
    var value = textarea[i].value;
    if (value.trim().length < 1){
      $( "#form_group_"+textarea[i].id).addClass( "has-error" );
      $( "#"+textarea[i].id ).focus();
      alertify.notify('<i class="fa fa-exclamation-circle" aria-hidden="true"></i> Faltan completar campos en el formulario. Verifique si ha ingresado alg&uacute;n comentario.', 'error', 5, function(){  console.log('dismissed'); });
      setTimeout(
      function(){
        $( "#form_group_"+textarea[i].id).removeClass( "has-error" );
      }, 5000);
      return false;
    }
  }

  alertify.defaults.glossary.title = '<strong>Confirmaci&oacute;n</strong>';  
  alertify.confirm('Por favor, confirme la operaci&oacute;n a realizar.', function (e) {
           if (e) {
            var formData = new FormData($('#form')[0]);
            formData.append('tax_file', $('input[type=file]')[0].files[0]);
            formData.append('certificate', $('#certificate').val());
            formData.append('request_types', $('#request_types').val());
            formData.append('turn', $('#turns').val());
            formData.append('value_date_from', $('#value_date_from').val());
            formData.append('value_date_end', $('#value_date_end').val());
            formData.append('comments', $('#comments').val());

            $.ajax({
              data: formData,
              url:   url+'index.php/request/'+method,
              type:  'post',
              processData: false,
              contentType: false,
              beforeSend: function () {
                $("#result").html("Procesando, espere por favor...");
                $( "#modal_running_operation" ).trigger( "click" );
              },
              success:  function (response) {
                $("#result").html(response);
                $( "#close_modal_running_operation" ).trigger( "click" );
              },
              error: function (xhr, ajaxOptions, thrownError) { 
                $("#result").html('<div class="alert alert-danger" role="alert"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> <strong>Error!</strong> Ha ocurrido un problema al actualizar la solicitud: '+thrownError+'</div>');
                $( "#close_modal_running_operation" ).trigger( "click" ); 
              }
            });            
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