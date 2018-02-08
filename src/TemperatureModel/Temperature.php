<?php

namespace App\TemperatureModel;

use App\Exception\InvalidTemperatureUnitException;
use App\Exception\TemperatureBelowZeroException;

class Temperature extends AbstractTemperature
{
    public function __construct(
        string $initialTemperatureUnit,
        string $destinationTemperatureUnit,
        float $temperatureValue
    ) {
        $this->validateArguments($initialTemperatureUnit, $destinationTemperatureUnit, $temperatureValue);
        $this->initialTemperatureUnit = $initialTemperatureUnit;
        $this->destinationTemperatureUnit = $destinationTemperatureUnit;
        $this->temperatureValue = $temperatureValue;
    }

    private function validateArguments(
        string $initialTemperatureUnit,
        string $destinationTemperatureUnit,
        float $temperatureValue
    ) {
        if ($destinationTemperatureUnit === $initialTemperatureUnit) {
            throw new InvalidTemperatureUnitException('Typ wyjściowy i docelowy nie może być taki sam!');
        }
        if ($destinationTemperatureUnit == self::KELVIN_UNIT
            && $initialTemperatureUnit == self::CENTIGRADE_UNIT
            && $temperatureValue < -273.15) {
            throw new TemperatureBelowZeroException('Temperatura wyjściowa w kelwinach będzie mniejsza od 0!');
        }
        if ($initialTemperatureUnit == self::KELVIN_UNIT && $temperatureValue < 0) {
            throw new TemperatureBelowZeroException('Temperatury w kelwinach zaczynają się od 0!');
        }
    }
}
