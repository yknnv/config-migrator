<?php

if(PHP_SAPI != 'cli')
    return false;

include_once('include.php');

$handler = $argv[1];
$command = $argv[2];
$name = $argv[3];
$value = $argv[4];

$validator = new ConfigMigrator\Tools\Validator();
if($validator->validate($handler, $command, $name, $value)){
    $handlerClass = 'ConfigMigrator\\Handlers\\'.$handler;
    $handlerObj = new $handlerClass($command, $name, $value);
    $handlerObj->exec();
}