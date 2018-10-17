<?php

/**
 * Created by PhpStorm.
 * User: GORILLA
 * Date: 03/12/2016
 * Time: 22:39
 */
use Monolog\Logger as Logger;
use Monolog\Handler\StreamHandler as StreamHandler;
use Monolog\Handler\FirePHPHandler as FirePHPHandler;
class Helpers
{
    /**
     *
     * @param string $telefone
     * @return string $telefone
     * Ex:
     * $tel = (61) 9161-3193
     * $tel = Modulo_Helpers_Telefone::telefoneFilter($tel); // retorna 6191613193
     */
    public static function telefoneFilter($telefone)
    {
        return preg_replace('#[() -]#', '', $telefone);
    }

    public static function telefoneMask($telefone)
    {
        if ($telefone) {
            switch (strlen($telefone)) {
                //55554444
                case 8:
                    return substr($telefone, 0, 4) . '-' . substr($telefone, 4, 4);
                //555544444
                case 9:
                    return substr($telefone, 0, 4) . '-' . substr($telefone, 4, 5);
                //6155554444
                case 10:
                    return '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 4) . '-' . substr($telefone, 6, 4);
                //61555544444
                case 11:
                    return '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 4) . '-' . substr($telefone, 6, 5);
                default:
                    return $telefone;
            }
        } else {
            return NULL;
        }
    }

    public static function logger($info){

        if($info != '/favicon.ico'){
            $log = new Logger('name');
            $log->pushHandler(new StreamHandler(BASE_PATH.'data'.DS.'logs'.DS.'control.log', Logger::INFO));
            $log->pushHandler(new FirePHPHandler());
            // add records to the log
            $log->info($info);
        }

    }

    public static function textLimit($txt){

        return $txt;
    }
}