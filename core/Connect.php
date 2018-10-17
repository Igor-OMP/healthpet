<?php

/**
 * Created by PhpStorm.
 * User: GORILLA
 * Date: 28/11/2016
 * Time: 16:46
 */
class Connect
{
    private static $connect = null;

    private  function Conectar (){
        try{
            if(self::$connect == null){
                global $config;
                self::$connect = new PDO($config['DNS'],$config['DBUSER'],$config['DBPASS']);

            }
        }catch (Exception $e){
            trigger_error('Erro ao conectar com o banco. '.$e->getMessage(),E_USER_ERROR);
        }
        return self::$connect;
    }

    public function getConnect(){
        return self::Conectar();
    }

}