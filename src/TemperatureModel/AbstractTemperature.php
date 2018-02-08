<?php

namespace App\TemperatureModel;

class AbstractTemperature implements TemperatureInterface
{
    protected $temperatureValue;
    protected $initialTemperatureUnit;
    protected $destinationTemperatureUnit;


    public function getTemperatureValue(): ?float
    {
        return $this->temperatureValue;
    }

    public function getInitialTemperatureUnit(): ?string
    {
        return $this->initialTemperatureUnit;
    }


    public function getDestinationTemperatureUnit(): ?string
    {
        return $this->destinationTemperatureUnit;
    }
}
