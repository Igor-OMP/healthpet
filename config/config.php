<?php
require 'environment.php';
define('DS', DIRECTORY_SEPARATOR);
define('BASE_PATH', dirname(__DIR__) . DS);
define('BASE_URL', 'http://'.$_SERVER['SERVER_NAME'].'/');
define('BASE_APP', BASE_PATH.'module'.DS);

global $config;
$config = array();

global $db;
$db = array();

global $msg_terminal;

global $msg;

global $tipo;


if (ENVIRONMENT == 'development') {

    $config = [
        'DNS'=>"mysql:host=localhost;dbname=bdhealthpet;",
        'DBUSER'=>"root",
        'DBPASS'=>"mysql",

    ];

} else {
    $config = [
        'DB' => '',
        'HOST' => '',
        'DBUSER' => '',
        'DBPASS' => ''
    ];
}
