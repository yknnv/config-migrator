<?php

namespace ConfigMigrator\Handlers;


abstract class Handler
{
    protected $file;
    protected $command;
    protected $name;
    protected $value;
    protected $handler;

    public function __construct($command, $name, $value)
    {
        $this->command = $command;
        $this->name = $name;
        $this->value = $value;
        $this->file = new \ConfigMigrator\Tools\File();
        $this->handler = (new \ReflectionClass($this))->getShortName();
    }

    /**
     * Run main action
     */
    public function exec(){
        $this->{"$this->command"}($this->name, $this->value);
    }

    /**
     * Add data to config
     * @param $name
     * @param $value
     */
    protected function add($name, $value){
        $this->file->{"$this->command"}(['handler' => $this->handler, 'name' => $name, 'value' => $value]);
    }

    /**
     * Update data to config
     * @param $name
     * @param $value
     */
    protected function update($name, $value){
        $this->file->{"$this->command"}(['handler' => $this->handler, 'name' => $name, 'value' => $value]);
    }

    /**
     * Delete data from config
     * @param $name
     */
    protected function delete($name){
        $this->file->{"$this->command"}(['handler' => $this->handler, 'name' => $name]);
    }
}