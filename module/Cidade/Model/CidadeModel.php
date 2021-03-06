<?php

class CidadeModel extends Model
{
    protected $table = 'cidade';

    public function All(){
        return parent::buscarAllModel($this->table);
    }

    public function getById($id){
        return parent::buscarModel($this->table,$id);
    }
    public function filtrar($post)
    {
        return parent::filtrar($this->table, $post); // TODO: Change the autogenerated stub
    }

    public function exclui($post)
    {
        return parent::excluirModel($this->table, $post); // TODO: Change the autogenerated stub
    }

    public function salvar($data){

        if(array_key_exists('id_cidade',$data)){
            $id['id_cidade'] = $data['id_cidade'];

            return $this->update($data,$id);
        }else{
            return $this->inserir($data);
        }
    }
    public function getCidades(){
        return parent::buscarColumsModel($this->table,['nm_cidade'=>'nm_cidade','id_cidade'=>'id_cidade']);
    }

    public function getNomeCidadeById($id){
        $result = parent::buscarModel($this->table,$id);
        return $result['nm_cidade'];
    }
    private function inserir($data){
        return parent::gravarModel($this->table,$data);
    }

    private function update($data,$id){

        return parent::alterarModel($this->table,$data,$id);
    }
}