<?php

namespace App\Model;

interface UnitConverterInterface
{
    public function convertBasedOnDestinationTemperatureUnit(): float;

    public function convertToKelvin(): float;

    public function convertToFahrenheit(): float;

    public function convertToCentigrade(): float;
}
