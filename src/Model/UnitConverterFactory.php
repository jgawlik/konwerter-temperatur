<?php

namespace App\Model;

use App\Exception\InvalidTemperatureUnitException;
use App\TemperatureModel\TemperatureInterface;

class UnitConverterFactory
{
    const TEMPERATURE_UNIT_TYPES = [
        'Centigrade' => CentigradeUniConverter::class,
        'Fahrenheit' => FahrenheitUnitConverter::class,
        'Kelvin' => KelvinUnitConverter::class,
    ];

    public function getUnitConverter(TemperatureInterface $temperature): UnitConverterInterface
    {
        if (!array_key_exists($temperature->getInitialTemperatureUnit(), self::TEMPERATURE_UNIT_TYPES)) {
            throw new InvalidTemperatureUnitException();
        }
        $unitConverterClass = self::TEMPERATURE_UNIT_TYPES[$temperature->getInitialTemperatureUnit()];


        return new $unitConverterClass($temperature);
    }
}
