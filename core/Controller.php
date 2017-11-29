<?php

/**
 * Created by PhpStorm.
 * User: IGOR
 * Date: 18/09/2016
 * Time: 21:40
 */

use PHPMailer\PHPMailer\PHPMailer as PhpMailer;

abstract class Controller
{

    protected $data =array();


    protected static $session;
    protected static $chave = 89;
    protected static $add_text = "compremaisprojeto";
    protected $form;

    const MSG_SUCCESS ='SUCCESS';
    const MSG_DANGER ='DANGER';
    const MSG_WARNING ='WARNING';
    const MSG_INFO ='INFO';
    /**
     * Controller constructor.
     * @param $data
     */
    public function __construct()
    {
        $this->init();
    }

    protected function init(){
        $this->_setForm();
    }

    private function _setForm(){
        $class = get_class($this);
        $module = str_replace('Controller','',$class);
        $class = str_replace('Controller','Form',$class);
        $class_form = str_replace('Form','_Form',$class);
        $class_dir = BASE_PATH.'module'.DS.$module.DS.'Form'.DS.$class.'.php';

        if(file_exists($class_dir)){

            $class = (strtolower(implode('-',explode('_',$class))));
            $this->form = new $class();
        }

    }

    protected function module_conf($module,$idx=null){
        if(!empty($module) && file_exists(BASE_PATH.'module'.DS.ucwords($module).DS.'config'.DS.'config.php')){
            $array = include(BASE_PATH.'module'.DS.ucwords($module).DS.'config'.DS.'config.php');

            if($idx != null)
                $array = $array[$idx];

            return $array;
        }
        return null;
    }


    /** Funcoes de Criptografia */
    public function enc($word)
    {
        $word .= md5(sha1(self::$add_text));
        $s = strlen($word) + 1;
        $nw = "";
        $n = self::$chave;
        for ($x = 1; $x < $s; $x++) {
            $m = $x * $n;
            if ($m > $s) {
                $nindex = $m % $s;
            } else if ($m < $s) {
                $nindex = $m;
            }
            if ($m % $s == 0) {
                $nindex = $x;
            }
            $nw = $nw . $word[$nindex - 1];
        }
        return $nw;
    }

    /**
     * @param string $word
     * @return string
     */
    public function dec($word)
    {

        $word = trim($word);
        $s = strlen($word) + 1;
        $nw = "";
        $n = self::$chave;
        for ($y = 1; $y < $s; $y++) {
            $m = $y * $n;
            if ($m % $s == 1) {
                $n = $y;
                break;
            }
        }
        for ($x = 1; $x < $s; $x++) {
            $m = $x * $n;
            if ($m > $s) {
                $nindex = $m % $s;
            } else if ($m < $s) {
                $nindex = $m;
            }
            if ($m % $s == 0) {
                $nindex = $x;
            }
            $nw = $nw . $word[$nindex - 1];
        }
        $t = strlen($nw) - strlen(md5(sha1(self::$add_text)));
        return substr($nw, 0, $t);
    }

    public function toRoute($url = null, $params=null)
    {

        if($params !=null){
            extract($params);
        }
        header('Location:' .BASE_URL. $url);

        die;
    }

    public static function moeda($valor = 0)
    {
        return number_format($valor, 2, ',', '.');
    }

    public function loadTemplate($viewName, $viewData = array())
    {
        $viewData = array_merge($viewData,$this->data);

        if (!empty($viewData)) {
            extract($viewData);
        }

        include 'module/Application/View/index.php';
    }
    public function setData($key,$data){
        $this->data[$key] = $data;
    }

    public function mergeData($array=array()){
       $this->data = array_merge($this->data,$array);
    }

    public function loadViewTemplate($viewName, $viewData = [], $controller = null)
    {
        global $currentModule;
        if (!empty($controller)) {
            $currentModule = $controller;
        }
        $viewData = array_merge($viewData,$this->data);
        if (is_array($viewData)) {
            extract($viewData);
        }

        include 'module/' . $currentModule . '/View/' . $viewName . '.php';
    }

    public function render($view, $data = null)
    {

        if(is_array($data)) {
            extract($data);
        }
        include "module".DS."Application".DS."View".DS.$view.".php";
    }
    public function renderMob($view, $data = null)
    {

        if(is_array($data)) {
            extract($data);
        }
        include "module".DS."Mobile".DS."View".DS.'structure'.DS.$view.".php";
    }

