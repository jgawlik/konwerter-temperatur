<?php
/**
 * Created by PhpStorm.
 * User: justyna
 * Date: 26.01.17
 * Time: 21:47
 */

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class TemperatureConverterNewType extends AbstractType
{
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
            ->add('initType', ChoiceType::class, array(
                'placeholder' => false,
                'choices' => array('Celcjusz' => 'c', 'Fahrenheit' => 'f', 'Kelwin' => 'k'),
                'label' => 'Typ temperatury wejściowej',
                'constraints' => [
                    new NotNull([
                        'message' => 'Proszę wybrać typ wartości wejściowej!'
                    ])
                ],
            ))
            ->add('destType', ChoiceType::class, array(
                'placeholder' => false,
                'choices' => array('Celcjusz' => 'c', 'Fahrenheit' => 'f', 'Kelwin' => 'k'),
                'label' => 'Typ temperatury wyjściowej',
                'constraints' => [
                    new NotNull([
                        'message' => 'Proszę wybrać typ wartości wyjściowej!'
                    ])
                ],
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Przelicz',
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'allow_extra_fields' => true,
            'data_class'    => 'App\Helper\Temperature',
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