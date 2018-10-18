<?php

/**
 * Created by PhpStorm.
 * User: GORILLA
 * Date: 19/10/2017
 * Time: 18:50
 */
class FormBuilder extends \PFBC\Form
{
    /**
     * @var array
     */
    protected $elements=[];
    /**
     * @var string
     */
    protected $sufix='nm_';

    /**
     * FormBuilder constructor.
     * @param string $id
     */
    public function __construct($id,$action = null)
    {
        parent::__construct($id,$action);

    }

    public function get($element,$option=FALSE){

        if($option){
           return $this->elements[$element];
        }else{
            $element = $this->elements[$element]->render();
        }
        return $element;
    }

    /**
     * @param $label
     * @param null $name
     * @param array $properties
     * @return mixed
     */
    public function text($label, $name=null, $properties=[]){
        $element = new \PFBC\Element\Textbox($label,$name,$properties);

       if($name == null)
           $name = $this->sufix.count($this->elements);

       $this->elements[$name] = $element;
       return $this->elements[$name];
    }


    /**
     * @param $label
     * @param null $name
     * @param array $properties
     * @return mixed
     */
    public function hidden($name=null,$value =null,$properties=[]){

        $element = new \PFBC\Element\Hidden($name,$value,$properties);
        if($name == null)
            $name = $this->sufix.count($this->elements);

        $this->elements[$name] = $element;
        return $this->elements[$name];
    }


    /**
     * @param $label
     * @param null $name
     * @param array $properties
     * @return mixed
     */
    public function email($label, $name=null, $properties=[]){
        $element = new \PFBC\Element\Email($label,$name,$properties);
        if($name == null)
            $name = $this->sufix.count($this->elements);

        $this->elements[$name] = $element;
        return $this->elements[$name];
    }

    /**
     * @param $label
     * @param null $name
     * @param array $properties
     * @return mixed
     */
    public function date($label, $name=null, $properties=[]){
        $element = new \PFBC\Element\Date($label,$name,$properties);
        if($name == null)
            $name = $this->sufix.count($this->elements);

        $this->elements[$name] = $element;
        return $this->elements[$name];
    }

    /**
     * @param $label
     * @param null $name
     * @param array $properties
     * @return mixed
     */
    public function datetime($label, $name=null, $properties=[]){
        $element = new \PFBC\Element\DateTime($label,$name,$properties);
        if($name == null)
            $name = $this->sufix.count($this->elements);

        $this->elements[$name] = $element;
        return $this->elements[$name];
    }

    /**
     * @param $label
     * @param null $name
     * @param array $properties
     * @return mixed
     */
    public function password($label, $name=null, $properties=[]){
        $element = new \PFBC\Element\Password($label,$name,$properties);
        if($name == null)
            $name = $this->sufix.count($this->elements);

        $this->elements[$name] = $element;
        return $this->elements[$name];
    }
    public function telefone($label, $name=null, $properties=[]){
        $element = new \PFBC\Element\Phone($label,$name,$properties);
        if($name == null)
            $name = $this->sufix.count($this->elements);

        $this->elements[$name] = $element;
        return $this->elements[$name];
    }

    /**
     * @param null $name
     * @param null $service
     * @param string $method
     * @param array $options
     * @return mixed
     */
    public function checkbox($label, $name=null, $service = null, $method ='All',$column =null, $properties =[]){

        $option = [];

        if($service != null){
            $model = fabric($service);
            $data = $model->$method();
            #xd($data);
            if($column == null) {
                echo 'COLUNA PARA  OPÇÕES NÃO FOI DEFINIDA';
                die;
            }

            if($data){
                if(isset($data[0])){
                    foreach($data as $value ){

                        $option[$value[$column['value']]] = ucwords($value[$column['option']]);
                        #xd($option);
                    }
                }else{
                    $option[$data[$column['value']]] = ucwords($data[$column['option']]);
                }
            }
        }

        $element = new \PFBC\Element\Checkbox("",$name,$option,$properties);
        if($name == null)
            $name = $this->sufix.count($this->elements);

        $this->elements[$name] = $element;
        return $this->elements[$name];
    }

