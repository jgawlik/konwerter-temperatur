<?php
/**
 * Created by PhpStorm.
 * User: justyna
 * Date: 26.01.17
 * Time: 21:51
 */

namespace AppBundle\Helper;

class Temperature
{
    private $temperatureValue;

    /**
     * @return mixed
     */
    public function getTemperatureValue()
    {
        return $this->temperatureValue;
    }

    /**
     * @param mixed $temperatureValue
     */
    public function setTemperatureValue($temperatureValue)
    {
        $this->temperatureValue = $temperatureValue;
    }

    public function changeCentigradeToFarenheit($temperatureValue)
    {
        $this->temperatureValue =  9/5 * $temperatureValue + 32;
    }

    public function changeCentigradeToKelvin($temperatureValue)
    {
        $this->temperatureValue = $temperatureValue - 273.15;
    }

    public function changeFahrenheitToKelvin($temperatureValue)
    {
        $this->temperatureValue = ($temperatureValue+459.67)*5/9;
    }

    public function changeFahrenheitToCentigrade($temperatureValue)
    {
        $this->temperatureValue = 5/9 * ( $temperatureValue - 32 );
    }

    public function changeKelvinToFahrenheit($temperatureValue)
    {
        $this->temperatureValue = $temperatureValue * 9/5-459.67;
    }

    public function changeKelvinToCentigrade($temperatureValue)
    {
        $this->temperatureValue = $temperatureValue  + 273.15;
    }
}