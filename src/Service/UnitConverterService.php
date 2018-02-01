<?php

namespace App\Service;

use App\Form\Model\Temperature;
use App\Model\UnitConverterFactory;

class UnitConverterService
{
    public function convertTemperature(Temperature $temperature): float
    {
        $unitConverter = (new UnitConverterFactory())->getUnitConverter($temperature);

        return $unitConverter->convertBasedOnDestinationTemperatureUnit();
    }
}
