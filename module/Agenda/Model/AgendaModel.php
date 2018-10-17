<?php

/**
 * Created by PhpStorm.
 * User: GORILLA
 * Date: 12/11/2017
 * Time: 16:03
 */
class AgendaModel extends Model
{

    protected $table='agenda';

    public function All(){
        return $this->buscarAllModel($this->table);
    }
    public function salvar($data){

        if(array_key_exists('id_agenda',$data)){
            $id['id_agenda'] = $data['id_agenda'];
            return $this->update($data,$id);
        }else{
            return $this->inserir($data);
        }
    }

    public function excluir($post)
    {
        return parent::excluirModel($this->table, $post); // TODO: Change the autogenerated stub
    }

    private function inserir($data){
        return parent::gravarModel($this->table,$data);
    }

    private function update($data,$id){

        return parent::alterarModel($this->table,$data,$id);
    }
    public function filtrar($post)
    {
        return parent::filtrar($this->table, $post); // TODO: Change the autogenerated stub
    }
    public function where($post, $return = null,$option=null)
    {
        $result = parent::where($this->table, $post, $return,$option); // TODO: Change the autogenerated stub
        return $result;
    }

    public function getById($id){

        return parent::buscarModel($this->table,$id);
    }
}