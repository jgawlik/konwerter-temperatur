<?php

namespace App\Service;

use App\Model\UnitConverterFactory;
use App\TemperatureModel\TemperatureInterface;

class UnitConverterService
{
    public function convertTemperature(TemperatureInterface $temperature): float
    {
        $unitConverter = (new UnitConverterFactory())->getUnitConverter($temperature);

        return $unitConverter->convertBasedOnDestinationTemperatureUnit();
    }
}
