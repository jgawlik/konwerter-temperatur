<?php

namespace App\Model;

use App\Exception\InvalidTemperatureUnitException;
use App\Helper\Temperature;

class UnitConverterFactory
{
    const TEMPERATURE_UNIT_TYPES = [
        'Centigrade' => CentigradeUniConverter::class,
        'Fahrenheit' => FahrenheitUnitConverter::class,
        'Kelvin' => KelvinUnitConverter::class,
    ];

    public function getUnitConverter(Temperature $temperature): UnitConverterInterface
    {
        if (!array_key_exists($temperature->getInitType(), self::TEMPERATURE_UNIT_TYPES)) {
            throw new InvalidTemperatureUnitException();
        }
        $unitConverterClass = self::TEMPERATURE_UNIT_TYPES[$temperature->getInitType()];


        return new $unitConverterClass($temperature);
    }
}
