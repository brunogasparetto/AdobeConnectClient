<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Client;

/**
 * The Commands base class
 *
 * When override the __construct keep the Client as first parameter.
 */
abstract class CommandAbstract
{
    /** @var Client */
    protected $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Executes the command and return a mixed value
     *
     * @return mixed
     */
    abstract public function execute();
}
