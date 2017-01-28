<?php

/**
 * Created by PhpStorm.
 * User: justyna
 * Date: 28.01.17
 * Time: 13:27
 */
namespace Tests\AppBundle\Form\Type;

use AppBundle\Form\Type\TemperatureConverterNewType;
use AppBundle\Helper\Temperature;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TemperatureConverterNewTypeTest extends \Symfony\Component\Form\Test\TypeTestCase
{
    public function testSubmitValidData()
    {

        $formData = array(
            'temperatureValue'  => 256,
        );

        $form = $this->factory->create(TemperatureConverterNewType::class);

        $object = new Temperature();
        $object->setTemperatureValue(256);
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($object, $form->getData());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }

    private $validator;

    protected function getExtensions()
    {
        $this->validator = $this->createMock(ValidatorInterface::class);
        $this->validator
            ->method('validate')
            ->will($this->returnValue(new ConstraintViolationList()));
        $this->validator
            ->method('getMetadataFor')
            ->will($this->returnValue(new ClassMetadata('Symfony\Component\Form\Form')));

        return array(
            new ValidatorExtension($this->validator)
        );
    }

}