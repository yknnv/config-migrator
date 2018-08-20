<?php

namespace ConfigMigrator\Tools;


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
     * @return bool
     * @throws \Exception
     */
    public function validate($handler, $command, $name, $value){

        return ($this->validateHandler($handler) && $this->validateCommand($command)
            && $this->validateName($name) && $this->validateValue($value));
    }

    /**
     * Validate handler
     * @param $handler
     * @return bool
     * @throws \Exception
     */
    private function validateHandler($handler){

        $lang = ucfirst($handler);
        $class = 'ConfigMigrator\Handlers\\'.$handler;

        if(!$isExistClass = class_exists($class))
            throw new \Exception('Language '.$handler.' not found in available languages');

        return true;
    }

    /**
     * Validate command
     * @param $command
     * @return bool
     */
    private function validateCommand($command){
        return in_array(strtolower($command), $this->availableCommands);
    }

    /**
     * Validate name
     * @param $name
     * @return bool
     */
    private function validateName($name){
        return (is_string($name) && strlen($name) > 0);
    }

    /**
     * Validate value
     * @param $value
     * @return bool
     */
    private function validateValue($value){
        return !is_null($value);
    }
}