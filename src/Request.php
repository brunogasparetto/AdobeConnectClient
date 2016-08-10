<?php

namespace Bruno\AdobeConnectClient;

/**
 * The Request to the Server
 *
 * Make the request and get the result in \SimpleXMLElement format.
 *
 * @todo Improve the Exceptions including better messages
 */
class Request
{
    const STATUS_OK = 'ok';

    /**
     * @var string Host
     */
    protected $host;

    /**
     * @var string Action to call
     */
    protected $action;

    /**
     * @var array Parameters to attach with the action
     */
    protected $params;

    /**
     * @var string Final URI
     */
    protected $uri;

    /**
     * @var string Final URL
     */
    protected $url;

    /**
     * @var bool Get the response with Header
     */
    protected $withHeader = false;
    
    /**
     * @var array cURL Options
     */
    protected $curlOptions = [];

    /**
     * Create a new Request
     *
     * @param string $host
     * @param string $action
     * @param array $params
     * @param array $curlOptions An array with key is a CURLOPT_* constant.
     * @param bool $withHeader
     */
    public function __construct($host, $action, array $params = [], $withHeader = false, array $curlOptions = [])
    {
        $this->host = $host;
        $this->action = $action;
        $this->params = $params;
        $this->withHeader = $withHeader;

        $this->mountURI();
        $this->mountURL();
        $this->setCurlOptions($curlOptions);
    }
    
    /**
     * Set the cURL Options
     * @param array $curlOptions An array with key is a CURLOPT_* constant.
     */
    public function setCurlOptions(array $curlOptions)
    {
        $defaults = [
            CURLOPT_CONNECTTIMEOUT => 120,
            CURLOPT_TIMEOUT => 120,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
        ];
        $this->curlOptions = $defaults + $curlOptions;
        $this->curlOptions[CURLOPT_RETURNTRANSFER] = true;
        $this->curlOptions[CURLOPT_FOLLOWLOCATION] = true;
    }

    /**
     * Return a new response from a new Request.
     *
     * @param string $host
     * @param string $action
     * @param array $params
     * @param bool $withHeader
     */
    public static function response($host, $action, array $params = [], $withHeader = false)
    {
        $request = new Request($host, $action, $params, $withHeader);
        return $request->getResponse();
    }

    /**
     * Get the Response from the server.
     *
     * @return \SimpleXMLElement
     */
    public function getResponse()
    {
        $result = $this->getWebServiceResponse();

        $response = $this->withHeader
            ? $this->createResponseWithHeader($result)
            : $this->createResponseWithoutHeader($result);

        if (self::STATUS_OK != (string) $response->status->attributes()->code) {
            unset($response);
            throw new \Exception('Action with invalid response.');
        }
        return $response;
    }

    /**
     * Get the Final URL
     *
     * @return string
     */
    public function __toString()
    {
        return $this->url;
    }

    /**
     * Mount the URI
     */
    protected function mountURI()
    {
        $this->uri = '?' . http_build_query(['action' => $this->action] + $this->params, '', '&');
    }

    /**
     * Mount the URL
     */
    protected function mountURL()
    {
        $this->url = $this->host . '/api/xml' . $this->uri;
    }

    /**
     * Translate the response into a \SimpleXMLElement with the Header of the request.
     *
     * @param string $content The content returned from the server
     * @return \SimpleXMLElement
     */
    protected function createResponseWithHeader(&$content)
    {
        $xmlInitPos = stripos($content, '<?xml');
        $response = simplexml_load_string(substr($content, $xmlInitPos));

        foreach (preg_split("/\r\n|\n|\r/", substr($content, 0, $xmlInitPos)) as $line) {
            $p = strpos($line, ':');

            if ($p !== false) {
                $key = trim(str_replace('-', '', substr($line, 0, $p)));
                $response->header->$key = trim(substr($line, $p + 1));
            }
        }
        return $response;
    }

    /**
     * Translate the response into a \SimpleXMLElement from a request without Header.
     *
     * @param string $content The content returned from the server
     * @return \SimpleXMLElement
     */
    protected function createResponseWithoutHeader(&$content)
    {
        return simplexml_load_string($content);
    }

    /**
     * Get the raw response from the server.
     *
     * @return string
     * @throws \Exception
     */
    protected function getWebServiceResponse()
    {
        $curl = curl_init($this->url);
        curl_setopt_array($curl, $this->curlOptions);
        curl_setopt($curl, CURLOPT_HEADER, $this->withHeader);
        $result = curl_exec($curl);
        curl_close($curl);

        if (!$result) {
            throw new \Exception(sprintf('The endpoint "%s" is not returning.', $this->url));
        }

        return $result;
    }
}
