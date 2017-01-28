<?php
/**
 * Created by PhpStorm.
 * User: justyna
 * Date: 26.01.17
 * Time: 21:51
 */

namespace AppBundle\Helper;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Class Temperature
 * @package AppBundle\Helper
 */
class Temperature
{
    /** @var  float */
    private $temperatureValue;

    /** @var  string */
    private $initType;

    /** @var string */
    private $destType;

    /**
     * @return float
     */
    public function getTemperatureValue()
    {
        return $this->temperatureValue;
    }

    /**
     * @param float $temperatureValue
     */
    public function setTemperatureValue($temperatureValue)
    {
        $this->temperatureValue = $temperatureValue;
    }

    /**
     * @return string
     */
    public function getInitType()
    {
        return $this->initType;
    }

    /**
     * @param string $initType
     */
    public function setInitType($initType)
    {
        $this->initType = $initType;
    }

    /**
     * @return string
     */
    public function getDestType()
    {
        return $this->destType;
    }

    /**
     * @param string $destType
     */
    public function setDestType($destType)
    {
        $this->destType = $destType;
    }

    /**
     * @param $temperatureValue
     * @return float
     */
    public function changeCentigradeToFarenheit($temperatureValue)
    {
        return 9/5 * $temperatureValue + 32;
    }

    /**
     * @param $temperatureValue
     * @return mixed
     */
    public function changeCentigradeToKelvin($temperatureValue)
    {
        return $temperatureValue + 273.15;
    }

    /**
     * @param $temperatureValue
     * @return float
     */
    public function changeFahrenheitToKelvin($temperatureValue)
    {
        return ($temperatureValue+459.67)*5/9;
    }

    /**
     * @param $temperatureValue
     * @return float
     */
    public function changeFahrenheitToCentigrade($temperatureValue)
    {
        return 5/9 * ( $temperatureValue - 32 );
    }

    /**
     * @param $temperatureValue
     * @return float
     */
    public function changeKelvinToFahrenheit($temperatureValue)
    {
        return $temperatureValue * 9/5-459.67;
    }

    /**
     * @param $temperatureValue
     * @return mixed
     */
    public function changeKelvinToCentigrade($temperatureValue)
    {
        return $temperatureValue  - 273.15;
    }

    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context, $payload)
    {
        if ($this->destType == $this->initType) {
            $context->buildViolation('Typ wyjściowy i docelowy nie może być taki sam!')
                ->atPath('initType')
                ->atPath('destType')
                ->addViolation();
        }

        if ($this->destType == 'k' and $this->initType == 'c' and $this->temperatureValue < -273.15) {
            $context->buildViolation('Temperatura wyjściowa w kelwinach będzie mniejsza od 0!')
                ->atPath('destType')
                ->addViolation();
        }

        if ($this->initType == 'k' and $this->temperatureValue < 0) {
            $context->buildViolation('Temperatury w kelwinach zaczynają się od 0!')
                ->atPath('temperatureValue')
                ->addViolation();
        }

    }
}