<?php
/**
 * Created by PhpStorm.
 * User: yury
 * Date: 20.08.18
 * Time: 20:32
 */

namespace Yknnv\ConfigMigrator\Exception;


use Throwable;

class ConfigException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}