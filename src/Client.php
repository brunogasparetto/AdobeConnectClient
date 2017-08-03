<?php

namespace AdobeConnectClient;

use ReflectionClass;
use AdobeConnectClient\Connection\ConnectionInterface;

/**
 * @method bool login(string $login, string $password) Login in the Service.
 * @method CommonInfo commonInfo() Retrieves the Common Info
 */
class Client
{
    /** @var ConnectionInterface */
    protected $connection;

    /** @var string The Session Cookie */
    protected $sessionCookie = '';

    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    /**
     *
     * @return ConnectionInterface
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     *
     * @return string
     */
    public function getSession()
    {
        return $this->sessionCookie;
    }

    /**
     *
     * @param string $session
     */
    public function setSession($session)
    {
        $this->sessionCookie = $session;
    }

    /**
     * Instantiates the Command and execute it.
     *
     * @param string $commandName
     * @param array $arguments
     * @return mixed
     */
    public function __call($commandName, array $arguments = [])
    {
        $className = 'AdobeConnectClient\\Commands\\' . $commandName;

        if (!class_exists($className)) {
            throw new \DomainException(sprintf('"%s" is not defined as command', $className));
        }

        $reflection = new ReflectionClass($className);

        if (!$reflection->isSubclassOf(CommandAbstract::class)) {
            throw new \BadMethodCallException(sprintf('"%s" is not a valid command', $className));
        }
        array_unshift($arguments, $this);
        return $reflection->newInstanceArgs($arguments)->execute();
    }
}
