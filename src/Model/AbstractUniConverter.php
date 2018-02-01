<?php

namespace App\Model;

use App\Exception\InvalidTemperatureUnitException;
use App\Helper\Temperature;

abstract class AbstractUniConverter implements UnitConverterInterface
{
    protected $temperature;

    public function __construct(Temperature $temperature)
    {
        $this->temperature = $temperature;
    }

    public function convertBasedOnDestinationTemperatureUnit(): float
    {
        switch ($this->temperature->getDestType()) {
            case Temperature::CENTIGRADE_UNIT:
                return $this->convertToCentigrade();
            case Temperature::FAHRENHEIT_UNIT:
                return $this->convertToFahrenheit();
            case Temperature::KELVIN_UNIT:
                return $this->convertToKelvin();
        }
        throw new InvalidTemperatureUnitException();
    }
}
