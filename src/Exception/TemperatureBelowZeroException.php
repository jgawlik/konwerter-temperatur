<?php

namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;

class TemperatureBelowZeroException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message, Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
