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
$route['news'] = 'frontend/v1/api/news';
$route['under-construction'] = 'theme/maintenance_site';
$route['page/(:any)'] = 'frontend/v1/halaman/statis/$1';
$route['beranda'] = 'frontend/v1/beranda';
$route['album'] = 'frontend/v1/album';
$route['video'] = 'frontend/v1/video';
$route['download'] = 'frontend/v1/download';
$route['bannerlist'] = 'frontend/v1/banner/listimage';
$route['kotak_saran'] = 'frontend/v1/halaman/saran';
$route['kirim_saran'] = 'frontend/v1/halaman/simpan_saran';
$route['album/(:any)'] = 'frontend/v1/album/detail/$1';
$route['blog/(:any)'] = 'frontend/v1/post/detail/$1';
$route['user/(:any)/(:any)'] = 'frontend/v1/users/profile/$1/$2';
$route['userlist'] = 'frontend/v1/users/user_terdaftar';
$route['disukai/(:any)/(:any)'] = 'frontend/v1/users/disukai/$1/$2';
$route['halaman/(:any)/(:any)'] = 'frontend/v1/users/halaman/$1/$2';
$route['tag/(:any)'] = 'frontend/v1/post_list/tags/$1';
$route['k/(:any)'] = 'frontend/v1/post_list/views/$1';
$route['koran-online'] = 'frontend/v1/halaman/koran_online';
$route['sponsor'] = 'frontend/v1/halaman/sponsor';
$route['b/(:any)'] = 'frontend/v1/banner/detail/$1/$2';
$route['logout'] = 'frontend/v1/users/logout';

// Akun Login, Register
$route['login_web'] = 'frontend/v1/users/login';
$route['userguide'] = 'frontend/v1/users/userguide';
$route['daftar'] = 'frontend/v1/daftar';
$route['register-status'] = 'frontend/v1/daftar/register_status';
$route['lupa_password'] = 'frontend/v1/users/lupa_password';
$route['kebijakan-privacy-policy'] = 'frontend/v1/users/kebijakan';
$route['cek-token/(:any)'] = 'frontend/v1/users/cek_token/$1';
$route['reset-pass/(:any)/(:any)'] = 'frontend/v1/users/reset_pass/$1/$2';

// Lainnya
$route['testing'] = 'frontend/v1/beranda/testing';
$route['d/(:any)/(:any)'] = 'frontend/v1/download/d/$1/$2';
$route['leave'] = 'frontend/v1/api/leave';
$route['go/(:any)'] = 'frontend/v1/download/openurl/$1';

// SKM
$route['skm'] = 'frontend/skm/skmIndex';
$route['laporan'] = 'frontend/skm/skmLaporan';
$route['cetak'] = 'frontend/skm/skmIndex/cetakFormulir/$1';
$route['ikm'] = 'frontend/skm/skmIndex/ikm';
$route['survei'] = 'frontend/skm/skmIndex/survei';
$route['finish/(:any)'] = 'frontend/skm/skmProses/selesai/$1';
$route['invalid/(:any)'] = 'frontend/skm/skmProses/invalid/$1';
$route['closed'] = 'frontend/v1/halaman/closed';

// RSS
$route['rss'] = 'frontend/v1/rssFeed';
$route['rss_amp'] = 'frontend/v1/rssFeed/amp';
$route['rss_categorys'] = 'frontend/v1/rssFeed/categorys';
$route['rss_tags'] = 'frontend/v1/rssFeed/tags';

// AMP
$route['amp'] = 'frontend/amp/blog';
$route['amp/blog'] = 'frontend/amp/blog/blogList';
$route['amp/page'] = 'frontend/amp/page';
$route['amp/404'] = 'frontend/amp/errors/error_404';
$route['amp/(:any)'] = 'frontend/amp/blog/post/$1';
$route['amp/blog/(:any)'] = 'frontend/amp/blog/category/$1';
$route['amp/page/(:any)'] = 'frontend/amp/page/detail/$1';

// GPR
$route['widget-gpr-bkppdblg'] = 'frontend/gpr/widget/gpr_widget';
$route['-/(:any)'] = 'frontend/lp/landingpage/orbit/$1';

// API SKM
$route['api-skm'] = 'frontend/v1/apiSkm';
$route['api-skm/(:any)'] = 'frontend/v1/apiSkm/$1';

// USERPORTAL
$route['facebook'] = 'frontend/v1/facebook';
$route['facebook_outh'] = 'frontend/v1/facebook/facebook_outh';

// PEGAWAI
$route['pegawai/(:any)'] = 'frontend/v1/pegawai/$1';

// Sitemap
$route['sitemaps.xml'] = 'frontend/v1/sitemaps';

/*
* @BAWAAN CODEIGNITER
*/
$route['404'] = 'ErrorRequest';
$route['translate_uri_dashes'] = true;
