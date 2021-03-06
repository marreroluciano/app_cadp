
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
  for (i = 1; i < input.length; i++) {
    var value = input[i].value;    
    if (value.trim().length < 1){ alertify.notify(INCOMPLETE_FIELDS, 'error', 5, function(){  console.log('dismissed'); }); $( "#form_group_"+input[i].id).addClass( "has-error" ); $( "#"+input[i].id ).focus(); setTimeout( function(){ $( "#form_group_"+input[i].id).removeClass( "has-error" ); }, 5000); return false; }
  }

  if ( ($('#dni').val().trim().length) < 7 ) { alertify.error(INCOMPLETE_DNI); $( "#form_group_dni").addClass( "has-error" ); $( "#dni" ).focus(); setTimeout( function(){ $( "#form_group_dni").removeClass( "has-error" ); }, 5000); return false; }

  var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;

  // Se utiliza la funcion test() nativa de JavaScript
  if (!(regex.test($('#email').val().trim()))) {
    alertify.error(WRONG_EMAIL); $( "#form_group_email").addClass( "has-error" ); $( "#email" ).focus(); setTimeout( function(){ $( "#form_group_email").removeClass( "has-error" ); }, 5000); return false;
  }

  if ( ($('#user').val().trim().length) < 5 ) { alertify.error(USER_INCOMPLETE); $( "#form_group_user").addClass( "has-error" ); $( "#user" ).focus(); setTimeout( function(){ $( "#form_group_user").removeClass( "has-error" ); }, 5000); return false; }

  if ( ($('#pass').val().trim().length) < 5 ) { alertify.error(PASS_INCOMPLETE); $( "#form_group_pass").addClass( "has-error" ); $( "#pass" ).focus(); setTimeout( function(){ $( "#form_group_pass").removeClass( "has-error" ); }, 5000); return false; }


  if  (($('#pass').val().trim()) != ($('#confirm_pass').val().trim())) { alertify.error(NOT_MATCH_PASS); $( "#form_group_confirm_pass").addClass( "has-error" ); $( "#confirm_pass" ).focus(); setTimeout( function(){ $( "#form_group_confirm_pass").removeClass( "has-error" ); }, 5000); return false; } 

  alertify.defaults.glossary.title = "<strong>"+CONFIRMATION_TITLE+"</strong>";
  alertify.confirm(CONFIRMATION_TEXT, function (e) {
           if (e) {
             ajax_method(url, 'user', 'insert_user', 'result', 'modal_running_operation', 'close_modal_running_operation');
           }
  }).set('modal', true);
}

/* comprueba los datos mínimos del formulario de edición de los datos del usuario */
function verify_edit_user_data(url){  
  // Se utiliza la funcion test() nativa de JavaScript
  var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
  if (!(regex.test($('#email').val().trim()))) {
    alertify.error(WRONG_EMAIL); $( "#form_group_email").addClass( "has-error" ); $( "#email" ).focus(); setTimeout( function(){ $( "#form_group_email").removeClass( "has-error" ); }, 5000); return false;
  }

  alertify.defaults.glossary.title = "<strong>"+CONFIRMATION_TITLE+"</strong>";
  alertify.confirm(CONFIRMATION_TEXT, function (e) {
           if (e) {
             $("#student").prop('disabled', false);
             $("#dni").prop('disabled', false);
             ajax_method(url, 'user', 'edit_user', 'result', 'modal_running_operation', 'close_modal_running_operation');
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
function ajax_method(url, controller, method, id_result, id_modal_before, id_modal_success){
  var form = $('#form').serializeArray();
  var parameters = {
    "form": form
  };
  $.ajax({
    data:  parameters,
    url:   url+'index.php/'+controller+'/'+method+'/',
    type:  'post',    
    beforeSend: function () {
      $("#"+id_result).html(WAITING_RESULT);
      $( "#"+id_modal_before ).trigger( "click" );
    },
    success:  function (response) {
      $("#"+id_result).html(response);
      $( "#"+id_modal_success ).trigger( "click" );
    }
  });
}

function cancel_request(url, request_id){
  alertify.defaults.glossary.title = "<strong>"+CONFIRMATION_TITLE+"</strong>";
  alertify.confirm(CONFIRMATION_TEXT, function (e) {
           if (e) {
             var parameters = {
               "request_id": request_id
             };
             $.ajax({
               data:  parameters,
               url: url+'request/cancel_request',
               type:  'post',    
               beforeSend: function () {
                 $("#result").html(WAITING_RESULT);
                 $( "#modal_running_operation").trigger( "click" );
               },
               success:  function (response) {
                 $("#result").html(response);
                 $( "#close_modal_running_operation").trigger( "click" );
               }
             });             
           }
  }).set('modal', true);
}

/* verifica si hay algo seleccionado */
function veryfy_checked_input (url, name, controller, method, id_result, id_modal_before, id_modal_success){
  if(!$("input[name="+name+"]:checked").val()) {
    alertify.notify('<i class="fa fa-exclamation-circle" aria-hidden="true"></i> Debe seleccionar alguna opción.', 'error', 5, function(){  console.log('dismissed'); });
  } else {
      alertify.defaults.glossary.title = "<strong>"+CONFIRMATION_TITLE+"</strong>";
      alertify.confirm(CONFIRMATION_TEXT, function (e) {
      if (e) { ajax_method(url, controller, method, id_result, id_modal_before, id_modal_success); }
  }).set('modal', true);    
  }  
}

/* verifica los inputs del cambio de contraseña */
function verify_change_password(url){
  var input = document.querySelectorAll("input");
  for (i = 0; i < input.length; i++) {
    var value = input[i].value;   
    if ( (value.trim().length) < 6) {
      alertify.error(PASS_INCOMPLETE);
      $( "#"+input[i].id).focus();
      switch(input[i].id) {
        case 'current_password': 
          $( "#form_group_current_password").addClass( "has-error" );
          setTimeout( function(){ $( "#form_group_current_password").removeClass( "has-error" ); }, 5000);
        break;
        case 'new_password': 
          $( "#form_group_new_password").addClass( "has-error" );
          setTimeout( function(){ $( "#form_group_new_password").removeClass( "has-error" ); }, 5000);
          break;
        case 'rewrite_password': 
          $( "#form_group_rewrite_password").addClass( "has-error" );
          setTimeout( function(){ $( "#form_group_rewrite_password").removeClass( "has-error" ); }, 5000);
          break;
      }      
      return false;
    }
  }
  if ( ($('#new_password').val().trim()) != ($('#rewrite_password').val().trim()) ) { 
    alertify.error(NOT_MATCH_PASS);
    $( "#rewrite_password").focus();
    $( "#form_group_rewrite_password").addClass( "has-error" );
    setTimeout( function(){ $( "#form_group_rewrite_password").removeClass( "has-error" ); }, 5000);
    return false;
  }

  alertify.defaults.glossary.title = "<strong>"+CONFIRMATION_TITLE+"</strong>";
  alertify.confirm(CONFIRMATION_TEXT, function (e) {
           if (e) {
             ajax_method(url, 'user', 'edit_password', 'result', 'modal_running_operation', 'close_modal_running_operation');
           }
  }).set('modal', true);  
}