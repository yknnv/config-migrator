<?php

namespace Yknnv\ConfigMigrator\Tools;


use Yknnv\ConfigMigrator\Exception\ConfigException;

class File
{
    protected $fileName = 'config-migrate.json';

    protected $fileHandler;

    protected $fileData;


    /**
     * File constructor.
     * @throws ConfigException
     */
    public function __construct()
    {
        $this->fileHandler = fopen($this->fileName, 'c+');
        if(!$this->fileHandler)
            throw new ConfigException("Cannot read or create config file \n");

        $this->fileData = fread($this->fileHandler, filesize($this->fileName) ? filesize($this->fileName) :  1);
        if(!$this->fileData)
            $this->fileData = '';
        $this->fileData = json_decode($this->fileData, true);
    }

    public function add($handler, $name, $value){
        $this->fileData[$handler][$name] = $value;
    }

    public function delete($handler, $name){
        unset($this->fileData[$handler][$name]);
    }

    public function update($handler, $name, $value){
        $this->fileData[$handler] = [$name => $value];
    }

    public function __destruct()
    {
        $this->fileHandler = fopen($this->fileName, 'w');
        fwrite($this->fileHandler, json_encode($this->fileData, JSON_FORCE_OBJECT));
        fclose($this->fileHandler);
    }
}