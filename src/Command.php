<?php

namespace AdobeConnectClient;

use AdobeConnectClient\Client;
use BadMethodCallException;

/**
 * The Commands base class
 *
 * When override the __construct keep the Client as first parameter.
 */
abstract class Command
{
    /** @var Client */
    protected $client;

    /**
     * @param Client $client
     * @return Command
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * Executes the command and return a mixed value
     *
     * @return mixed
     * @throws BadMethodCallException
     */
    public function execute()
    {
        if (!($this->client instanceof Client)) {
            throw new BadMethodCallException('Needs the Client to execute a Command');
        }
        return $this->process();
    }

    /**
     * Process the command and return a mixed value
     *
     * @return mixed
     */
    abstract protected function process();
}
