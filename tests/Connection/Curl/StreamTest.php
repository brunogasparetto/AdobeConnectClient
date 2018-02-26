<?php

namespace AdobeConnectClient\Tests\Connection\Curl;

use AdobeConnectClient\Connection\StreamInterface;
use AdobeConnectClient\Connection\Curl\Stream;
use PHPUnit\Framework\TestCase;


class StreamTest extends TestCase
{
    public function testStreamInterface()
    {
        $stream = new Stream('');
        $this->assertInstanceOf(StreamInterface::class, $stream);
    }

    public function testToString()
    {
        $stream = new Stream('Hello');
        $this->assertEquals('Hello', (string) $stream);
    }
}