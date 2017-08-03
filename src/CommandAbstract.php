<?php

namespace AdobeConnectClient;

/**
 * The Commands base class
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
     * @param  mixed $...
     * @return mixed
     */
    abstract public function execute();
}
