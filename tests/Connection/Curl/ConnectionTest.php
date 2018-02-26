<?php

namespace AdobeConnectClient\Tests\Connection\Curl;

use InvalidArgumentException;
use UnexpectedValueException;
use SplFileInfo;
use AdobeConnectClient\Connection\ConnectionInterface;
use AdobeConnectClient\Connection\ResponseInterface;
use AdobeConnectClient\Connection\Curl\Connection;
use AdobeConnectClient\Connection\Curl\Response;
use AdobeConnectClient\Connection\Curl\Stream;
use PHPUnit\Framework\TestCase;

class ConnectionTest extends TestCase
{
    public function testConnectionInterface()
    {
        $connection = new Connection(REAL_CONNECTION_HOST);
        $this->assertInstanceOf(ConnectionInterface::class, $connection);

        return $connection;
    }

    public function testHostInvalid()
    {
        $this->expectException(InvalidArgumentException::class);
        new Connection('invalid-host');
    }

    /**
     * @depends testConnectionInterface
     * @param Connection $connection
     */
    public function testGet(Connection $connection)
    {
        if (!TEST_REAL_CONNECTION) {
            $this->markTestSkipped();
        }

        $response = $connection->get();
        $this->assertInstanceOf(ResponseInterface::class, $response);
    }

    /**
     * @depends testConnectionInterface
     * @param Connection $connection
     */
    public function testPost(Connection $connection)
    {
        if (!TEST_REAL_CONNECTION) {
            $this->markTestSkipped();
        }

        $response = $connection->post(
            [
                'invalid' => 'string',
                'fileResource' => fopen(__DIR__ . '/ConnectionTest.php', 'r'),
                'SplFileInfo' => new SplFileInfo(__DIR__ . '/ConnectionTest.php')
            ]
        );
        $this->assertInstanceOf(ResponseInterface::class, $response);
    }

    public function testGetInvalid()
    {
        if (!TEST_REAL_CONNECTION) {
            $this->markTestSkipped();
        }

        $this->expectException(UnexpectedValueException::class);
        $connection = new Connection('https://error.adobeconnect.com/api/xml');
        $connection->get();
    }

    public function testPostInvalid()
    {
        if (!TEST_REAL_CONNECTION) {
            $this->markTestSkipped();
        }

        $this->expectException(UnexpectedValueException::class);
        $connection = new Connection('https://error.adobeconnect.com/api/xml');
        $connection->post([]);
    }
}