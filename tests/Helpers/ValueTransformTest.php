<?php

namespace AdobeConnectClient\Tests;

use DateTime;
use DateTimeImmutable;
use AdobeConnectClient\Helpers\ValueTransform as VT;
use PHPUnit\Framework\TestCase;

class VTTest extends TestCase
{
    public function testToBoolean()
    {
        $this->assertTrue(VT::toBoolean(true));
        $this->assertTrue(VT::toBoolean(1));
        $this->assertTrue(VT::toBoolean('true'));
        $this->assertTrue(VT::toBoolean('on'));
        $this->assertTrue(VT::toBoolean('1'));

        $this->assertFalse(VT::toBoolean(false));
        $this->assertFalse(VT::toBoolean(0));
        $this->assertFalse(VT::toBoolean('false'));
        $this->assertFalse(VT::toBoolean('off'));
        $this->assertFalse(VT::toBoolean('0'));
    }

    public function testToDateTimeImmutable()
    {
        $dateTime = new DateTime();

        $this->assertInstanceOf(
           DateTimeImmutable::class,
            VT::toDateTimeImmutable($dateTime)
        );

        $this->assertInstanceOf(
           DateTimeImmutable::class,
            VT::toDateTimeImmutable(DateTimeImmutable::createFromMutable($dateTime))
        );

        $this->assertInstanceOf(
           DateTimeImmutable::class,
            VT::toDateTimeImmutable($dateTime->format(DateTime::W3C))
        );
    }

    public function testToString()
    {
        $this->assertEquals(
           'test',
            VT::toString('test')
        );

        $this->assertEquals(
           'true',
            VT::toString(true)
        );

        $this->assertEquals(
           'false',
            VT::toString(false)
        );

        $dateTimeImmutable = new DateTimeImmutable();

        $this->assertEquals(
            $dateTimeImmutable->format(DateTime::W3C),
            VT::toString($dateTimeImmutable)
        );

        $this->assertEquals(
           '1',
            VT::toString(1)
        );
    }
}