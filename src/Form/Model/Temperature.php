<?php

namespace App\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class Temperature
{
    const CENTIGRADE_UNIT = 'Centigrade';
    const KELVIN_UNIT = 'Kelvin';
    const FAHRENHEIT_UNIT = 'Fahrenheit';

    private $temperatureValue;
    private $initialTemperatureUnit;
    private $destinationTemperatureUnit;

    public function getTemperatureValue(): ?float
    {
        return $this->temperatureValue;
    }

    public function setTemperatureValue(?float $temperatureValue)
    {
        $this->temperatureValue = $temperatureValue;
    }

    public function getInitialTemperatureUnit(): ?string
    {
        return $this->initialTemperatureUnit;
    }

    public function setInitialTemperatureUnit(?string $initialTemperatureUnit)
    {
        $this->initialTemperatureUnit = $initialTemperatureUnit;
    }

    public function getDestinationTemperatureUnit(): ?string
    {
        return $this->destinationTemperatureUnit;
    }

    public function setDestinationTemperatureUnit(?string $destinationTemperatureUnit)
    {
        $this->destinationTemperatureUnit = $destinationTemperatureUnit;
    }

    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context, $payload)
    {
        if ($this->destinationTemperatureUnit === $this->initialTemperatureUnit) {
            $context->buildViolation('Typ wyjściowy i docelowy nie może być taki sam!')
                ->atPath('initialTemperatureUnit')
                ->atPath('destinationTemperatureUnit')
                ->addViolation();
        }
        if ($this->destinationTemperatureUnit == self::KELVIN_UNIT
            && $this->initialTemperatureUnit == self::CENTIGRADE_UNIT
            && $this->temperatureValue < -273.15) {
            $context->buildViolation('Temperatura wyjściowa w kelwinach będzie mniejsza od 0!')
                ->atPath('destinationTemperatureUnit')
                ->addViolation();
        }
        if ($this->initialTemperatureUnit == self::KELVIN_UNIT && $this->temperatureValue < 0) {
            $context->buildViolation('Temperatury w kelwinach zaczynają się od 0!')
                ->atPath('temperatureValue')
                ->addViolation();
        }
    }
}
