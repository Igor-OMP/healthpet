<?php

/**
 * Created by PhpStorm.
 * User: IGOR
 * Date: 19/09/2016
 * Time: 16:27
 */
abstract class Model
{
    protected function gravarModel($table, $post)
    {
        try {
            $columns = implode(',', array_keys($post));
            $count = count($post);
            for ($i = 0; $i < $count; $i++) {
                $values[] = '?';
            }

            $values = implode(',', $values);
            $pdo = new Sql();

            $sql = 'INSERT INTO ' . $table . ' (' . $columns . ') VALUES (' . $values . ');';
            $pdo->setQuery($sql);
            $pdo->setBinds($post);
            $pdo->execute();

            if ($pdo->getQtd() > 0) {
                $objPdo = $pdo->getConnect();
                $dados = $objPdo->lastInsertId();
            } else {
                $dados=[
                    'error'=>true,
                    'error_message'=>$pdo->getMsgError(),
                ];
            }

            return $dados;
        } catch (Exception $e) {
            echo ' Erro ao gravar dados no banco de dados. ' . $e->getMessage();
        }
        return null;
    }

    protected function excluirModel($table, $post)
    {
        try {
            $column = implode('', array_keys($post));
            #xd($post);
            $pdo = new Sql();
            $pdo->setQuery('DELETE FROM ' . $table . ' WHERE ' . $column . ' = ? ;');
            $pdo->setBinds($post);
            $pdo->execute();

           if( $pdo->getTransition()){
                return $pdo->getTransition();
            }else{
               $error=[
                   'error'=>true,
                   'error_message'=>$pdo->getMsgError(),
               ];

               return $error;
           }

        } catch (Exception $e) {
            echo ' Erro ao gravar dados no banco de dados. ' . $e->getMessage();

        }
        return null;
    }

    protected function alterarModel($table, $post, $id)
    {
        try {
            array_shift($post);
            $column = array_keys($post);

            $column_id = implode('', array_keys($id));
            $id = $id[$column_id];
            $count = count($post);
            foreach ($column as $value) {
                $sets[] = $value . '= ?';
            }

            $sets = implode(',', $sets);
            $pdo = new Sql();
            $pdo->setQuery('UPDATE ' . $table . ' SET ' . $sets . ' WHERE ' . $column_id . ' = ?;');

            $pdo->setBinds($post);
            $pdo->setBind($id);
            $pdo->execute();

            if( $pdo->getTransition()){
                return $pdo->getTransition();
            }else{
                $error=[
                    'error'=>true,
                    'error_message'=>$pdo->getMsgError(),
                ];

                return $error;
            }
        } catch (Exception $e) {
            echo ' Erro ao gravar dados no banco de dados. ' . $e->getMessage();
        }
    }

    protected function buscarModel($table, $post)
    {
        try {
            $column = implode('', array_keys($post));
            #xd($post);
            $pdo = new Sql();
            $pdo->setQuery('SELECT * FROM ' . $table . ' WHERE ' . $column . ' = ? ;');
            $pdo->setBinds($post);
            $pdo->execute();

            if ($pdo->getQtd() > 0) {
                if ($pdo->getQtd() > 1) {
                    $dados = $pdo->getData()->fetchAll();
                } else {
                    $dados = $pdo->getData()->fetch();
                }
                return $dados;
            }
            return null;
        } catch (Exception $e) {
            echo ' Erro ao gravar dados no banco de dados. ' . $e->getMessage();
        }
        return null;
    }

