<?php

function fabric($class = null){

    if($class == null){
        return null;
    }

    if(strpos($class,'Model') > -1){
        $module = substr($class,0,strlen($class)-strlen('Model'));
        #xd(BASE_APP.ucwords($module).DS.'Model'.DS.$servico.'.php');
        if(file_exists(BASE_APP.ucwords($module).DS.'Model'.DS.$class.'.php')){
            require_once BASE_APP.ucwords($module).DS.'Model'.DS.$class.'.php';
            $obj = new $class();
            return $obj;
        }
    }

}