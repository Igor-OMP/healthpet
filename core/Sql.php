<?php

/**
 * Created by PhpStorm.
 * User: GORILLA
 * Date: 28/11/2016
 * Time: 16:46
 */
class Sql extends Connect
{
    private $query;
    private $qtd;
    private $data;
    private $connecxao;
    private $error;
    private $msg_error;
    private $set = 0;
    private $binds = array();
    private $transition;

    public function __construct($conn= null)
    {
       if($conn==null){
           $conn=new Connect();
           $this->connecxao=$conn->getConnect();
       }else{
           if($conn instanceof PDO){
               $this->connecxao = $conn;
           }
       }
    }

    /**
     * Seta o slq a ser preparado
     * @param type $query
     */
    public function setQuery($query) {
        $this->query = $query;
    }

    public function getTransition(){
        return $this->transition;
    }

    public function getQuery() {
        return $this->query;
    }

    /** Retorna o array de registros retornados pelo query executado */
    public function getData() {
        return $this->data;
    }

    /** Retorna a quantidade de registros encontradas pelo query executado */
    public function getQtd() {
        if (isset($this->data)) {
            $this->qtd = $this->data->rowCount();
            return $this->qtd;
        } else {
            return '0';
        }
    }

    /** Seta a mensagem de erro retornada pelo banco */
    public function setMsgError($error) {
        $this->msg_error = $error;
    }

    /** Retorna a mensagem de erro enviada pelo banco */
    public function getMsgError() {
        return $this->msg_error;
    }

    public function clean() {
        unset($this->binds);
    }
    public function clearFull(){
        $this->query = null;
        $this->qtd= null;
        $this->data= null;
        $this->error = null;
        $this->msg_error=null;
        $this->set= 0;
        $this->binds= array();
    }
    public function resetBinds() {
        $this->set = 0;
        $this->binds = array();
    }

    /** Seta as bins a serem passadas para a execução do query */
    public function setBinds($bind) {
        if(!is_array($bind)){
            throw new Exception('Parâmetro passado não é um array.');
        }
        foreach($bind as $value){
            $this->setBind($value);
        }
        return true;
    }
    public function setBind($bind) {
        $this->binds[$this->getCount()] = $bind;
        $this->set ++;
    }

    public function getCount() {
        return $this->set;
    }

    public function getBinds() {
        return $this->binds;
    }

    public function getConnect(){
        return Connect::getConnect();
    }

    /** Executa o query com as binds setadas */
    public function execute() {
       // $this->connecxao = parent::getConnect();
        $stmt = $this->connecxao->prepare($this->getQuery());
        $this->transition = $stmt->execute($this->getBinds());
        $this->error = $stmt->errorInfo();

        if ($this->error[0] == "00000") {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $this->data = $stmt;
        } else {
            $this->setMsgError("Code Aplic Error: " . $this->error[0] . "<br />Code BD Error: " . $this->error[1] . "<br />Msg BD Error: " . $this->error[2]);
        }
    }


}