<?php

namespace AdobeConnectClient\Tests\Connection\File;

use UnexpectedValueException;
use AdobeConnectClient\Connection\ConnectionInterface;
use AdobeConnectClient\Connection\Curl\Response;
use AdobeConnectClient\Connection\Curl\Stream;

class Connection implements ConnectionInterface
{


    private $actionsResources = __DIR__ . '/../../Resources/xml/';

    private $overrideStatus = '';

    private $sessionString = 'na9breezx3385yw9ymhhzb5p';

    public function overrideStatusWithInvalid()
    {
        $this->overrideStatus = 'status-invalid';
    }

    public function overrideStatusWithNoAccess()
    {
        $this->overrideStatus = 'status-no-access';
    }

    public function overrideStatusWithNoData()
    {
        $this->overrideStatus = 'status-no-data';
    }

    public function overrideStatusWithTooMuchData()
    {
        $this->overrideStatus = 'status-too-much-data';
    }

    public function resetStatusOverride()
    {
        $this->overrideStatus = '';
    }

    public function getSessionString()
    {
        return $this->sessionString;
    }

    /**
     * @inheritdoc
     */
    public function get(array $queryParams = [])
    {
        $resourceFile = ($this->overrideStatus ?: $queryParams['action']) . '.xml';

        $this->resetStatusOverride();

        return new Response(
            200,
            [
                'Content-Type' => ['text/xml'],
                'Set-Cookie' => ["BREEZESESSION={$this->sessionString};HttpOnly;domain=.adobeconnect.com;secure;path=/"]
            ],
            new Stream(file_get_contents($this->actionsResources . $resourceFile))
        );
    }

    /**
     * @inheritdoc
     */
    public function post(array $postParams, array $queryParams = [])
    {
        $resourceFile = ($this->overrideStatus ?: $queryParams['action']) . '.xml';

        $this->resetStatusOverride();

        return new Response(
            200,
            [
                'Content-Type' => ['text/xml'],
                'Set-Cookie' => ["BREEZESESSION={$this->sessionString};HttpOnly;domain=.adobeconnect.com;secure;path=/"]
            ],
            new Stream(file_get_contents($this->actionsResources . $resourceFile))
        );
    }
}
