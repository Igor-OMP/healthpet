<?php

/**
 * Created by Igor Oliveira.
 * User: https://github.com/Igor-Oliveira-Mota-Pires
 * Date: 12/03/2017
 * Time: 00:02
 *
 *
 */
class Cache
{

    private static $time = 'Now';

    private $folder;

    public function __construct($folder)
    {
        $this->setFolder(!is_null($folder)? $folder :sys_get_temp_dir());
    }

    public function setFolder($folder){
        if(file_exists($folder) && is_dir($folder) && is_writable($folder)){
            $this->folder =$folder;
        }else{
            trigger_error('Não foi possível  acessar a pasta de cache. ' . $folder,E_USER_ERROR);
        }
    }

    protected  function generateFileLocation($key){
        return $this->folder .DS.sha1($key).'.tmp';
    }

    protected function createCache($key, $content){
        $filename = $this->generateFileLocation($key);

        return  file_put_contents($filename,$content) OR trigger_error('Não foi possivel criar um arquivo de cache');
    }

    public function save($key,$content,$time){
        $time = (strtotime(!is_null($time)?$time : self::$time))+3600;

        $content = json_encode([
            'time'=>$time,
            'content'=>$content
        ]);

        return $this->createCache($key,$content);
    }

    public function read($key){

        $file = $this->generateFileLocation($key);
        #xd($file);
        if(file_exists($file) && is_readable($file)){
            $cache = json_decode(file_get_contents($file));
            $time = ($cache->time) - time();
            if($time > 0 ){
                return $cache->content;
            }else{
                unlink($file);
            }
        }
        return null;
    }

    public function delete($key){

        $file = $this->generateFileLocation($key);
        #xd($file);
        if(file_exists($file) && is_readable($file)){
            unlink($file);
        }
        return null;
    }
}