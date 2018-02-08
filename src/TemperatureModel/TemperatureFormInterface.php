<?php

namespace App\TemperatureModel;


interface TemperatureFormInterface extends TemperatureInterface
{
    public function setTemperatureValue(?float $temperatureValue): TemperatureFormInterface;

    public function setDestinationTemperatureUnit(?string $destinationTemperatureUnit): TemperatureFormInterface;

    public function setInitialTemperatureUnit(?string $initialTemperatureUnit): TemperatureFormInterface;
}
