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
     * @param string $handler
     * @param string $command
     * @param string $name
     * @param $value
     * @throws ConfigException
     */
    public function validate(string &$handler, string &$command, string &$name, &$value)
    {
        $handler = $this->validateHandler($handler);
        $command = $this->validateCommand($command);
        $name    = $this->validateName($name);
        $value   = $this->validateValue($value);
    }

    /**
     * Validate handler
     * @param string $handler
     * @return string
     * @throws ConfigException
     */
    private function validateHandler(string $handler): string
    {

        $handler = ucfirst($handler);
        $class = 'Yknnv\\ConfigMigrator\Handlers\\'.$handler;

        if(!$isExistClass = class_exists($class))
            throw new ConfigException("Handler $handler not found in available Handlers \n");

        return $handler;

    }

    /**
     * Validate command
     * @param string $command
     * @return string
     * @throws ConfigException
     */
    private function validateCommand(string $command): string
    {
        if(!in_array(strtolower($command), $this->availableCommands))
            throw new ConfigException("Command $command not found in available commands \n");

        return trim($command);
    }

    /**
     * Validate name
     * @param string $name
     * @return string
     * @throws ConfigException
     */
    private function validateName(string $name): string
    {
        if(!(is_string($name) && strlen($name) > 0))
            throw new ConfigException("Name $name is not correct \n");

        return trim($name);
    }

    /**
     * Validate value
     * @param $value
     * @throws ConfigException
     */
    private function validateValue($value)
    {
        if(is_null($value))
            throw new ConfigException("Value $value not correct \n");

        return $value;
    }
}