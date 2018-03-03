<?php

namespace AdobeConnectClient\Tests\Converter;

use InvalidArgumentException;
use AdobeConnectClient\Converter\ConverterXML;
use AdobeConnectClient\Connection\Curl\Response;
use AdobeConnectClient\Connection\Curl\Stream;
use PHPUnit\Framework\TestCase;

class ConverterXmlTest extends TestCase
{
    public function testInvalidArgumentException()
    {
        $response = new Response(200, [], new Stream(''));

        $this->expectException(InvalidArgumentException::class);

        ConverterXML::convert($response);
    }

    public function testConvertListRecordings()
    {
        $response = new Response(
            200,
            [],
            new Stream(file_get_contents(__DIR__ . '/../Resources/xml/list-recordings.xml'))
        );

        $expected = include __DIR__ . '/../Resources/php/list-recordings.php';

        $this->assertEquals($expected, ConverterXML::convert($response));
    }

    public function testConvertCommonInfo()
    {
        $response = new Response(
            200,
            [],
            new Stream(file_get_contents(__DIR__ . '/../Resources/xml/common-info.xml'))
        );

        $expected = include __DIR__ . '/../Resources/php/common-info.php';

        $this->assertEquals($expected, ConverterXML::convert($response));
    }
}
