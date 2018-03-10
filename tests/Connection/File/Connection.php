<?php

namespace AdobeConnectClient\Tests\Connection\File;

use UnexpectedValueException;
use AdobeConnectClient\Connection\ConnectionInterface;
use AdobeConnectClient\Connection\Curl\Response;
use AdobeConnectClient\Connection\Curl\Stream;

class Connection implements ConnectionInterface
{
    private $contentType = 'text/xml';

    private $resources = __DIR__ . '/Resources/';

    private $override = '';

    private $session = 'na9breezx3385yw9ymhhzb5p';

    private $routes = [];

    public function __construct()
    {
        $this->routes = include __DIR__ . '/routes.php';
    }


    public function overrideStatusWithInvalid()
    {
        $this->override = 'status-invalid';
    }

    public function overrideStatusWithNoAccess()
    {
        $this->override = 'status-no-access';
    }

    public function overrideStatusWithNoData()
    {
        $this->override = 'status-no-data';
    }

    public function overrideStatusWithTooMuchData()
    {
        $this->override = 'status-too-much-data';
    }

    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
    }

    public function resetStatusOverride()
    {
        $this->override = '';
    }

    public function getSessionString()
    {
        return $this->session;
    }

    private function getResourcePath(array $queryParams)
    {
        if ($this->override) {
            return $this->resources . $this->override . '.xml';
        }

        $action = $queryParams['action'];
        $resourceId = sha1(serialize($queryParams));

        if (empty($this->routes[$action][$resourceId])) {
            trigger_error("Resource to {$action} with resource ID {$resourceId} not found.", E_USER_ERROR);
        }

        return $this->resources . $this->routes[$action][$resourceId] . '.xml';
    }

    /**
     * @inheritdoc
     */
    public function get(array $queryParams = [])
    {
        $resourceFile = $this->getResourcePath($queryParams);

        return new Response(
            200,
            [
                'Content-Type' => [$this->contentType],
                'Set-Cookie' => ["BREEZESESSION={$this->session};HttpOnly;domain=.adobeconnect.com;secure;path=/"]
            ],
            new Stream(file_get_contents($resourceFile))
        );
    }

    /**
     * @inheritdoc
     */
    public function post(array $postParams, array $queryParams = [])
    {
        $resourceFile = $this->getResourcePath($queryParams);

        return new Response(
            200,
            [
                'Content-Type' => ['text/xml'],
                'Set-Cookie' => ["BREEZESESSION={$this->session};HttpOnly;domain=.adobeconnect.com;secure;path=/"]
            ],
            new Stream(file_get_contents($resourceFile))
        );
    }
}
