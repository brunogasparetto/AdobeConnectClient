<?php

namespace AdobeConnectClient\Tests\Converter;

use DomainException;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Connection\Curl\Response;
use AdobeConnectClient\Connection\Curl\Stream;
use AdobeConnectClient\Tests\Connection\File\Connection;
use PHPUnit\Framework\TestCase;

class ConverterTest extends TestCase
{
    public function testConvertListRecordings()
    {
        $connection = new Connection();

        $response = $connection->get([
            'action' => 'list-recordings',
            'folder-id' => 1,
            'session' => $connection->getSessionString()
        ]);

        $rawData = Converter::convert($response);

        $this->assertNotEmpty($rawData);
        $this->assertEquals(13633, $rawData['recordings'][0]['scoId']);
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
