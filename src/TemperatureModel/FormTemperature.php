<?php

namespace App\TemperatureModel;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class FormTemperature extends AbstractTemperature implements TemperatureFormInterface
{

    public function setTemperatureValue(?float $temperatureValue): TemperatureFormInterface
    {
        $this->temperatureValue = $temperatureValue;

        return $this;
    }

    public function setInitialTemperatureUnit(?string $initialTemperatureUnit): TemperatureFormInterface
    {
        $this->initialTemperatureUnit = $initialTemperatureUnit;

        return $this;
    }

    public function setDestinationTemperatureUnit(?string $destinationTemperatureUnit): TemperatureFormInterface
    {
        $this->destinationTemperatureUnit = $destinationTemperatureUnit;

        return $this;
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
