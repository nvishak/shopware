<?php return array (
  'db' => 
  array (
    'host' => 'localhost',
    'port' => '3306',
    'username' => 'root',
    'password' => '',
    'dbname' => 'shopware4',
  ),
    'template' => [
        'forceCompile' => true,
    ],
    'front' => [
        'showException' => true,
        'throwExceptions' => true,
        'noErrorHandler' => false,
    ],

//Show low level PHP errors
    'phpsettings' => [
        'display_errors' => 1,
    ],
    'csrfProtection' => [
        'frontend' => true,
        'backend' => false
    ],
);