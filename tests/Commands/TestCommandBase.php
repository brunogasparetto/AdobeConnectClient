<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 03/03/2018
 * Time: 12:32
 */

namespace AdobeConnectClient\Tests\Commands;

use AdobeConnectClient\Tests\Connection\File\Connection;
use AdobeConnectClient\Client;
use PHPUnit\Framework\TestCase;

abstract class TestCommandBase extends TestCase
{
    /**
     * @var Connection
     */
    protected $connection;

    /**
     * @var Client
     */
    protected $client;

    protected function setUp()
    {
        parent::setUp();

        $this->connection = new Connection();
        $this->client = new Client($this->connection);
    }

    protected function userLogin()
    {
        $this->client->setSession($this->connection->getSessionString());
    }

    protected function userLogout()
    {
        $this->client->setSession('');
    }
}
