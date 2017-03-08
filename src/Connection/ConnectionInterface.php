<?php
namespace AdobeConnectClient\Connection;

interface ConnectionInterface
{
    /**
     * Send a GET request
     *
     * @param array $queryParams Additional parameters to add in URL. fieldName => value
     * @return \AdobeConnectClient\Connection\ResponseInterface
     */
    public function get(array $queryParams = []);

    /**
     * Send a POST request
     *
     * The request need be send as application/x-www-form-urlencoded or multipart/form-data.
     * To send files need pass as stream file or SplFileInfo in $postParams
     *
     * @param array $postParams The post parameters. fieldName => value
     * @param array $queryParams Additional parameters to add in URL. fieldName => value
     * @return \AdobeConnectClient\Connection\ResponseInterface
     */
    public function post(array $postParams, array $queryParams = []);
}
