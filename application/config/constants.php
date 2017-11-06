<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

define('SITE_NAME','MP WebNews');
define('HTTP_PATH', (isset($_SERVER['HTTPS']) ? "https://" : "http://") .
  $_SERVER['HTTP_HOST'] . preg_replace('@/+$@', '', dirname($_SERVER['SCRIPT_NAME'])) . '/');
define('ADMIN_THEME_PATH', HTTP_PATH.'themes/admin/');
define('UPLOADS', HTTP_PATH.'uploads/');
define('USR_IMG_PATH', HTTP_PATH.'uploads/employee/');
define('FRONTEND_DATE_VIEW_FORMAT',"d/m/Y");
define('ADMIN_DATE_VIEW_FORMAT',"d/m/Y");
/*Frot End Path*/
define('SITE_THEME_PATH', HTTP_PATH.'themes/frontend/');
define('NOTESHEET_ABS_PATH',FCPATH.APPPATH.'modules/admin_notesheet_master/views/');
define('FILE_UPLOAD_BASE_URL',FCPATH.'uploads');
/* End of file constants.php */
/* Location: ./application/config/constants.php */
define('ADMIN_URL','admin');
define('EDITOR_URL',HTTP_PATH.'themes/admin/plugins/editor/');
define('SITE_STATUS','live');

/*Users*/
define('USERS','users');
define('USERS_PROFILE','users_profile');
define('USERS_ROLE','user_role');
define('COUNTRY','country_master');
define('STATE','states_master');
define('DISTRICT','distric_master');
define('CITY','city_master');


define('CATEGORIES','categories');
define('PRODUCT_MENU','product_as_menu');
define('PRODUCT_IMAGE','product_image');
define('MANAGE_PRODUCT_MENU','product_menu');
define('PRODUCTS_MENULABEL','news_category');
define('NEWS_INDEX','news_index');
define('PRODUCTS','news_master');

//define('PRODUCT_TYPE','product_type');
//define('PRODUCTS','pm_products');

/*Tables*/
/*End Tables*/
/* End of file constants.php */
/* Location: ./application/config/constants.php */
