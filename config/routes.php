<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
$route['default_controller'] = "twitter";
$route['(.*)'] = "twitter/index/$1";
$route[''] = 'twitter/index';