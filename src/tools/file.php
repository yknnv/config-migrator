<?php

namespace Yknnv\ConfigMigrator\Tools;


class File
{
    protected $fileName = '/var/www/otus/config.migrator/config.json'; //TODO: add config to path

    protected $fileHandler;

    protected $fileData;


    public function __construct()
    {
        $this->fileHandler = fopen($this->fileName, 'c+');
        $this->fileData = fread($this->fileHandler, filesize($this->fileName) ? filesize($this->fileName) :  1);
        if(!$this->fileData)
            $this->fileData = '';
        $this->fileData = json_decode($this->fileData, true);
    }

    public function add($params = []){
        $this->fileData[$params['handler']][$params['name']] = $params['value'];
    }

    public function delete($params = []){
        unset($this->fileData[$params['handler']][$params['name']]);
    }

    public function update($params = []){
        $this->fileData[$params['handler']] = [$params['name'] => $params['value']];
    }

    public function __destruct()
    {
        $this->fileHandler = fopen($this->fileName, 'w');
        fwrite($this->fileHandler, json_encode($this->fileData, JSON_FORCE_OBJECT));
        fclose($this->fileHandler);
    }
}