    public function loadView($viewName, $viewData = array())
    {
        $viewData = array_merge($viewData,$this->data);
        if (!empty($viewData)) {
            extract($viewData);
        }

        global $currentModule;
        include 'module/' . $currentModule . '/View/' . $viewName . '.php';
    }

    public function loadMobTemplate($viewName, $viewData = array()){
        $viewData = array_merge($viewData,$this->data);

        if (!empty($viewData)) {
            extract($viewData);
        }

        include 'module/Mobile/View/index.php';
    }

    public static function  error404(){
       require BASE_PATH.'module'.DS.'Application'.DS.'View'.DS.'layout'.DS.'error'.DS.'error-404.php';
        die;
    }

    public function hasMobileSession($option = null)
    {
        session_start();
        if (isset($_SESSION['user_mob'])) {
            return true;
        }
        return false;
    }

    public function hasMobileIdentify($option = null)
    {
        session_start();
        if (!isset($_SESSION['user_mob'])) {
            $this->route('/mobile');
            #$this->route('');
        }if($option !=null){
            $user = (new Sessions())->get_session_data('user');
            if(!in_array($option,$user)){
                $this->error404();
                }
        }
    }

    public function hasIdentify($option = null)
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            $this->route('/login');
            #$this->route('');
        }if($option !=null){
            $user = (new Sessions())->get_session_data('user');
            if(!in_array($option,$user)){
                $this->error404();
            }
        }
    }

    public function tirarAcentos($string)
    {
        return preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/"), explode(" ", "a A e E i I o O u U n N"), $string);
    }



    public function addMessage($alert=[])
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            $this->route('/login');
            #$this->route('');
        }
        $session = new Sessions();
        $session->set_session_data('flash_message',['alert'=>$alert]);

    }

    public function addFlashMessage($status= Controller::MSG_SUCCESS,$msg = null )
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            $this->route('/login');
            #$this->route('');
        }

        $alert=[
          'status'=>$status,
          'msg'=>$msg
        ];
        $session = new Sessions();
        $session->set_session_data('flash_message',['alert'=>$alert]);

    }

    public function addFlashMobMessage($status= Controller::MSG_SUCCESS,$msg = null )
    {

        $alert=[
            'status'=>$status,
            'msg'=>$msg
        ];
        $session = new Sessions();
        $session->set_session_data('flash_message',['alert'=>$alert]);

    }

    public function fabric($model = null)
    {

        if ($model) {
            #xd(BASE_PATH.'module'.DS.$model.DS.'Model'.DS.$model.'Model.php');
            require_once(BASE_PATH . 'module' . DS . $model . DS . 'Model' . DS . $model . 'Model.php');
            $obj = $model . 'Model';
            return new $obj();
        }
    }

    public function redirect($data = null)
    {
        $url = $data;
        if ($data != null) {
            if (is_array($data)) {
                if (isset($data['module'])) {
                    #return DS . $data['module'] . DS . $data['controller'] . DS . $data['action'];
                   $url =  DS . strtolower($data['controller']) . DS . $data['action'];
                }
                #return DS . $data['controller'] . DS . $data['controller'] . DS . $data['action'];
               $url=  DS .strtolower($data['controller']) . DS . $data['action'];
            } elseif (is_string($data)) {

               $url = $data;
            }
        }
        return $url;

    }

    public function isPost()
    {
        if(!empty($_POST)){
            return true;
        }else{
            return false;
        }
    }
    public function isFiles($name = null)
    {

        if(!empty(($name==null)?$_FILES:$_FILES[$name])){
            return true;
        }else{
            return false;
        }
    }

    public function getPost($key = null)
    {
        if ($key != null) {
            $post = $_POST;
            if (array_key_exists($key, $post)) {
                return $post[$key];
            }
        } else {
            return $_POST;
        }
    }


    public function getFiles($name = null)
    {
        if (isset($_FILES) && !empty($_FILES)) {
            if (isset($_FILES[$name])) {
                return $_FILES[$name];
            }
            return $_FILES;
        }
    }

    public function getRequest($option=null)
    {
        if (isset($_REQUEST) && !empty($_REQUEST)) {
            if (!empty($option) && array_key_exists($option, $_REQUEST)) {
                return $_REQUEST[$option];
            }
            return $_REQUEST;
        }
    }
    public function pullGet($option=null)
    {
        if (isset($_GET) && !empty($_GET)) {
            if (!empty($option) && array_key_exists($option, $_GET)) {
                return $_GET[$option];
            }
            return $_GET;
        }
    }

    public function unserialize($data){
        $data = explode('&',$data);
        foreach($data as $d){
           $dado = explode('=',$d);
            $array[$dado[0]]=$dado[1];
        }
        return $array;
    }
    /**
     * @param $file
     * @param $local
     * @param null $mixed
     * @return string|null
     */
    public function uploadFile($file, $local, $mixed = null)
    {
        $array_type= ['image/jpep','image/gif','image/png'];

        try {
            if ($file['type'] != 'application/img' && $file['error'] == 0) {
                if (!file_exists($local)) {
                    mkdir($local, 0777);
                }
                /** $ext pegando a extensão do arquivo */
                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                $ext = strtolower($ext);

                $file['name'] = implode('_', explode(' ', $this->tirarAcentos($file['name'])));

                $file_name = md5($file['name'] . 'arquivo_upload');

                if (file_exists(BASE_PATH . $local . $file_name . '.' . $ext)) {
                    return str_replace('public' . DS, DS, $local . '' . $file_name . '.' . $ext);
                }
                $destino = $local . '' . $file_name . '.' . $ext;
                if (!@move_uploaded_file($file['tmp_name'], $destino)) {
                    throw new Exception('Erro ao mover para temp');
                }
                $url = str_replace('public' . DS, DS, $local . '' . $file_name . '.' . $ext);

                return $url;
            }

            if ((($file['type'] == 'application/img')|| (in_array($file['type'],$array_type))) && $file['error'] == 0) {
                if (!is_array($file)) {
                    throw new Exception('Arquivo inválido');
                }

                if (!isset($file['tmp_name']) && !isset($file['type']) && (strstr($file['type'], '/', true) == 'image')) {
                    throw new Exception('Arquivo inválido');
                }

                if (!isset($file['error']) && $file['erro'] != 0) {
                    throw new Exception('Arquivo inválido');
                }

                $arquivo_tmp = $file['tmp_name'];
                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                $ext = strtolower($ext);

                $nome_img = md5($file['name'] . '' . date('Y-m-d H:i:s') . '' . rand(0, 99999999)) . '.' . $ext;

                if (strstr('.jpg;.jpeg;.gif;.png', $ext)) {
                    $nome_temp = $file['name'];
                    $destino_tmp = 'public/data/tmp/' . $nome_temp;

                    if (!@move_uploaded_file($arquivo_tmp, $destino_tmp)) {
                        throw new Exception('Erro ao mover para temp');
                    }
                }

                if (!empty($mixed)) {
                    if (isset($mixed['largura']) && isset($mixed['altura'])) {
                        $altura = $mixed['altura'];
                        $largura = $mixed['largura'];
                    }
                }
                list($lar_ori, $alt_ori) = getimagesize('public/data/tmp/' . $nome_temp);
                if (isset($mixed['calc'])) {
                    $razao = $lar_ori / $alt_ori;

                    /* Calculo para definir tamanho padrao de  imagem*/

                    if ($largura / $altura > $razao) {
                        $largura = $altura * $razao;
                    } else {
                        $altura = $largura / $razao;
                    }
                }
                $imagem_final = imagecreatetruecolor($largura, $altura);
                switch ($ext) {
                    case 'png':
                        $img_ori = imagecreatefrompng($destino_tmp);
                        break;
                    case 'jpeg':
                    case 'jpg':
                        $img_ori = imagecreatefromjpeg($destino_tmp);
                        break;
                    case 'gif':
                        $img_ori = imagecreatefromgif($destino_tmp);
                        break;
                }
                imagecopyresampled($imagem_final, $img_ori, 0, 0, 0, 0, $largura, $altura, $lar_ori, $alt_ori);
                switch ($ext) {
                    case 'png':
                        imagepng($imagem_final, $local . '' . $nome_img);
                        break;
                    case 'jpeg':
                    case 'jpg':
                        $img_ori = imagejpeg($imagem_final, $local . '' . $nome_img, 70);
                        break;
                    case 'gif':
                        $img_ori = imagegif($imagem_final, $local . '' . $nome_img);
                        break;
                }
                $url = str_replace("public/", "/", $local . '' . $nome_img);

                if (!unlink($destino_tmp)) {
                    echo ' erro ao excluir arquivo da tmp';
                }


            }
            return $url;

        } catch (Exception $e) {
            echo ' Erro ao fazer upload de imagem :' . $e->getMessage();
        }

        return null;
    }

    public function salvarBase64ToImg($name,$file,$path,$newWidth=128,$newHeight = 128){

        if($file == null)
            return false;

        $base_path = BASE_PATH;

        if (!file_exists($base_path.$path)) {
            mkdir($path, 0777);
        }

        $type = substr($file,5,stripos($file,';')-5);
        $file = substr($file,stripos($file,',')+1);

        $imgbin= base64_decode($file);

        $tmpfname = tempnam(sys_get_temp_dir(),'base64_decode_');

        $handle = fopen($tmpfname,'w');
        fwrite($handle,$imgbin);
        fclose($handle);

        /*Limpando as variáveis*/
        $imgbin = null;
        $img = null;

        switch($type){
            case 'image/png':
                $ext ='png';
                $img = imagecreatefrompng($tmpfname);
                break;
            case 'image/jpeg':
                $ext ='jpg';
                $img = imagecreatefromjpeg($tmpfname);
                break;
        }

        $nome_img = md5($name. date('Y-m-d H:i:s'). rand(0, 99999999)) . '.' . $ext;

        if ($img != null) {

            //Resimensiona a imagem
            $originalWidth  = imageSX($img);
            $originalHeight = imageSY($img);

            if($originalWidth > $originalHeight)
            {
                $widthRatio = $newWidth;
                $heightRatio = $originalHeight*($newHeight / $originalWidth);
            }

            if($originalWidth < $originalHeight)
            {
                $widthRatio = $originalWidth*($newWidth / $originalHeight);
                $heightRatio = $newHeight;
            }

            if($originalWidth == $originalHeight)
            {
                $widthRatio = $newWidth;
                $heightRatio = $newHeight;
            }

            $resizedImg = imagecreatetruecolor($widthRatio, $heightRatio);

            imagecopyresampled($resizedImg, $img, 0, 0, 0, 0, $widthRatio, $heightRatio, $originalWidth, $originalHeight);

            switch ($type) {
                case 'image/png':
                    imagepng($resizedImg,$base_path.$path . '' . $nome_img);
                    break;
                case 'image/jpeg':
                    imagejpeg($resizedImg, $base_path.$path . '' . $nome_img);
                    break;
                case 'image/gif':
                    imagegif($resizedImg, $base_path.$path . '' . $nome_img);
                    break;
            }
           // x($path);
           /* switch ($ext) {
                case 'png':
                    imagepng($resizedImg, $path . '' . $nome_img);
                    break;
                case 'jpeg':
                case 'jpg':
                    $img_ori = imagejpeg($resizedImg, $path . '' . $nome_img, 70);
                    break;
                case 'gif':
                    $img_ori = imagegif($resizedImg, $path . '' . $nome_img);
                    break;
            }*/
            $url = str_replace("public/", "/", $path . '' . $nome_img);
            unlink($tmpfname); //Deleta o temporário

            return $url;
        }



        return false;
    }

    public function terminal($bool = true)
    {
        if (!$bool) {
            global $render;
            return $render = $bool;
        }
    }

    public function setSession($session)
    {
        if (!self::$session) {
            self::$session = $session;
        }
    }

    public function route($url,$data = null){
        if($data != null && is_array($data)){
            extract($data);
        }
        header('Location:' . $url);
        die;
    }

    /***
     * Converte a data de [2015-08-09 16:12:39] para [09/08/2015 16:12:39]
     * @param $dataMysql
     * @return string
     */
    public static function converterDataHoraBancoMySQL2Brazil($dataMysql)
    {
        return isset($dataMysql) && $dataMysql ? date('d/m/Y H:i:s', strtotime($dataMysql)) : "";
    }

    public static function converterDataHoraBancoMySQL2DataHoraBrazil($dataMysql)
    {
        return isset($dataMysql) && $dataMysql ? date('d/m/Y H:i:s', strtotime($dataMysql)) : "";
    }

    /***
     * Converte a data de [09/08/2015 16:12:39] para [2015-08-09 16:12:39]
     * @param $dataBrazil
     * @return string
     */
    public static function converterDataHoraBrazil2BancoMySQL($dataBrazil)
    {
        $dataConvertida = "";
        if (isset($dataBrazil) && $dataBrazil) {
            $arDataHora = explode(" ", $dataBrazil);
            $data = $arDataHora[0];
            $hora = isset($arDataHora[1]) ? $arDataHora[1] : '00:00:00';
            $array = explode("/", $data);
            $array = array_reverse($array);
            $str = implode($array, "/");
            $str .= ' ' . $hora;
            $dataConvertida = date("Y-m-d H:i:s", strtotime($str));
        }

        return $dataConvertida;
    }

    /**
     * Converte a data de [09/08/2015] para [2015-08-09]
     * @param $dataBrazil
     * @return string
     */
    public static function converterDataBrazil2BancoMySQL($dataBrazil)
    {
        $array = explode("/", $dataBrazil);
        $array = array_reverse($array);
        $str = implode($array, "/");

        return date("Y-m-d", strtotime($str));
    }

    public static function converterDataRegex($dataBrazil, $return = 'd-m-Y')
    {
        $array = explode('/', $dataBrazil);
        $str = join('/', $array);
        return date($return, strtotime($str));

    }

    /***
     * Converte a data de [2015-08-09] para [09/08/2015]
     * @param $dataMysql
     * @return string
     */
    public static function converterDataBancoMySQL2Brazil($dataMysql)
    {
        if (isset($dataMysql) && $dataMysql) {
            return date('d/m/Y', strtotime($dataMysql));
        } else {
            return '';
        }
    }

    public static function converterDataHoraBancoMySQL2DataBrazil($dataMysql)
    {
        if (isset($dataMysql) && $dataMysql) {
            return date('d/m/Y', strtotime($dataMysql));
        } else {
            return '';
        }
    }

    public function send_email($email,$nome,$id){

        $mail = new PHPMailer();
       try{
           $cheksum =base64_encode(sha1('InitCriptografia')).
                     base64_encode(md5($email."healthpet_recuperacao_senha_".date("d/m/y",strtotime("now")))).
                     base64_encode(sha1('EndCriptografia')).
                     base64_encode(sha1('Nome:').$email);

           $msg =
               'Para que você possa redefinir sua senha acesse o link abaixo:'.'<br>'.
               "http://dev.health.br/mobile/redefinir?t=".$cheksum."&e=".base64_encode($email)."&u=".base64_encode($nome)."&i="
                        .base64_encode($this->enc($id));

           $assunto = addslashes('Redefinir Senha Health Pet');

           $para = $email;

           $corpo= "Nome:".$nome."- Email:".$email;
           $cabecalho= "From:Health Pet Support"."\r\n".
               "Replay-to:".$email."\r\n".
               "X-Mailer: PHP/". phpversion();
           /*
           mail($para,$assunto,$corpo,$cabecalho);*/

           // Define os dados do servidor e tipo de conexão

           $mail->SMTPDebug = 2;
           $mail->IsSMTP();// Define que a mensagem será enviada por SMTP
           $mail->Host ="smtp.gmail.com";//Endereço do servidor SMTP
           $mail->Port  = 587;
           $mail->SMTPAuth = true;
           $mail->SMTPSecure =' tls';
           $mail->Username= "health.pet.projeto@gmail.com";// Usuário do  servidor SMTP
           $mail->Password ="projeto123";

           // Define o remetente
           $mail->From = 'support@healthpet.com';
           $mail->FromName = 'Health Pet Support';

           // Define Destinatários
           $mail->AddAddress($para,$nome);
           // Define dados técnicos da mensagem
           $mail->IsHTML(true);

           // Define a mensagem ( Texto e Assunto)
           $mail->Subject = $assunto;
           $mail->Body = $msg;
           $mail->AltBody =$corpo;

           // Define os anexos (opcional)
           // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
           //$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo

           // Envia o e-mail
           $enviado = $mail->Send();


           // Limpa os destinatários e os anexos
           $mail->ClearAllRecipients();
           $mail->ClearAttachments();
           return true;
       }catch (\PHPMailer\PHPMailer\Exception $e){
           echo 'Mensagem não pode ser enviada';
           echo 'Mailer Error: '.$mail->ErrorInfo;
           return false;
       }


    }

} 