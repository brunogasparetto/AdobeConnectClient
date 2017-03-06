<?php
namespace Bruno\AdobeConnectClient\Connection;

/**
 * An abstraction to connection with the Web Service
 */
abstract class Connection
{
    /**
     * @var string $host The host URL
     */
    protected $host = '';

    /**
     * Initialize the Connection with the Host URL
     *
     * @param string $host The Host URL
     */
    public function __construct($host)
    {
        $this->setHost($host);
    }

    /**
     * Send a GET request
     *
     * @param array $queryParams Additional parameters to add in URL. fieldName => value
     * @return Response
     */
    abstract public function get(array $queryParams = []);

    /**
     * Send a POST request
     *
     * The request need be send as application/x-www-form-urlencoded or multipart/form-data.
     * To send files need pass as stream file or SplFileInfo in $postParams
     *
     * @param array $postParams The post parameters. fieldName => value
     * @param array $queryParams Additional parameters to add in URL. fieldName => value
     * @return Response
     */
    abstract public function post(array $postParams, array $queryParams = []);

    /**
     * Set the Host URL
     *
     * @param string $host The Host URL
     */
    public function setHost($host)
    {
        $host = filter_var(rtrim($host, " /\n\t"), FILTER_SANITIZE_URL);

        if (!filter_var($host, FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED)) {
            throw new InvalidArgumentException('Connection Host must be a valid URL with scheme');
        }
        $this->host = strpos($host, '/api/xml') === false ? $host . '/api/xml' : $host;
    }
}
