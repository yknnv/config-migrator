<?php

namespace Yknnv\ConfigMigrator\Tools;

use Yknnv\ConfigMigrator\Exception\ConfigException;

class Validator
{
    /**
     * List of available commands
     * @var array
     */
    protected $availableCommands = [
        'add',
        'update',
        'delete'
    ];

    /**
     * Execute validator
     * @param $handler
     * @param $command
     * @param $name
     * @param $value
     * @throws ConfigException
     */
    public function validate($handler, $command, $name, $value){
        $this->validateHandler($handler);
        $this->validateCommand($command);
        $this->validateName($name);
        $this->validateValue($value);
    }

    /**
     * Validate handler
     * @param $handler
     * @return bool
     * @throws ConfigException
     */
    private function validateHandler($handler){

        $lang = ucfirst($handler);
        $class = 'Yknnv\\ConfigMigrator\Handlers\\'.$handler;

        if(!$isExistClass = class_exists($class))
            throw new ConfigException("Handler $handler not found in available handlers \n");

        return true;
    }

    /**
     * Validate command
     * @param $command
     * @throws ConfigException
     */
    private function validateCommand($command){
        if(!in_array(strtolower($command), $this->availableCommands))
            throw new ConfigException("Command $command not found in available commands \n");
    }

    /**
     * Validate name
     * @param $name
     * @throws ConfigException
     */
    private function validateName($name){
        if(!(is_string($name) && strlen($name) > 0))
            throw new ConfigException("Name $name is not correct \n");
    }

    /**
     * Validate value
     * @param $value
     * @throws ConfigException
     */
    private function validateValue($value){
        if(is_null($value))
            throw new ConfigException("Value $value not correct \n");
    }
}