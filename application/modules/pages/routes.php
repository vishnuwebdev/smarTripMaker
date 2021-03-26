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
$route['default_controller'] = 'pages';
$route['404_override'] = 'pages/error';
$route['contact-us'] = 'pages/contact_us';
$route['about-us'] = 'pages/about_us';
$route['terms-and-conditions'] = 'pages/terms_and_conditions';
$route['faq'] = 'pages/faq';
$route['privacy-policy'] = 'pages/privacy_policy';


$route['partnering']  = 'pages/partnering';

/* ITR Login */
$route['tax-refund']  = 'ITR/tax_refund';
$route['itr-login']  = 'ITR/itr_login';
$route['itr-query']  = 'ITR/itr_query';
$route['lm-welcome']  = 'ITR/lm_welcome';
$route['itr-form']  = 'ITR/itr_form';

$route['our-services']  = 'pages/our_services';

$route['business-setup']  = 'pages/business_setup';
$route['bussiness-setup/company-formation-in-india']  = 'pages/company_formation_in_india';
$route['bussiness-setup/company-formation-outside-india']  = 'pages/company_formation_outside_india';
$route['bussiness-setup/limited-liability-partnership-formation']  = 'pages/limited_liability_partnership_formation';
$route['bussiness-setup/proprietorship-registration']  = 'pages/proprietorship_registration';
$route['bussiness-setup/partnership-firm-registration']  = 'pages/partnership_firm_registration';

$route['statutory-registration']  = 'pages/statutory_registration';
$route['statutory-registration/service-tax']  = 'pages/service_tax';
$route['statutory-registration/excise-duty']  = 'pages/excise_duty';
$route['statutory-registration/vat-cst-professional-tax']  = 'pages/vat_cst_professional_tax';
$route['statutory-registration/permanent-account-number']  = 'pages/permanent_account_number';
$route['statutory-registration/import-export-code']  = 'pages/import_export_code';
$route['statutory-registration/trade-license']  = 'pages/trade_license';
$route['statutory-registration/copyright']  = 'pages/copyright';
$route['statutory-registration/trademark']  = 'pages/trademark';
$route['statutory-registration/shops-establishments']  = 'pages/shops_establishments';
$route['statutory-registration/tan-registration']  = 'pages/tan_registration';


$route['advisory-hotel']  = 'pages/advisory_hotel';
$route['returns-compliance']  = 'pages/returns_compliance';
$route['returns-compliance/service-tax-return']  = 'pages/service_tax_return';
$route['returns-compliance/excise-return']  = 'pages/excise_return';
$route['returns-compliance/vat']  = 'pages/vat';
$route['returns-compliance/professional-tax']  = 'pages/professional_tax';
$route['returns-compliance/tds-return']  = 'pages/tds_return';
$route['returns-compliance/income-tax-return']  = 'pages/income_tax_return';
$route['returns-compliance/returns-compliance']  = 'pages/returns_compliance';
$route['consultancy']  = 'pages/consultancy';
$route['blog'] = 'pages/blog_list';
$route['blog-detail/(:any)'] = 'pages/blog_detail';

$route['event-detail/(:any)'] = 'pages/event_detail';
$route['event'] = 'pages/event_list';

$route['translate_uri_dashes'] = FALSE;
