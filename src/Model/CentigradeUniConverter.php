<?php
namespace App\Model;

class CentigradeUniConverter extends AbstractUniConverter
{
    public function convertToKelvin(): float
    {
        return $this->temperature->getTemperatureValue() + 273.15;
    }

    public function convertToFahrenheit(): float
    {
        return 9/5 * $this->temperature->getTemperatureValue() + 32;
    }

    public function convertToCentigrade(): float
    {
        return $this->temperature->getTemperatureValue();
    }
}
