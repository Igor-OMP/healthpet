<?php

/**
 * Created by PhpStorm.
 * User: GORILLA
 * Date: 28/11/2016
 * Time: 16:11
 */
class LoginModel extends Model
{
    protected $table ='login';
    public function autenticar($post){
        try{
            /**@var $pdo Sql */

            #xd($post);
            $pdo = new Sql();
            #$pdo->setQuery('SELECT * FROM users where user_email = ?');
            $pdo->setQuery('SELECT * FROM login where  login.em_email = ? AND login.pw_senha = ?');
            $pdo->setBind($post['login']);
            $pdo->setBind($post['senha']);
            $pdo->execute();

            if($pdo->getQtd() > 0){
                $user =$pdo->getData()->fetch();
                unset($user['pw_senha']);
                return $user;
            }
        }catch (Exception $e){
            echo  '<div class="alert alert-warning">
                            <strong>Warning!</strong>
                            Erro buscar dados na tabela'.$e->getTrace().'
                            </div>';
        }
        return null;
    }


    public function autenticarMob($post){
        try{
            /**@var $pdo Sql */

            $pdo = new Sql();
            #$pdo->setQuery('SELECT * FROM users where user_email = ?');
            $pdo->setQuery('SELECT * FROM usuario where  usuario.em_email = ? AND usuario.pw_pass = ?');
            $pdo->setBinds($post);
            $pdo->execute();

            if($pdo->getQtd() > 0){
                $user =$pdo->getData()->fetch();
                unset($user['pw_pass']);
                return $user;
            }
        }catch (Exception $e){
            echo  '<div class="alert alert-warning">
                            <strong>Warning!</strong>
                            Erro buscar dados na tabela'.$e->getTrace().'
                            </div>';
        }
        return null;
    }



}