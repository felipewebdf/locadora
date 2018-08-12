<?php
namespace App\Exceptions;

class RulesException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, \Throwable $previous = null)
    {
        if (empty($code)) {
            $code = 412;
        }
        parent::__construct($message, $code, $previous);
    }
}