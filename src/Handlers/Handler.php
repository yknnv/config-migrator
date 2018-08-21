<?php

namespace Yknnv\ConfigMigrator\Handlers;


use Yknnv\ConfigMigrator\Tools\File;

abstract class Handler
{
    protected $file;
    protected $command;
    protected $name;
    protected $value;
    protected $handler;

    /**
     * Handler constructor.
     * @param $command
     * @param $name
     * @param $value
     * @throws \ReflectionException
     */
    public function __construct(string $command, string $name, $value)
    {
        $this->command = $command;
        $this->name = $name;
        $this->value = $value;
        $this->file = new File();
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
        $this->file->{"$this->command"}($this->handler, $name, $value);
    }

    /**
     * Update data to config
     * @param $name
     * @param $value
     */
    protected function update($name, $value){
        $this->file->{"$this->command"}($this->handler, $name, $value);
    }

    /**
     * Delete data from config
     * @param $name
     */
    protected function delete($name){
        $this->file->{"$this->command"}([$this->handler, $name]);
    }
}