    /**
     * @param $label
     * @param null $name
     * @param null $service
     * @param string $method
     * @param array $options
     * @return mixed
     */
    public function select($label, $name=null, $service = null, $method ='All',$column =null, $options=[],$properties =[]){

        $option = [];
        if(!empty($options)){
            $option = array_merge($option,$options);
        }
        if($service != null){
            $model = fabric($service);
            $data = $model->$method();
            #xd($data);
             if($column == null) {
                 echo 'COLUNA PARA  OPÇÕES NÃO FOI DEFINIDA';
                 die;
             }

                if($data){
                    if(isset($data[0])){
                        foreach($data as $value ){

                            $option[$value[$column['value']]] = ucwords($value[$column['option']]);
                            #xd($option);
                        }
                    }else{
                        $option[$data[$column['value']]] = ucwords($data[$column['option']]);
                    }
                }
        }


        #xd($option);
        $element = new \PFBC\Element\Select($label,$name,$option,$properties);
        if($name == null)
            $name = $this->sufix.count($this->elements);

        $this->elements[$name] = $element;
        return $this->elements[$name];
    }

    /**
     * @param $label
     * @param null $name
     * @param null $service
     * @param string $method
     * @param array $options
     * @return mixed
     */
    public function radio($label, $name=null, $service = null, $method ='All',$column=[], $options=[],$properties=[]){

        $option = [];
        if(!empty($options)){
            $option = array_merge($option,$options);
        }
        if($service != null){
            $model = fabric($service);
            $data = $model->$method();
            #xd($data);
            if($column == null) {
                echo 'COLUNA PARA  OPÇÕES NÃO FOI DEFINIDA';
                die;
            }

            if($data){
                if(isset($data[0])){
                    foreach($data as $value ){

                        $option[$value[$column['value']]] = ucwords($value[$column['option']]);
                        #xd($option);
                    }
                }else{
                    $option[$data[$column['value']]] = ucwords($data[$column['option']]);
                }
            }
        }

        $element = new \PFBC\Element\Radio($label,$name,$option,$properties);
        if($name == null)
            $name = $this->sufix.count($this->elements);

        $this->elements[$name] = $element;
        return $this->elements[$name];
    }

    /**
     * @param $label
     * @param null $name
     * @param null $service
     * @param string $method
     * @return mixed
     */
    public function textArea($label, $name=null, $service = null, $method ='All'){

        $option = [];
        $element = new \PFBC\Element\Textarea($label,$name,$option);
        if($name == null)
            $name = $this->sufix.count($this->elements);

        $this->elements[$name] = $element;
        return $this->elements[$name];
    }

    /**
     * @param $label
     * @param null $name
     * @param array $properties
     * @return mixed
     */
    public function button($label, $name=null, $properties=[]){
        $element = new \PFBC\Element\Button($label,$name,$properties);
        if($name == null)
            $name = $this->sufix.count($this->elements);

        $this->elements[$name] = $element;
        return $this->elements[$name];
    }

    public function file($label,$name,$properties=[]){
        $element = new \PFBC\Element\File($label,$name,$properties);

        if($name == null)
            $name = $this->sufix.count($this->elements);

        $this->elements[$name] = $element;
        return $this->elements[$name];
    }

    public function html($code,$name = null){
        $element = new \PFBC\Element\HTML($code);

        if($name == null)
            $name = $this->sufix.count($this->elements);

        $this->elements[$name] = $element;
        return $this->elements[$name];
    }

    public function buttonsEnviarHome($link_enviar = null,$link_home=null,$name=null){

        if($link_enviar == null)
            $link_enviar = BASE_URL.'admin';

        if($link_home == null)
            $link_home = BASE_URL.'admin';

        $code = '<div class="form-group">';
        $code .= '<button type="submit" class="btn btn-primary" style="display: block;float: left;color:#fff;">Enviar</button>';
        $code .=  '<a href="'.$link_home.'"  class="btn btn-default"  style="display:block;float:right;">Home</a>';
        $code .=  '</div>';


        $element = new \PFBC\Element\HTML($code);

        if($name == null)
            $name = $this->sufix.count($this->elements);

        $this->elements[$name] = $element;
        return $this->elements[$name];
    }

    /**
     * @return bool
     */
    public function validate(){
       return \PFBC\Form::isValid($this->getAttribute('id'));
    }

    public function createForm(){

        foreach($this->elements as $element){
            $this->addElement($element);
        }
    }
}