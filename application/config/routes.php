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

$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

// --------------- Backend panel ---------------------------------

//login
$route['admin/login'] ='admin/login';

//service  --> done
$route['admin/service_get'] = 'admin/service/get_services';
$route['admin/service_create'] = 'admin/service/create_service';
$route['admin/service_delete'] = 'admin/service/delete_service';
$route['admin/service_edit'] = 'admin/service/edit_service';
$route['admin/service_update'] = 'admin/service/update_service';
$route['admin/service_status'] = 'admin/service/status_service';
$route['admin/service_active_get'] = 'admin/service/get_active_service';

//admin -->done
$route['admin/admin_get'] ='admin/admin/get_admins'; 
$route['admin/admin_create'] = 'admin/admin/create_admin';
$route['admin/admin_delete'] ='admin/admin/delete_admin';
$route['admin/admin_edit'] = 'admin/admin/edit_admin';
$route['admin/admin_update'] = 'admin/admin/update_admin'; 

//area --> done
$route['admin/area_get'] ='admin/area/get_areas'; 
$route['admin/area_create'] = 'admin/area/create_area';
$route['admin/area_delete'] ='admin/area/delete_area';
$route['admin/area_edit'] = 'admin/area/edit_area';
$route['admin/area_update'] = 'admin/area/update_area'; 
$route['admin/area_active_get'] = 'admin/area/get_active_area';

//users
$route['admin/user_get'] ='admin/user/get_users'; 
$route['admin/user_create'] = 'admin/user/create_user';
$route['admin/user_delete'] ='admin/user/delete_user';
$route['admin/user_edit'] = 'admin/user/edit_user';
$route['admin/user_update'] = 'admin/user/update_user'; 

//milk
$route['milk/get_milktype'] ='admin/milk/get_milktype'; 
$route['milk/milktype_edit'] ='admin/milk/edit_milktype'; 




// --------------- /Backend panel ---------------------------------