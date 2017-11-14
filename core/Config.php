<?php

/**
 * Created by Igor Oliveira.
 * User: https://github.com/Igor-Oliveira-Mota-Pires
 * Date: 27/05/2017
 * Time: 20:58
 *
 *
 */
class Config
{
    public static function getModules(){
        return include BASE_PATH.DS.'config'.DS.'modules.php';
    }
    public static function getRouters(){
        return include BASE_PATH.DS.'config'.DS.'routers.php';
    }
}