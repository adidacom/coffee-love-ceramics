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
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['admin/dashboard'] = 'admin/admin';


//user groups routes
//user groups routes
$route['admin/user-groups'] = 'admin/UserGroups';
$route['admin/user-groups/create'] = 'admin/UserGroups/create';
$route['admin/user-groups/edit/(:any)'] = 'admin/UserGroups/edit/$1';
$route['admin/user-groups/delete/(:any)'] = 'admin/UserGroups/delete/$1';
$route['admin/users/get_by_phone/(:any)'] = 'admin/users/getbyphone/$1';
$route['admin/users/get_by_name_or_phone'] = 'admin/users/getbynameorphone';
$route['admin/backend_users'] = 'admin/users/backendusers';
$route['admin/users/get_deposit_users'] = 'admin/users/getdeposittypeusers';

//colors routes
$route['admin/colors'] = 'admin/colors';
$route['admin/colors/create'] = 'admin/colors/create';
$route['admin/colors/edit/(:any)'] = 'admin/colors/edit/$1';

//product kinds routes
$route['admin/product_kinds'] = 'admin/ProductKinds';
$route['admin/product_kinds/create'] = 'admin/ProductKinds/create';
$route['admin/product_kinds/edit/(:any)'] = 'admin/ProductKinds/edit/$1';
$route['admin/product_kinds/delete/(:any)'] = 'admin/ProductKinds/delete/$1';

//accounting kinds routes
$route['admin/accounting_kinds'] = 'admin/AccountingKinds';
$route['admin/accounting_kinds/create'] = 'admin/AccountingKinds/create';
$route['admin/accounting_kinds/edit/(:any)'] = 'admin/AccountingKinds/edit/$1';
$route['admin/accounting_kinds/delete/(:any)'] = 'admin/AccountingKinds/delete/$1';

//products routes
$route['admin/products'] = 'admin/products';
$route['admin/products/create'] = 'admin/products/create';
$route['admin/products/edit/(:any)'] = 'admin/products/edit/$1';
$route['admin/products/get_product_colors/(:any)'] = 'admin/products/getproductcolors/$1';
$route['admin/products/delete/(:any)'] = 'admin/products/delete/$1';

//products loss routes
$route['admin/product_loss'] = 'admin/ProductsLoss';
$route['admin/product_loss/create'] = 'admin/ProductsLoss/create';
$route['admin/product_loss/edit/(:any)'] = 'admin/ProductsLoss/edit/$1';
$route['admin/product_loss/delete/(:any)'] = 'admin/ProductsLoss/delete/$1';
$route['admin/product_loss/confirm/(:any)'] = 'admin/ProductsLoss/confirm/$1';

//product information routes
$route['admin/product_information'] = 'admin/ProductsInformation';
$route['admin/product_information/create'] = 'admin/ProductsInformation/create';
$route['admin/product_information/edit/(:any)'] = 'admin/ProductsInformation/edit/$1';
$route['admin/product_information/get/(:any)'] = 'admin/ProductsInformation/get/$1';
$route['admin/product_information/delete/(:any)'] = 'admin/ProductsInformation/delete/$1';
$route['admin/product_information/detail/(:any)'] = 'admin/ProductsInformation/detail/$1';
$route['admin/product_information/get_by_sn_or_color'] = 'admin/ProductsInformation/getbysnorcolor';

//orders production routes
$route['admin/orders_production'] = 'admin/OrdersProduction';
$route['admin/orders_production/create'] = 'admin/OrdersProduction/create';
$route['admin/orders_production/edit/(:any)'] = 'admin/OrdersProduction/edit/$1';
$route['admin/orders_production/delete/(:any)'] = 'admin/OrdersProduction/delete/$1';

//orders customer routes
$route['admin/orders_customer'] = 'admin/OrdersCustomer';
$route['admin/orders_customer/create'] = 'admin/OrdersCustomer/create';
$route['admin/orders_customer/saler_create'] = 'admin/OrdersCustomer/salercreate';
$route['admin/orders_customer/edit/(:any)'] = 'admin/OrdersCustomer/edit/$1';
$route['admin/orders_customer/delete/(:any)'] = 'admin/OrdersCustomer/delete/$1';
$route['admin/orders_customer/history/(:any)'] = 'admin/OrdersCustomer/history/$1';
$route['admin/orders_customer/payment_history/(:any)'] = 'admin/OrdersCustomer/paymenthistory/$1';
$route['admin/orders_customer/regist_payment_history'] = 'admin/OrdersCustomer/registpaymenthistory';
$route['admin/orders_customer/get_orders_by_type'] = 'admin/OrdersCustomer/getordersbytype';
$route['admin/orders_customer/get_order_transporter/(:any)'] = 'admin/OrdersCustomer/getordertransporter/$1';

$route['admin/orders/order_transporter_list'] = 'admin/OrdersCustomer/ordertransporterlist';
$route['admin/orders/order_transporter_create'] = 'admin/OrdersCustomer/ordertransportercreate';
$route['admin/orders/order_transporter_edit/(:any)'] = 'admin/OrdersCustomer/ordertransporteredit/$1';

