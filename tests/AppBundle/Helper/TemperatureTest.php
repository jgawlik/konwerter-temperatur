<?php

/**
 * Created by PhpStorm.
 * User: justyna
 * Date: 28.01.17
 * Time: 11:51
 */
class TemperatureTest extends \PHPUnit\Framework\TestCase
{
    /** @var  \App\Helper\Temperature */
    private $entity;

    /**
     * Tworzenie objektu dla testu
     */
    public function setUp()
    {
        $this->entity = new \App\Helper\Temperature();
    }

    /**
     * test set and get
     */
    public function testSetGetData()
    {
        $this->entity->setDestType('k');
        $this->entity->setInitType('c');
        $this->entity->setTemperatureValue(123.56);


        static::assertEquals('k', $this->entity->getDestType());
        static::assertEquals('c', $this->entity->getInitType());
        static::assertEquals(123.56, $this->entity->getTemperatureValue());

    }


    public function tearDown()
    {
        $this->entity = null;
    }
}