<?php

namespace App\TemperatureModel;

interface TemperatureInterface
{
    const CENTIGRADE_UNIT = 'Centigrade';
    const KELVIN_UNIT = 'Kelvin';
    const FAHRENHEIT_UNIT = 'Fahrenheit';

    public function getTemperatureValue(): ?float;

    public function getInitialTemperatureUnit(): ?string;

    public function getDestinationTemperatureUnit(): ?string;
}
