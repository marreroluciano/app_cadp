<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/* CONSTANTES DEL SISTEMA */
define('ACRONYM', 'CADP'); // Iniciales del Sistema.
define('INITIAL_TITLE', 'CADP - Gesti&oacute;n del curso'); // título inicial del sistema.
define('MY_USER_DATA_TITLE', ' Mis datos de usuario'); // título de la página de los datos del usuario.
define('INITIAL_TEXT', 'Si es alumno de Conceptos de Algoritmos, Datos y Programas y se encuentra inscripto en Guaran&iacute;, entonces puede registrarse haciendo click en '); // texto inicial
define('LOGIN_ERROR', ' El usuario y/o la contrase&ntilde;a son incorrectos.'); // error en el inicio de sesión
//define('ALREADY_EXISTS_DNI', ' El DNI Por favor, ingrese su DNI correctamente.'); // error de que ya existe el DNI que se ha ingresado
define('NOT_MATCH_DNI', ' El DNI ingresado no coincide con el alumno seleccionado. Por favor, seleccione e ingrese los datos correctamente.'); // error de coincidencia de DNI
define('EXISTING_USER', ' El nombre de usuario ingresado ya se encuentra en uso. Por favor, ingrese otro nombre de usuario.'); // error de existencia de nombre usuario
define('NEW_USER_ERROR', ' El usuario no ha podido ser creado.'); // error al crear un nuevo usuario. 
define('USER_CREATED_SUCCESSFULLY', ' El usuario ha sido creado correctamente. Ya puede ingresar utilizando su nombre de usuario y su clave.'); // usuario creado correctamete.
define('DATABASE_ERROR', ' Ha ocurrido un error en la Base de Datos.'); // error en la Base de Datos.
define('CREATING_NEW_USER', ' Creando el nuevo usuario, espere por favor...'); // creando un nuevo usuario.
define('EDITING_USER_DATA', ' Editando los datos de usuario, espere por favor...'); // creando un nuevo usuario.
define('USER_EDITED_SUCCESSFULLY', ' Los datos del usuario fueron editados correctamente.'); // usuario editado correctamente.
define('USER_EDITED_ERROR', ' Ha ocurrido un problema y no fue posible editar los datos del usuario.'); // error al editar los datos del usuario.