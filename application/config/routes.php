<?php

defined('BASEPATH') or exit('No direct script access allowed');

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

$route['default_controller'] = 'theme';

/*
* @HALAMAN BACKEND
*/
$route['login-system'] = 'login';

/*
* @BACKEND ROUTES
* (PARAMETER MODULE, ADD, EDIT, UPDATE)
*/

$route['module/(:any)'] = 'backend/module/$1';

$route['tools/([^/]+)'] = 'backend/tools/$1';

$route['cpns/([^/]+)'] = 'backend/cpns/$1';
$route['cpns/([^/]+)/([^/]+)'] = 'backend/cpns/$1/$2';

$route['module/(:any)/add'] = 'backend/module/$1/add';
$route['module/(:any)/edit/(:any)'] = 'backend/module/$1/edit/$2';
$route['module/(:any)/update/(:any)'] = 'backend/module/$1/update/$2';

/*
* @FRONT END
*/
$route['page/(:num)/(:any)'] = 'frontend/v1/halaman/statis/$1/$2';
$route['beranda'] = 'frontend/v1/beranda';
$route['login_web'] = 'frontend/v1/users/login';
$route['daftar'] = 'frontend/v1/daftar';
$route['lupa_password'] = 'frontend/v1/users/lupa_password';
$route['album'] = 'frontend/v1/album';
$route['kotak_saran'] = 'frontend/v1/halaman/saran';
$route['kirim_saran'] = 'frontend/v1/halaman/simpan_saran';
$route['survey'] = 'frontend/v1/halaman/survey';
$route['album/(:any)'] = 'frontend/v1/album/detail/$1';
$route['post/(:any)/(:any)/(:any)'] = 'frontend/v1/post/detail/$1/$2/$3';
// $route['label?q=(:any)'] = 'frontend/v1/post_list/tags/?q=$1';


/*
* @BAWAAN CODEIGNITER
*/
$route['404_override'] = '';
$route['translate_uri_dashes'] = false;
