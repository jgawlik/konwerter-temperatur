<?php

namespace App\Tests\Helper;

use App\Exception\InvalidTemperatureUnitException;
use App\Exception\TemperatureBelowZeroException;
use App\TemperatureModel\Temperature;
use App\TemperatureModel\TemperatureInterface;
use PHPUnit\Framework\TestCase;

class TemperatureTest extends TestCase
{
    /**
     * @test
     * @dataProvider dataForTemperatureBelowZeroException
     */
    public function itThrowsTemperatureBelowZeroException(
        string $initialTemperatureUnit,
        string $destinationTemperatureUnit,
        float $temperatureValue,
        string $exceptionClass,
        string $message
    ) {
        $this->expectException($exceptionClass);
        $this->expectExceptionMessage($message);
        new Temperature($initialTemperatureUnit, $destinationTemperatureUnit, $temperatureValue);
    }

    public function dataForTemperatureBelowZeroException()
    {
        return [
            [
                TemperatureInterface::CENTIGRADE_UNIT,
                TemperatureInterface::KELVIN_UNIT,
                -300,
                TemperatureBelowZeroException::class,
                'Temperatura wyjściowa w kelwinach będzie mniejsza od 0!'
            ],
            [
                TemperatureInterface::KELVIN_UNIT,
                TemperatureInterface::CENTIGRADE_UNIT,
                -20,
                TemperatureBelowZeroException::class,
                'Temperatury w kelwinach zaczynają się od 0!'
            ],
            [
                TemperatureInterface::KELVIN_UNIT,
                TemperatureInterface::KELVIN_UNIT,
                -20,
                InvalidTemperatureUnitException::class,
                'Typ wyjściowy i docelowy nie może być taki sam!'
            ],
        ];
    }
}