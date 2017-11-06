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
$route['dashboard'] = "site/home/dashboard";
$route['site/logout'] = "users/logout";
$route['about-us'] = "site/home/about_us";
$route['partner-with-us'] = "site/home/partner_with_us";
$route['faq'] = "site/home/faq";
$route['policy-terms-condition'] = "site/home/privacy_policy";
$route['category/(:any)'] = "site/home/category/$1";
$route['page/(:any)'] = "site/home/inner_page/$1";
$route['detail/(:any)'] = "site/home/news_detail/$1";
$route['admin'] = "admin/admin_auth";
$route['admin/dashboard'] = "admin/admin_dashboard/index";
$route['logout'] = "admin/admin_auth/logout";
$route['admin/manage_page/(:any)'] = "manage_admin/manage_page/index/$1";
$route['admin/manage_country'] = "manage_admin/manage_location/country_list";
$route['admin/manage_state'] = "manage_admin/manage_location/state_list";
$route['admin/change_password'] = "manage_admin/user_change_password";

$route['admin/menu'] = "manage_admin/manage_product_menu";
$route['admin/manage_menu'] = "manage_admin/manage_product_menu/manage_menu_data";
$route['admin/manage_menu/(:any)'] = "manage_admin/manage_product_menu/manage_menu_data/$1";
$route['admin/manage_district'] = "manage_admin/manage_location/district_list";
$route['admin/manage_location'] = "manage_admin/manage_location/location_list";

$route['admin/ads_list'] = "manage_admin/manage_ads";
$route['admin/add_ads'] = "manage_admin/manage_ads/add_ads_view";
$route['admin/update_ads/(:any)'] = "manage_admin/manage_ads/add_ads_view/$1";
$route['admin/advertisement'] = "manage_admin/Manage_ads";
$route['admin/news/category'] = "manage_admin/manage_category";
$route['admin/news_list'] = "manage_admin/manage_news/news_list";
$route['admin/add_news'] = "manage_admin/manage_news/add_news_view";
$route['admin/news/view/(:any)'] = "manage_admin/manage_news/view_single_news/$1";
$route['admin/update_news/(:any)'] = "manage_admin/manage_news/add_news_view/$1";

/*Users*/
$route['news/category/(:any)'] = "site/home/category_news_list/$1";
$route['admin/user_role/(:any)'] = "manage_admin/list_user_role/$1";
$route['admin/user_list'] = "manage_admin/list_user";
$route['admin/manage_user'] = "manage_admin/manage_user";
$route['admin/add_user/(:any)'] = "manage_admin/manage_user/$1";
$route['admin/edit/(:any)/(:any)'] = "manage_admin/manage_user/$1/$2";

/* Location: ./application/config/routes.php */