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
$a = 'maincontroller';
$route['default_controller'] = $a;
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


//LOGIN PAGE
$route['login'] = $a.'/login';

//LOGOUT PAGE 
$route['logout'] = $a.'/logout';

//ADMIN PAGE
$route['admin'] = $a.'/admin';
$route['admin/notif/(:any)'] = $a.'/admin'; 
$route['admintbl'] = $a.'/adminOrderDash';
$route['clients'] = $a.'/showClients';
$route['genid'] = $a.'/generateId';
$route['showadminclients'] = $a.'/showAdminClients';
$route['insertadminclients'] = $a.'/addAdminClients';
$route['client-profile/:num'] = $a.'/showClientProfile';
$route['proftbldata'] = $a.'/getProfOrdData';
$route['reports'] = $a.'/showReports';
$route['edit-prof-info/:num'] = $a.'/editOrderInfo';
$route['update-del'] = $a.'/checkbox';
$route['sumrep'] = $a.'/sumReport';
$route['forder'] = $a.'/orderFilter'; 
$route['initnoty'] = $a.'/initAdminNoty';
$route['deleteorder'] = $a.'/deleteOrder';
$route['forgot_pwd'] = $a.'/toForgotPwd';
$route['resend_link'] = $a.'/toResendEmail';
$route['authkey/(:any)'] = $a.'/toNewPassword';
$route['edititemstat'] = $a.'/editItemStat';
$route['eprodprice'] = $a.'/editPrice';
$route['logs'] = $a.'/showLogs';
$route['showlogs'] = $a.'/showtblLogs';
//USER PAGE 
$route['user'] = $a.'/user';
$route['genpo'] = $a.'/genpo';
$route['shop'] = $a.'/shopNow';
$route['insertcart'] = $a.'/insertCartData'; //INSERTING FROM CART TO DATABASE
$route['delcart'] = $a.'/delCartData'; 
$route['jsonShop'] = $a.'/getJsonShop';
$route['buynow'] = $a.'/buyFunction';
$route['userorder'] = $a.'/getUserOrder';
$route['settings'] = $a.'/toSettings';
$route['cpwd'] = $a.'/changePwd';
$route['initnoty-user'] = $a.'/initUserNoty';
$route['initusernoti'] = $a.'/initUserNoti';
