<?php

/**
 * Created by PhpStorm.
 * User: GORILLA
 * Date: 20/10/2017
 * Time: 12:51
 */
class DebugController
{


    public static function debug($arquivo){
        global $debug_info;
        $debug_info[]= $arquivo;
    }

    public function getDebug(){
        global $debug_info;
        echo "<pre>";
        print_r($debug_info);
        echo "<pre>";
        die;
    }
}