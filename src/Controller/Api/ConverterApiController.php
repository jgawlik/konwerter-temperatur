<?php

namespace App\Controller\Api;

use App\Exception\InvalidTemperatureUnitException;
use App\Exception\TemperatureBelowZeroException;
use App\TemperatureModel\Temperature;
use App\Service\UnitConverterService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Rest\Route("/api/v1")
 */
class ConverterApiController extends Controller
{
    private $unitConverterService;

    public function __construct(UnitConverterService $unitConverterService)
    {
        $this->unitConverterService = $unitConverterService;
    }

    /**
     * @Rest\Get("/convert_temperature/{initialTemperatureUnit}/{destinationTemperatureUnit}/{temperatureValue}")
     */
    public function processForm(
        string $initialTemperatureUnit,
        string $destinationTemperatureUnit,
        float $temperatureValue
    ) {
        try {
            $temperature = new Temperature($initialTemperatureUnit, $destinationTemperatureUnit, $temperatureValue);
        } catch (TemperatureBelowZeroException $exception) {
            return $this->json(['errors' => ['message' => $exception->getMessage()]], $exception->getCode());
        } catch (InvalidTemperatureUnitException $exception) {
            return $this->json(['errors' => ['message' => $exception->getMessage()]], $exception->getCode());
        }

        try {
            $newTemperature = $this->unitConverterService->convertTemperature($temperature);
        } catch (InvalidTemperatureUnitException $exception) {
            return $this->json(['errors' => ['message' => $exception->getMessage()]], $exception->getCode());
        }

        return $this->json(['convertedTemperature' => $newTemperature], Response::HTTP_OK);
    }
}
