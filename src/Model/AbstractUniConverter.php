<?php

namespace App\Model;

use App\Exception\InvalidTemperatureUnitException;
use App\TemperatureModel\TemperatureInterface;

abstract class AbstractUniConverter implements UnitConverterInterface
{
    protected $temperature;

    public function __construct(TemperatureInterface $temperature)
    {
        $this->temperature = $temperature;
    }

    public function convertBasedOnDestinationTemperatureUnit(): float
    {
        switch ($this->temperature->getDestinationTemperatureUnit()) {
            case TemperatureInterface::CENTIGRADE_UNIT:
                return $this->convertToCentigrade();
            case TemperatureInterface::FAHRENHEIT_UNIT:
                return $this->convertToFahrenheit();
            case TemperatureInterface::KELVIN_UNIT:
                return $this->convertToKelvin();
        }
        throw new InvalidTemperatureUnitException();
    }
}
