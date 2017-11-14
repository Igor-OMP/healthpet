<?php

chdir(dirname(__DIR__));
## Arquivo para Debug  - Igor  Oliveira
require 'infra/debug.php';
require 'core/Cache.php';
require 'core/Model.php';
require 'core/functions/url.php';
require 'core/functions/functions.php';
/*require_once 'infra/DebugController.php';*/
require dirname(__DIR__).'/vendor/autoload.php';
ob_start("ob_gzhandler");

/*global $debug;
global $debug_info;

if(empty($debug)){
    $debug = new DebugController();
}*/

//Configurando Compact Assets

#xd($_SERVER);

date_default_timezone_set('America/Sao_Paulo');


/**
 * Default messages namespace
 */
const NAMESPACE_DEFAULT = 'default';

/**
 * Success messages namespace
 */
const NAMESPACE_SUCCESS = 'success';

/**
 * Warning messages namespace
 */
const NAMESPACE_WARNING = 'warning';

/**
 * Error messages namespace
 */
const NAMESPACE_ERROR = 'error';

/**
 * Info messages namespace
 */
const NAMESPACE_INFO = 'info';

global $render;

$render = true;
try{
    spl_autoload_register(function($class){
        global $currentModule;

       /* x($class);
        if($class == 'UsuarioAgendaModel'){
            xd($class);
        }*/
        if(strpos($class,'Controller' ) > -1){
                #x('Entrou no Controller');
            if(file_exists('module/'.$currentModule.'/Controller/'.$class.'.php')){
                require_once 'module/'.$currentModule.'/Controller/'.$class.'.php';
            }
        }
        elseif(stripos($class,'Model') > -1){

            $module = (substr($class,0,stripos($class,'Model')));

            if(file_exists('module'.DS.ucwords($module).DS.'Model'.DS.$class.'.php')){
                require_once 'module'.DS.ucwords($module).DS.'Model'.DS.$class.'.php';
            }
        }
        else if(file_exists('module'.DS.$currentModule.DS.'Model'.DS.$class.'.php')){
                require_once 'module'.DS.$currentModule.DS.'Model'.DS.$class.'.php';
            }

        else if(file_exists('module/'.$currentModule.'/Form/'.$class.'.php')){
            require_once 'module/'.$currentModule.'/Form/'.$class.'.php';
        }

        else{
            require_once 'core/'.$class.'.php';

        }



    });
}catch (Exception $e){
    echo  '<div class="alert alert-warning">
                            <strong>Warning!</strong>
                            Erro Ao Execultar a inclusão da classe'.$class.':'.$e->getTrace().'
                            </div>';
}

## Arquivo de Configuração
require 'config/config.php';
$core = new Core();
$core->run();