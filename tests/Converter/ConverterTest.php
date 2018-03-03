<?php

namespace AdobeConnectClient\Tests\Converter;

use DomainException;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Connection\Curl\Response;
use AdobeConnectClient\Connection\Curl\Stream;
use PHPUnit\Framework\TestCase;

class ConverterTest extends TestCase
{
    public function testConvertListRecordings()
    {
        $response = new Response(
            200,
            [
                'Content-Type' => ['text/xml']
            ],
            new Stream(file_get_contents(__DIR__ . '/../Resources/xml/list-recordings.xml'))
        );

        $expected = include __DIR__ . '/../Resources/php/list-recordings.php';

        $this->assertEquals($expected, Converter::convert($response));
    }

    public function testInvalidArgumentException()
    {
        $response = new Response(
            200,
            [
                'Content-Type' => ['application/json']
            ],
            new Stream('')
        );

        $this->expectException(DomainException::class);

        Converter::convert($response);
    }
}
