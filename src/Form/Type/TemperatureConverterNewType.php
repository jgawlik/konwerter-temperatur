<?php

namespace App\Form\Type;

use App\Form\Model\Temperature;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class TemperatureConverterNewType extends AbstractType
{
    private const TEMPERATURE_CHOICES =  [
        'Celsjusz' => Temperature::CENTIGRADE_UNIT,
        'Fahrenheit' => Temperature::FAHRENHEIT_UNIT,
        'Kelwin' => Temperature::KELVIN_UNIT,
    ];

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('temperatureValue', NumberType::class, array(
                'label' => 'Wartość temperatury',
                'constraints' => [
                    new NotBlank([
                        'message' => 'To pole nie może być puste!'
                    ]),
                ],
                'invalid_message' => 'Wprowadzona wartość nie jest numeryczna!',
            ))
            ->add('initialTemperatureUnit', ChoiceType::class, array(
                'placeholder' => false,
                'choices' => self::TEMPERATURE_CHOICES,
                'label' => 'Typ temperatury wejściowej',
                'constraints' => [
                    new NotNull([
                        'message' => 'Proszę wybrać typ wartości wejściowej!'
                    ])
                ],
            ))
            ->add('destinationTemperatureUnit', ChoiceType::class, array(
                'placeholder' => false,
                'choices' => self::TEMPERATURE_CHOICES,
                'label' => 'Typ temperatury wyjściowej',
                'constraints' => [
                    new NotNull([
                        'message' => 'Proszę wybrać typ wartości wyjściowej!'
                    ])
                ],
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Przelicz',
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'allow_extra_fields' => true,
            'data_class' => Temperature::class,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'temperatureConverter';
    }
}
