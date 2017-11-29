<?php

/**
 * Created by Igor Oliveira.
 * User: https://github.com/Igor-Oliveira-Mota-Pires
 * Date: 27/05/2017
 * Time: 21:15
 *
 *
 */

class Core
{

    public function run()
    {
        global $currentModule;

        require_once 'core/Controller.php';
        try {

            $url = '/' . ((isset($_GET['q'])) ? $_GET['q'] : '');
            $modules = Config::getModules();
            $router = Config::getRouters();
            #if (!strstr($url, 'arquivos')) {
            Helpers::logger($url);

            $params = array();
            if (!empty($url) && $url != '/') {
                $url = explode('/', $url);
                array_shift($url);

                #Definindo o Controller
               if(isset($url[0]) && !empty($url[0])){
                   $indice = strtolower($url[0]);
                   if(array_key_exists($indice,$router)){
                       $currentModule =$router[$indice]['module'];
                       $controller = ucwords($router[$indice]['controller']);
                       $action_default = $router[$indice]['action_default'];
                       #xd($currentModule ." ". $controller ." " .$action_default);
                   }else{
                       $currentModule = 'Login';
                       $controller = $modules['Login']['controller'];
                       $action_default = 'login';
                   }
                   array_shift($url);

                   $currentController = new $controller();
               }

              #xd($currentController);
               #Definindo a Action
                #xd($url);
               if(isset($url[0]) && !empty($url[0])){
                   if(stripos($url[0],'-') != false)
                       $url[0] = str_replace('-','_',$url[0]);

                    if(method_exists($currentController,$url[0])){
                        $action = $url[0];
                        array_shift($url);
                    }
                    else{
                        Controller::error404();
                    }
               }else{
                   $action = $action_default;
               }
                #Definindo os parametros
                if (count($url) > 0) {
                    $params = $url;
                }

                #x($controller ." " .$action);

            }else{
                $currentModule='Login';
                $currentController = new LoginController();
                $action='login';
                $params=[];
            }


            call_user_func_array(array($currentController, $action), $params);
        } catch (Exception $e) {
            xd('Error:<pre>'.$e->getTraceAsString().'</pre>'.'<pre>'.$e->getMessage().'</pre>');
           Controller::error404();
        }
    }
}