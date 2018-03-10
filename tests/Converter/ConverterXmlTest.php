<?php

namespace AdobeConnectClient\Tests\Converter;

use InvalidArgumentException;
use AdobeConnectClient\Converter\ConverterXML;
use AdobeConnectClient\Connection\Curl\Response;
use AdobeConnectClient\Connection\Curl\Stream;
use AdobeConnectClient\Tests\Connection\File\Connection;
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
        $connection = new Connection();

        $response = $connection->get([
            'action' => 'list-recordings',
            'folder-id' => 1,
            'session' => $connection->getSessionString()
        ]);

        $rawData = ConverterXML::convert($response);

        $this->assertNotEmpty($rawData);
        $this->assertEquals(13633, $rawData['recordings'][0]['scoId']);
    }
}
