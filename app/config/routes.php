<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['404_override'] = '';


$route['login'] 							= 	"manager/login";
$route['logout'] 							= 	"manager/logout";
$route['admin'] 							= 	"manager/index";
$route['admin/(:any)'] 						= 	"manager/$1";

$route['modal_eliminar'] 						= 	"manager/modal_eliminar";


$route['home'] 								= 	"home/index";
$route['ventas'] 							= 	"home/ventas";
$route['nosotros'] 							= 	"home/nosotros";
$route['contacto'] 							= 	"home/contacto";
$route['licitaciones'] 						= 	"home/licitaciones";
$route['ver-carrito'] 						= 	"home/carrito";
$route['aviso-privacidad']					= 	"home/aviso_privacidad";
$route['procesar_contacto']					=	"home/enviar_contacto";
$route['datos-envio']						= 	"home/datos_envio";
$route['agregar_carrito']					= 	"home/agregar_carrito";
$route['actualizar_carrito']				= 	"home/actualizar_carrito";
$route['vaciar_carrito']					= 	"home/vaciar_carrito";
$route['confirmar_compra']					= 	"home/confirmar";
$route['procesar_pedido']					= 	"home/procesar_pedido";
$route['busqueda?(:any)']					=	"catalogo/buscador/$1/$2";
$route['catalogo']							=	"catalogo/index";
$route['catalogo/([a-z_-]+)/(:any)']		=	"catalogo/listado/$1/$2";
$route['catalogo/(:any)']                   =   "catalogo/listado/$1";
$route['catalogo-fisico']                   =   "catalogo/solicitud_catalogo";
$route['detalle/(:any)']                    =   "catalogo/detalle/$2";
$route['detalle']							=	"catalogo/detalle/$2";
$route['detalle/(:any)/(:any)']             =   "catalogo/detalle/$2";
$route['galerias']							=	"catalogo/galerias";
$route['mantenimiento']                     =   "home/mantenimiento";
$route['newsletter']                     	=   "home/newsletter";
$route['solicitar-catalogo']                =   "home/enviar_solicitud_catalogo";
$route['activar_banner']                    =   "manager/activar_banner";
/* End of file routes.php */
/* Location: ./application/config/routes.php */