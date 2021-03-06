<?php

namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;

class InvalidTemperatureUnitException extends \Exception
{
    public function __construct(string $message = 'Typ temperatury nie jest wspierany!')
    {
        parent::__construct($message, Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
