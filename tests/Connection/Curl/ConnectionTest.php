<?php

namespace AdobeConnectClient\Tests\Connection\Curl;

use InvalidArgumentException;
use UnexpectedValueException;
use SplFileInfo;
use AdobeConnectClient\Connection\ConnectionInterface;
use AdobeConnectClient\Connection\ResponseInterface;
use AdobeConnectClient\Connection\Curl\Connection;
use PHPUnit\Framework\TestCase;

class ConnectionTest extends TestCase
{
    protected $host = 'https://test.adobeconnect.com/api/xml';

    protected $errorHost = 'https://error.adobeconnect.com/api/xml';

    protected function setUp()
    {
        if (!TEST_CONNECTION_CURL) {
            $this->markTestSkipped();
        }
    }

    public function testConnectionInterface()
    {
        $connection = new Connection($this->host);
        $this->assertInstanceOf(ConnectionInterface::class, $connection);

        return $connection;
    }

    public function testHostInvalid()
    {
        $this->expectException(InvalidArgumentException::class);
        new Connection('invalid-host');
    }

    public function testGet()
    {
        $connection = new Connection($this->host);
        $response = $connection->get();
        $this->assertInstanceOf(ResponseInterface::class, $response);
    }

    public function testPost()
    {
        $connection = new Connection($this->host);
        $response = $connection->post(
            [
                'invalid' => 'string',
                'fileResource' => fopen(__DIR__ . '/ConnectionTest.php', 'r'),
                'SplFileInfo' => new SplFileInfo(__DIR__ . '/ConnectionTest.php')
            ]
        );
        $this->assertInstanceOf(ResponseInterface::class, $response);
    }

    public function testGetWithoutResponse()
    {
        $this->expectException(UnexpectedValueException::class);
        $connection = new Connection($this->errorHost);
        $connection->get();
    }

    public function testPostWithoutResponse()
    {
        $this->expectException(UnexpectedValueException::class);
        $connection = new Connection($this->errorHost);
        $connection->post([]);
    }
}
