<?php

/**
 * Created by PhpStorm.
 * User: IGOR
 * Date: 18/09/2016
 * Time: 21:05
 */
class Core
{

    public function run()
    {

        global $currentModule;

        try {

            $url = '/' . ((isset($_GET['q'])) ? $_GET['q'] : '');

            #if (!strstr($url, 'arquivos')) {

                $params = array();
                if (!empty($url)) {
                    $url = explode('/', $url);
                    array_shift($url);

                    ### Definindo o Módulo
                    if (isset($url[0]) && empty($url[0]) == false) {
                        $currentModule = $url[0];
                        array_shift($url);
                    } else {
                        $currentModule = 'Login';
                    }
                    ## Definindo o Controller
                    if (isset($url[0]) && empty($url[0]) == false) {
                        $currentController = $url[0] . 'Controller';
                        array_shift($url);
                    } else {
                        $currentController = $currentModule . 'Controller';

                        if ($currentController === 'SiteController') {
                            $currentController = 'LoginController';
                        }
                        array_shift($url);
                    }
                    ## Definindo a Action
                    if (isset($url[0]) && empty($url[0]) == false) {
                        $currentAction = $url[0];
                        array_shift($url);
                    } else {
                        $currentAction = 'login';
                    }

                    if (count($url) > 0) {
                        $params = $url;
                    }
                } else {
                    $currentModule = 'Login';
                    $currentController = 'LoginController';
                    $currentAction = 'login';
                }
                require_once 'core/Controller.php';
                #xd($currentModule."/".$currentController."/".$currentAction);
                $controller = new $currentController();
                if (method_exists($controller, $currentAction)) {
                    call_user_func_array(array($controller, $currentAction), $params);
                } else {
                    Controller::error404();
                }

            #}
        } catch (Exception $e) {
            echo '<div class="alert alert-warning">
                            <strong>Warning!</strong>
                            Erro Ao Execultar a inclusão da classe' . $currentController . ':' . $e->getTrace() . '
                            </div>';
        }
    }


}