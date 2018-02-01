<?php

namespace App\Exception;

class InvalidTemperatureUnitException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Typ temperatury nie jest wspierany!');
    }
}
