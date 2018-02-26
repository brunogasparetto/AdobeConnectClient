<?php

namespace AdobeConnectClient;

use BadMethodCallException;
use UnexpectedValueException;
use InvalidArgumentException;
use DomainException;
use AdobeConnectClient\Exceptions\InvalidException;
use AdobeConnectClient\Exceptions\NoAccessException;
use AdobeConnectClient\Exceptions\NoDataException;
use AdobeConnectClient\Exceptions\TooMuchDataException;

/**
 * The Commands base class is an abstraction to Web Service actions
 *
 * Need set the Client dependency to execute the command.
 * For a list of actions see {@link https://helpx.adobe.com/adobe-connect/webservices/topics/action-reference.html}
 *
 * @todo Create all items
 */
abstract class Command
{
    /**
     * @var Client
     */
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
     * Executes the command and return a value
     *
     * @return mixed
     * @throws InvalidException
     * @throws NoAccessException
     * @throws NoDataException
     * @throws TooMuchDataException
     * @throws UnexpectedValueException
     * @throws InvalidArgumentException
     * @throws DomainException
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
     * Process the command and return a value
     *
     * @return mixed
     * @throws InvalidException
     * @throws NoAccessException
     * @throws NoDataException
     * @throws TooMuchDataException
     * @throws UnexpectedValueException
     * @throws InvalidArgumentException
     * @throws DomainException
     */
    abstract protected function process();
}