// accounter routes
$route['admin/accounter/order_payments'] = 'admin/accounter/orderpayments';
$route['admin/accounter/regist_order_payment'] = 'admin/accounter/registorderpayment';
$route['admin/accounter/regist_payment_history'] = 'admin/accounter/registpaymenthistory';
$route['admin/accounter/order_payments/history/(:any)'] = 'admin/accounter/paymenthistory/$1';

$route['admin/accounter/deposit_payment_type_list'] = 'admin/accounter/depositpaymenttypelist';
$route['admin/accounter/deposit_payment_type_create'] = 'admin/accounter/depositpaymenttypecreate';
$route['admin/accounter/deposit_payment_type_edit/(:any)'] = 'admin/accounter/depositpaymenttypeedit/$1';
$route['admin/accounter/deposit_payment_type_delete/(:any)'] = 'admin/accounter/depositpaymenttypedelete/$1';

$route['admin/accounter/withdraw_payment_type_list'] = 'admin/accounter/withdrawpaymenttypelist';
$route['admin/accounter/withdraw_payment_type_create'] = 'admin/accounter/withdrawpaymenttypecreate';
$route['admin/accounter/withdraw_payment_type_edit/(:any)'] = 'admin/accounter/withdrawpaymenttypeedit/$1';
$route['admin/accounter/withdraw_payment_type_delete/(:any)'] = 'admin/accounter/withdrawpaymenttypedelete/$1';

$route['admin/accounter/withdraw_list'] = 'admin/accounter/withdrawlist';
$route['admin/accounter/withdraw_list/create'] = 'admin/accounter/withdrawcreate';
$route['admin/accounter/withdraw_list/edit/(:any)'] = 'admin/accounter/withdrawedit/$1';
$route['admin/accounter/withdraw_delete/(:any)'] = 'admin/accounter/withdrawdelete/$1';

$route['admin/accounter/deposit_list'] = 'admin/accounter/depositlist';
$route['admin/accounter/deposit_list/create'] = 'admin/accounter/depositcreate';
$route['admin/accounter/deposit_list/edit/(:any)'] = 'admin/accounter/depositedit/$1';
$route['admin/accounter/deposit_delete/(:any)'] = 'admin/accounter/depositdelete/$1';

//units routes
$route['admin/units'] = 'admin/units';
$route['admin/units/create'] = 'admin/units/create';
$route['admin/units/edit/(:any)'] = 'admin/units/edit/$1';

//stores routes
$route['admin/stores'] = 'admin/stores';
$route['admin/stores/create'] = 'admin/stores/create';
$route['admin/stores/edit/(:any)'] = 'admin/stores/edit/$1';

//permissions routes
$route['admin/permissions'] = 'admin/permissions';

//distribution level routes
$route['admin/distribution_level'] = 'admin/DistributionLevel';
$route['admin/distribution_level/create'] = 'admin/DistributionLevel/create';
$route['admin/distribution_level/edit/(:any)'] = 'admin/DistributionLevel/edit/$1';
$route['admin/distribution_level/delete/(:any)'] = 'admin/DistributionLevel/delete/$1';

//distributions routes
$route['admin/distributions'] = 'admin/distributions';
$route['admin/distributions/create'] = 'admin/distributions/create';
$route['admin/distributions/edit/(:any)'] = 'admin/distributions/edit/$1';
$route['admin/distributions/delete/(:any)'] = 'admin/distributions/delete/$1';

//posts routes
$route['admin/posts'] = 'admin/posts';
$route['admin/posts/create'] = 'admin/posts/create';
$route['admin/posts/edit/(:any)'] = 'admin/posts/edit/$1';
$route['admin/posts/delete/(:any)'] = 'admin/posts/delete/$1';

//tile category routes
$route['admin/tile_category'] = 'admin/TileCategorys';
$route['admin/tile_category/create'] = 'admin/TileCategorys/create';
$route['admin/tile_category/edit/(:any)'] = 'admin/TileCategorys/edit/$1';
$route['admin/tile_category/delete/(:any)'] = 'admin/TileCategorys/delete/$1';

//bank routes
$route['admin/banks/list'] = 'admin/banks';
$route['admin/banks/create'] = 'admin/banks/create';
$route['admin/banks/edit/(:any)'] = 'admin/banks/edit/$1';
$route['admin/banks/delete/(:any)'] = 'admin/banks/delete/$1';

/************************** RESTful API Routs *********************/
$route['api/users/user/(:num)'] = 'api/users/user/id/$1'; // Example 4
$route['api/users/login'] = 'api/users/login';
$route['api/users/signup'] = 'api/users/signup';
$route['api/users/logout'] = 'api/users/logout';
$route['api/users/profile'] = 'api/users/profile';
$route['api/users/update_avatar'] = 'api/users/updateavatar';
$route['api/users/reset_password'] = 'api/users/resetpassword';
$route['api/users/update_nickname'] = 'api/users/updatenickname';
$route['api/products/kinds'] = 'api/products/kinds';
$route['api/products/get_by_kind'] = 'api/products/getbykind';
$route['api/products/get_product'] = 'api/products/getbyid';
$route['api/products/order_create'] = 'api/products/ordercreate';
$route['api/orders/user_orders'] = 'api/products/ordersbyuser';
$route['api/orders/order_detail'] = 'api/products/orderbyid';
$route['api/orders/get_retailers'] = 'api/products/getretailers';
$route['api/user/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4'; // Example 8