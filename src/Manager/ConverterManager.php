<?php
/**
 * Created by PhpStorm.
 * User: justyna
 * Date: 28.01.17
 * Time: 01:08
 */

namespace App\Manager;

use App\Helper\Temperature;

/**
 * Class ConverterManager
 * @package App\Manager
 */
class ConverterManager
{
    /**
     * @param Temperature $temp
     * @return float|null
     */
    public function getNewValueTemp($temp)
    {
        switch ($temp->getInitType()) {
            case 'c':
                return $this->getTemForInitCentigrade($temp);
                break;
            case 'k':
                return $this->getTemForInitKelvin($temp);
                break;
            case 'f':
                return $this->getTemForInitFarenheit($temp);
                break;
            default:
                return null;
        }
    }

    /**
     * @param Temperature $temp
     * @return float|null
     */
    public function getTemForInitCentigrade($temp)
    {
        switch ($temp->getDestType()) {
            case 'k':
                return $temp->changeCentigradeToKelvin($temp->getTemperatureValue());
                break;
            case 'f':
                return $temp->changeCentigradeToFarenheit($temp->getTemperatureValue());
                break;
            default:
                return null;
        }
    }

    /**
     * @param Temperature $temp
     * @return float|null
     */
    public function getTemForInitKelvin($temp)
    {
        switch ($temp->getDestType()) {
            case 'c':
                return $temp->changeKelvinToCentigrade($temp->getTemperatureValue());
                break;
            case 'f':
                return $temp->changeKelvinToFahrenheit($temp->getTemperatureValue());
                break;
            default:
                return null;
        }
    }

    /**
     * @param Temperature $temp
     * @return float|null
     */
    public function getTemForInitFarenheit($temp)
    {
        switch ($temp->getDestType()) {
            case 'c':
                return $temp->changeFahrenheitToCentigrade($temp->getTemperatureValue());
                break;
            case 'k':
                return $temp->changeFahrenheitToKelvin($temp->getTemperatureValue());
                break;
            default:
                return null;
        }
    }
}