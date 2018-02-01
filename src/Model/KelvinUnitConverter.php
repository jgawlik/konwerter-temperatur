<?php

namespace App\Model;

class KelvinUnitConverter extends AbstractUniConverter
{
    public function convertToKelvin(): float
    {
        return $this->temperature->getTemperatureValue();
    }

    public function convertToFahrenheit(): float
    {
        return $this->temperature->getTemperatureValue() * 9/5-459.67;
    }

    public function convertToCentigrade(): float
    {
        return $this->temperature->getTemperatureValue()  - 273.15;
    }
}