    protected function buscarColumsModel($table, $post, $option = null)
    {
        try {

            if(count($post) > 1){
                $column = implode(',',array_keys($post));
            }else{
                $column = implode('', array_keys($post));
            }

            if ($option == null) {
                $option = '';
            }
            #xd($option);
            $pdo = new Sql();
            $pdo->setQuery('SELECT ' . $option . ' ' . $column . ' FROM ' . $table . ' ;');
            #xd($pdo->getQuery());
            $pdo->execute();

            if ($pdo->getQtd() > 0) {
                if ($pdo->getQtd() > 1) {
                    $dados = $pdo->getData()->fetchAll();
                } else {
                    $dados = $pdo->getData()->fetch();
                }
                return $dados;
            }
            return null;
        } catch (Exception $e) {
            echo ' Erro ao gravar dados no banco de dados. ' . $e->getMessage();
        }
        return null;
    }

    protected function buscarTermModel($table, $post, $return = null,$like="?%")
    {
        try {
            $column = implode('', array_keys($post));

            if ($return == null) {
                $return = '*';
            }
            if (is_array($return)) {
                $return = implode(',', $return);
            }

            $pdo = new Sql();
            $pdo->setQuery('SELECT ' . $return . ' FROM ' . $table . ' WHERE ' . $column . ' LIKE '.$like.' ;');
            $pdo->setBinds($post);
            $pdo->execute();

            if ($pdo->getQtd() > 0) {
                $dados = $pdo->getData()->fetch();
                #xd($dados);
                return $dados;
            }
            return null;
        } catch (Exception $e) {
            echo ' Erro ao gravar dados no banco de dados. ' . $e->getMessage();
        }
        return null;
    }

    protected function where($table, $post, $return=null,$option=null)
    {
        try {
            $column = implode('', array_keys($post));
            $dados = null;
            if ($return == null) {
                $return = '*';
            }
            if (is_array($return)) {
                $return = implode(',', $return);
            }

            $pdo = new Sql();
            $pdo->setQuery('SELECT ' . $return . ' FROM ' . $table . ' WHERE ' . $column . ' = ?'. $option . ';');
           # xd($pdo->getQuery());
            $pdo->setBinds($post);
            $pdo->execute();
            if ($pdo->getQtd() > 0 && $pdo->getQtd() < 2) {
                $dados = $pdo->getData()->fetch();
                #xd($dados);

            }else{
                $dados = $pdo->getData()->fetchAll();
            }
            return $dados;
        } catch (Exception $e) {
            echo ' Erro ao gravar dados no banco de dados. ' . $e->getMessage();
        }
        return null;
    }

    protected function filtrar($table ,$post){
        try{
            $column = implode('',array_keys($post));

            $pdo= new Sql();
            $pdo->setQuery('SELECT COUNT('.$column.') FROM '.$table.' WHERE '.$column.' = ? ;');
            $pdo->setBinds($post);
            $pdo->execute();

            if($pdo->getQtd() > 0){
                $dados = $pdo->getData()->fetch();
                $dados = $dados['COUNT('.$column.')'];
                #xd($dados);
                return $dados;
            }
            return $pdo->getMsgError();
        }catch (Exception $e){
            echo ' Erro ao gravar dados no banco de dados. '.$e->getMessage();
        }
        return null;
    }


    protected function buscarAllModel($table)
    {
        try {
            $pdo = new Sql();
            $pdo->setQuery('SELECT * FROM ' . $table . ';');
            $pdo->execute();

            if ($pdo->getQtd() > 0) {
                $dados = $pdo->getData()->fetchAll();
                return $dados;

            }
            return $pdo->getMsgError();
        } catch (Exception $e) {
            echo ' Erro ao gravar dados no banco de dados. ' . $e->getMessage();
        }
        return null;
    }

    protected  function Query($sql){
        try {
            if(empty($sql)){
                throw new InvalidArgumentException("valor passado está vazio.");
            }
            $pdo = new Sql();
            $pdo->setQuery($sql);
            $pdo->execute();

            if ($pdo->getQtd() > 0) {
                $dados = $pdo->getData()->fetchAll();
                return $dados;
            }
            return $pdo->getMsgError();
        } catch (Exception $e) {
            echo ' Erro ao gravar dados no banco de dados. ' . $e->getMessage();
        }
        return null;
    }

} 