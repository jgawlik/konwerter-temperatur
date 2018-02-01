<?php

namespace App\Model;

class FahrenheitUnitConverter extends AbstractUniConverter
{
    public function convertToKelvin(): float
    {
        return ($this->temperature->getTemperatureValue() + 459.67) * 5 / 9;
    }

    public function convertToFahrenheit(): float
    {
        return $this->temperature->getTemperatureValue();
    }

    public function convertToCentigrade(): float
    {
        return 5 / 9 * ($this->temperature->getTemperatureValue() - 32);
    }
}
