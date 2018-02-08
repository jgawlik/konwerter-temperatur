<?php

namespace App\TemperatureModel;


interface TemperatureFormInterface extends TemperatureInterface
{
    public function setTemperatureValue(?float $temperatureValue): TemperatureInterface;

    public function setDestinationTemperatureUnit(?string $destinationTemperatureUnit): TemperatureInterface;

    public function setInitialTemperatureUnit(?string $initialTemperatureUnit): TemperatureInterface;
}
