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
$route['default_controller'] = 'user/index';
$route['404_override'] = '';

/*admin*/
$route['admin'] = 'user/index';
$route['admin/signup'] = 'user/signup';
$route['admin/create_member'] = 'user/create_member';
$route['admin/login'] = 'user/index';
$route['admin/logout'] = 'user/logout';
$route['admin/login/validate_credentials'] = 'user/validate_credentials';

$route['admin/index'] = 'admin_products/index';
$route['admin/products'] = 'admin_products/index_products';
$route['admin/products/subCategory'] = 'admin_products/get_sub_category';
$route['admin/products/add'] = 'admin_products/add';
$route['admin/products/update'] = 'admin_products/update';
$route['admin/products/update/(:any)'] = 'admin_products/update/$1';
$route['admin/products/delete/(:any)'] = 'admin_products/delete/$1';
$route['admin/products/(:any)'] = 'admin_products/index/$1'; //$1 = page number

$route['admin/manufacturers'] = 'admin_manufacturers/index';
$route['admin/manufacturers/add'] = 'admin_manufacturers/add';
$route['admin/manufacturers/update'] = 'admin_manufacturers/update';
$route['admin/manufacturers/update/(:any)'] = 'admin_manufacturers/update/$1';
$route['admin/manufacturers/delete/(:any)'] = 'admin_manufacturers/delete/$1';
$route['admin/manufacturers/(:any)'] = 'admin_manufacturers/index/$1'; //$1 = page number

$route['admin/categories'] = 'admin_categories/index';
$route['admin/categories/add'] = 'admin_categories/add';
$route['admin/categories/update'] = 'admin_categories/update';
$route['admin/categories/update/(:any)'] = 'admin_categories/update/$1';
$route['admin/categories/delete/(:any)'] = 'admin_categories/delete/$1';
$route['admin/categories/(:any)'] = 'admin_categories/index/$1';

$route['member/product/(:any)'] = 'member_product/index/$1';
$route['member/product'] = 'member_product/index';
$route['member/products/buy'] = 'member_product/buy_product';
$route['member/products/subCategory'] = 'member_product/get_sub_category';
$route['member/products/list'] = 'member_product/show_products';
$route['member/products/buyed/(:any)/(:any)'] = 'member_product/buy_this_product';
$route['member/products/del/(:any)'] = 'member_product/delete_bough_product';
$route['member/history'] = 'buy_product/history_product';

$route['member/profiles'] = 'user/show_user';
$route['user/updateImage'] = 'user/updateUserImage';
$route['member/user/update'] = 'user/updateUser';
$route['member/user/updatePass'] = 'user/change_pass';
$route['member/user/delete'] = 'user/delete_user';





/* End of file routes.php */
/* Location: ./application/config/routes.php */