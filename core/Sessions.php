<?php

class Sessions {

    protected $sessionID;
    private static $session_name;

    public function __construct(){
        if( !isset($_SESSION) ){
            $this->init_session();
        }
        //session_start();
        //$this->sessionID = session_id();
    }

    public function init_session(){
        echo "init";
        session_start();
    }

    public function set_session_id(){
        //$this->start_session();
        $this->sessionID = session_id();
    }

    public function get_session_id(){
        return $this->sessionID;
    }

    public function session_exist( $session_name ){
        if( isset($_SESSION[$session_name]) ){
            return true;
        }
        else{
            return false;
        }
    }

    public function create_session($session_name, $session, $is_array = false ){
        if( !isset($_SESSION[$session_name])  ){
            if( $is_array == true ){
                $_SESSION[$session_name] = $session;
            }
            else{
                $_SESSION[$session_name] = '';
            }
        }
    }

    public function insert_value( $session_name , array $data ){
        if( is_array($_SESSION[$session_name]) ){
            array_push( $_SESSION[$session_name], $data );
            x($_SESSION[$session_name]);
        }
    }

    public function display_session( $session_name ){
        echo '<pre>';print_r($_SESSION[$session_name]);echo '</pre>';
    }

    public function remove_session( $session_name = '' ){
        if( !empty($session_name) ){
            unset( $_SESSION[$session_name] );
        }
        else{
            unset($_SESSION);
            //session_unset();
            //session_destroy();
        }
    }

    /**
     * @return mixed
     */
    public static function getSessionName()
    {
        return self::$session_name;
    }

    /**
     * @param mixed $session_name
     */
    public static function setSessionName($session_name)
    {
        if(!self::$session_name){
            self::$session_name = $session_name;
        }
    }


    public function get_session_data( $session_name ){
        if(isset($_SESSION[$session_name])){
            $_SESSION[$session_name];
            return $_SESSION[$session_name];
        }
        return false;
    }

    public function set_session_data( $session_name , $data ){
        $_SESSION[$session_name] = $data;
    }

}