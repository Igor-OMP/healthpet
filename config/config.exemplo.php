<?php
require 'environment.php';
define('DS', DIRECTORY_SEPARATOR);
define('BASE_PATH', dirname(__DIR__) . DS);
define('BASE_ASSETS', '/atas/public');
define('BASE_IMG', '/projetoSS/Modules/Application/View/assets/img');
define('BASE_URL', 'http://dev.ata.br');

global $config;
$config = array();

global $db;
$db = array();

global $msg_terminal;

global $msg;

global $tipo;


if (ENVIRONMENT == 'development') {

    $config = [
        #'DNS' => "mysql:host=mysql.assejus.org.br;dbname=assejus;",
        #'DBUSER' => "assejus",
        #'DBPASS' => "Idea457",
        'DNS'=>"mysql:host=localhost;dbname=assejus;",
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
