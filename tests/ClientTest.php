<?php

namespace AdobeConnectClient\Tests;

use AdobeConnectClient\Client;
use AdobeConnectClient\Tests\Connection\File\Connection;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    /**
     * @var Connection
     */
    private $connection;

    protected function setUp()
    {
        $this->connection = new Connection();
    }

    public function testSession()
    {
        $client = new Client($this->connection);
        $client->setSession('sessionstring');

        $this->assertEquals('sessionstring', $client->getSession());
    }


    public function testCommandNotFound()
    {
        $client = new Client($this->connection);

        $this->expectException(\BadMethodCallException::class);

        $client->notFoundCommand();
    }
}
