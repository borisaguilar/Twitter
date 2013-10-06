<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['module']['twitter'] = array
(
    'module' => "Twitter",
    'name' => "Twitter Module",
    'description' => "Twitter module, manage your accounts and allow data access to them within the website.",
    'author' => "Boris Aguilar <me@borisaguilar.com>",
    'version' => "0.2",
 
    // 'uri' should be the module's folder in lowercase.
    // From 1.0.3, it is not mandatory to set 'uri'.
    //'uri' => 'twitter',
    'has_admin'=> TRUE,
    'has_frontend'=> TRUE,
);
 
return $config['module']['twitter'];