<?php
/**
 * Created by PhpStorm.
 * User: justyna
 * Date: 26.01.17
 * Time: 21:47
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class TemperatureConverterNewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('temperatureValue', NumberType::class, array(
                'label' => 'Wartość temperatury',
            ))
            ->add('initValue', ChoiceType::class, array(
                'placeholder' => false,
                'choices' => array('Celcjusz' => 'c', 'Fahrenheit' => 'f', 'Kelwin' => 'k'),
                'mapped'    => false,
                'label' => 'Typ temperatury wejściowej',
            ))
            ->add('destValue', ChoiceType::class, array(
                'placeholder' => false,
                'choices' => array('Celcjusz' => 'c', 'Fahrenheit' => 'f', 'Kelwin' => 'k'),
                'mapped'    => false,
                'label' => 'Typ temperatury wyjściowej',
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Przelicz',
            ))
        ;
    }
}