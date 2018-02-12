<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Controller_admin';
/*----------Administrador---------*/
$route['inicio'] = 'Controller_admin';
$route['outlogin'] = 'Controller_admin/salir';
$route['participantes'] = 'Controller_admin/participantes';
$route['resultados'] = 'Controller_admin/resultados';
$route['modresultados'] = 'Controller_admin/modificarResultado';
$route['importacionresult'] = 'Controller_admin/importacionresultados';
$route['importando'] = 'Controller_admin/importandoExcel';
/*--------Catalogo de docentes--------*/
$route['agregaUsuario'] = 'Controller_catDocentes/holaMundo';

/*----------Docente---------*/
$route['historicoevaluaciones'] = 'Controller_docente';
$route['miperfil'] = 'Controller_admin/perfil';
$route['up'] = 'Controller_admin/subirFotoPerfil';
/*----------Nivel---------*/
$route['modificaciones'] = 'Controller_nivel';
$route['formulario/(:num)'] = 'Controller_nivel/validarModificacion/$1';
$route['ajax/aceptacambios'] = 'Controller_nivel/cambios';

/*--------Catalogo de cedes--------*/
$route['Catcedes'] = 'Controller_catCedes/index';

/*--------Log Usuarios--------*/
$route['Vistalogs'] = 'Controller_logUsuarios/index';

/*--------Fechas--------*/
$route['Vistafechas'] = 'Controller_layoutFechas/index';

/*--------Importacion--------*/
$route['ImportarAsistencia'] = 'Controller_asistencia/impindex';
$route['catAsistencia'] = 'Controller_asistencia/asistenciaindex';

/*--------Seleccion--------*/
$route['Seleccion'] = 'Controller_seleccion/index';
$route['Fechas'] = 'Controller_Fechas/index';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

