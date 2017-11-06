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
/* common front page */
$route['default_controller'] = "site/home";

$route['kitchens/(:any)'] = "site/home/kitchen/$1/$1";
$route['logout'] = "users/logout";

$route['about-us'] = "site/home/about_us";
$route['subscription'] = "site/home/subscription";
$route['faq'] = "site/home/faq";
$route['policy-terms-condition'] = "site/home/privacy_policy";
$route['category/(:any)'] = "site/home/category/$1";

$route['admin'] = "admin/admin_auth";
$route['admin/dashboard'] = "admin/admin_dashboard/index";
$route['admin/logout'] = "admin/admin_auth/logout";

$route['admin/user_list'] = "manage_admin/list_user";
$route['admin/manage_user'] = "manage_admin/manage_user";
$route['admin/manage_user/(:any)'] = "manage_admin/manage_user/$1";


$route['admin/manage_page/(:any)'] = "manage_admin/manage_page/index/$1";

$route['admin/manage_cities'] = "manage_admin/manage_location/city_list";
$route['admin/manage_areas'] = "manage_admin/manage_location/area_list";

$route['admin/change_password'] = "manage_admin/user_change_password";

$route['admin/order'] = "manage_admin/manage_orders";
$route['admin/manage_order/(:any)'] = "manage_admin/manage_orders/manage_order_data/$1";

$route['admin/coupon'] = "manage_admin/manage_coupon";
$route['admin/manage_coupon'] = "manage_admin/manage_coupon/manage_coupon_data";
$route['admin/manage_coupon/(:any)'] = "manage_admin/manage_coupon/manage_coupon_data/$1";

$route['admin/menu'] = "manage_admin/manage_product_menu";
$route['admin/manage_menu'] = "manage_admin/manage_product_menu/manage_menu_data";
$route['admin/manage_menu/(:any)'] = "manage_admin/manage_product_menu/manage_menu_data/$1";

$route['admin/manage_location'] = "manage_admin/manage_location/location_list";
$route['admin/manage_food_type'] = "manage_admin/manage_product_menu/food_type";
$route['admin/food_category'] = "manage_admin/food_belongs_category";

$route['admin/manage_time_slots'] = "manage_admin/manage_subscription/delivery_time_slots";
$route['admin/manage_package'] = "manage_admin/manage_subscription/manage_packages";

/* Location: ./application/config/routes.php */