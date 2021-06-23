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
$route['api/(:any)'] = 'frontend/v1/api/$1';
$route['pegawai/(:any)'] = 'frontend/v1/pegawai/$1';
$route['under-construction'] = 'theme/maintenance_site';
$route['page/(:num)/(:any)'] = 'frontend/v1/halaman/statis/$1/$2';
$route['beranda'] = 'frontend/v1/beranda';
$route['login_web'] = 'frontend/v1/users/login';
$route['userguide'] = 'frontend/v1/users/userguide';
$route['daftar'] = 'frontend/v1/daftar';
$route['lupa_password'] = 'frontend/v1/users/lupa_password';
$route['cek-token/(:any)'] = 'frontend/v1/users/cek_token/$1';
$route['reset-pass/(:any)/(:any)'] = 'frontend/v1/users/reset_pass/$1/$2';
$route['album'] = 'frontend/v1/album';
$route['video'] = 'frontend/v1/video';
$route['download'] = 'frontend/v1/download';
$route['bannerlist'] = 'frontend/v1/banner/listimage';
$route['kotak_saran'] = 'frontend/v1/halaman/saran';
$route['kirim_saran'] = 'frontend/v1/halaman/simpan_saran';
$route['survey'] = 'frontend/v1/halaman/survey';
$route['album/(:any)'] = 'frontend/v1/album/detail/$1';
$route['post/(:any)/(:any)/(:any)'] = 'frontend/v1/post/detail/$1/$2/$3';
$route['user/(:any)/(:any)'] = 'frontend/v1/users/profile/$1/$2';
$route['userlist'] = 'frontend/v1/users/user_terdaftar';
$route['disukai/(:any)/(:any)'] = 'frontend/v1/users/disukai/$1/$2';
$route['halaman/(:any)/(:any)'] = 'frontend/v1/users/halaman/$1/$2';
$route['tag/(:any)'] = 'frontend/v1/post_list/tags/$1';
$route['kategori/(:any)/(:any)'] = 'frontend/v1/post_list/views/$1/$2';
$route['banner/(:any)/(:any)'] = 'frontend/v1/banner/detail/$1/$2';

$route['testing'] = 'frontend/v1/beranda/testing';
$route['d/(:any)/(:any)'] = 'frontend/v1/download/d/$1/$2';
$route['leave'] = 'frontend/v1/api/leave';
$route['go/(:any)'] = 'frontend/v1/download/openurl/$1';

// IKM
$route['skm'] = 'frontend/skm/skmIndex';
$route['survei'] = 'frontend/skm/skmIndex/survei';


/*
* @BAWAAN CODEIGNITER
*/
$route['404_override'] = '';
$route['translate_uri_dashes'] = false;
