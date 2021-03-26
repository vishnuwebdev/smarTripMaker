<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
|  Google API Configuration
| -------------------------------------------------------------------
|  client_id         string   Your Google API Client ID.
|  client_secret     string   Your Google API Client secret.
|  redirect_uri      string   URL to redirect back to after login.
|  application_name  string   Your Google application name.
|  api_key           string   Developer key.
|  scopes            string   Specify scopes
*/
// $config['google']['client_id']        = '195049498496-7hop732q78a6vj8ud6itb9uvgrngedg4.apps.googleusercontent.com';
// $config['google']['client_secret']    = 'FidowLnrLF8Ec2oEWUPiT3Av';

$config['google']['client_id']        = '771767964802-8he6t8noe9h9sntqd4u9vnkktn4h0sbg.apps.googleusercontent.com';
$config['google']['client_secret']    = 'GiJF4kGRw1F4l_0SuGaFl2bQ';



$config['google']['redirect_uri']     =  site_url().'user/google_login_return';
$config['google']['application_name'] = 'Smarttripmaker';
$config['google']['api_key']          = 'AIzaSyD4OnR-YJZLDyFkLANVGQ2Yn1jS2LfTyHs';
$config['google']['scopes']           = array();