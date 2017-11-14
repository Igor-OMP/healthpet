<?php

class Paginator
{

    protected $prev;
    protected $next;
    protected $current;
    protected $pages;
    protected $limit;
    protected $pg;
    protected $data;
    protected $table;

    public function __construct($table = null)
    {
        $this->table = $table;
    }


    public function getPagination( Array $mixed){

        try{

            $this->table = $mixed['table'];
            $this->setLimit($mixed['limite']);
            $this->setPages($this->table);
            $this->setPg($mixed['pagina']);

            $arr =$this->getData();


            if(!$arr){
                throw new Exception('Não existe registros nessa tabela');
            }

            return $arr;

        }catch (Exception $e){
            echo ' Erro ao bucar paginacao. '.$e->getMessage();
        }
        return null;
    }

    /**
     * @return mixed
     */
    public function getPrev()
    {
        return $this->prev;
    }

    /**
     * @param mixed $prev
     */
    public function setPrev($prev = null)
    {
        if(!$prev){
            $prev = 1;
        }
        $this->prev = $prev;
    }

    /**
     * @return mixed
     */
    public function getNext()
    {
        return $this->next;
    }

    /**
     * @param mixed $next
     */
    public function setNext($next)
    {
        $this->next = $next;
    }

    /**
     * @return mixed
     */
    public function getCurrent()
    {
        return $this->current;
    }

    /**
     * @param mixed $current
     */
    public function setCurrent($current)
    {
        $this->current = $current;
    }

    /**
     * @return mixed
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @param mixed $pages
     */
    public function setPages($table)
    {
        $pdo = new Sql();
        $pdo->setQuery('SELECT COUNT(*)  as  paginas FROM '.$table.' ;');
        $pdo->execute();


        if($pdo->getQtd() > 0){
            $dados =(int)$pdo->getData()->fetch();
            $pag= null;
            if(empty($this->getLimit())){
                $pag = 1 ;
            }
            else{
                $pag = $this->getLimit();
            }
            $this->pages = $dados['paginas']/$pag;
        }


        return $this;

    }

    /**
     * @return mixed
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param mixed $limit
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    /**
     * @return mixed
     */
    public function getPg()
    {
        return $this->pg;
    }

    /**
     * @param mixed $index
     */
    public function setPg($index = null)
    {
        if(!$index){
            $index = 1;
        }

        $this->setPrev($this->getPg());
       $this->pg= ($index - 1) * $this->getLimit();
        $this->setNext(($index) * $this->getLimit());
    }

    /**
     * @return mixed
     */
    public function getData()
    {
       $pdo = new Sql();
        $pdo->setQuery('SELECT * FROM '.$this->table.' LIMIT ' .$this->getPg().','.$this->getLimit().' ;');
        $pdo->execute();

        if($pdo->getQtd() > 0 ){
            $dados = $pdo->getData()->fetchAll();

            return $dados;
        }

        return null;
    }




}