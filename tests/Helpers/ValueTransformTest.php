<?php

use \PHPUnit\Framework\TestCase;
use \AdobeConnectClient\Helpers\ValueTransform;

class ValueTransformTest extends TestCase
{
    public function testToBoolean()
    {
        $this->assertTrue(ValueTransform::toBoolean(true));
        $this->assertTrue(ValueTransform::toBoolean(1));
        $this->assertTrue(ValueTransform::toBoolean('true'));
        $this->assertTrue(ValueTransform::toBoolean('on'));
        $this->assertTrue(ValueTransform::toBoolean('1'));

        $this->assertFalse(ValueTransform::toBoolean(false));
        $this->assertFalse(ValueTransform::toBoolean(0));
        $this->assertFalse(ValueTransform::toBoolean('false'));
        $this->assertFalse(ValueTransform::toBoolean('off'));
        $this->assertFalse(ValueTransform::toBoolean('0'));
    }

    public function testToDateTimeImmutable()
    {
        $dateTime = new DateTime();

        $this->assertInstanceOf(
           DateTimeImmutable::class,
            ValueTransform::toDateTimeImmutable($dateTime)
        );

        $this->assertInstanceOf(
           DateTimeImmutable::class,
            ValueTransform::toDateTimeImmutable(DateTimeImmutable::createFromMutable($dateTime))
        );

        $this->assertInstanceOf(
           DateTimeImmutable::class,
            ValueTransform::toDateTimeImmutable($dateTime->format(DateTime::W3C))
        );
    }

    public function testToString()
    {
        $this->assertEquals(
           'test',
            ValueTransform::toString('test')
        );

        $this->assertEquals(
           'true',
            ValueTransform::toString(true)
        );

        $this->assertEquals(
           'false',
            ValueTransform::toString(false)
        );

        $dateTimeImmutable = new DateTimeImmutable();

        $this->assertEquals(
            $dateTimeImmutable->format(DateTime::W3C),
            ValueTransform::toString($dateTimeImmutable)
        );

        $this->assertEquals(
           '1',
            ValueTransform::toString(1)
        );
    }
}