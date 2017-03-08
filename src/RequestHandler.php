<?php

namespace AdobeConnectClient;

/**
 * The Request to the Server
 *
 * Handler the Request and get the response in \SimpleXMLElement format.
 *
 * @todo Improve the Exceptions including better messages
 */
class RequestHandler
{
    const STATUS_OK = 'ok';

    /**
     * @var string Host
     */
    protected $host;

    /**
     * @var array Parameters to attach with the action
     */
    protected $params;

    /**
     * @var array cURL Options
     */
    protected $curlOptions = [];

    /**
     * Create a new Request Handler
     *
     * @param string $host
     * @param array $curlOptions An array with key is a CURLOPT_* constant.
     */
    public function __construct($host, array $curlOptions = [])
    {
        $this->host = $host;
        $this->setCurlOptions($curlOptions);
    }

    /**
     * The Host URL
     *
     * @return string
     */
    public function getHostUrl()
    {
        return $this->host;
    }

    /**
     * Set the cURL Options
     *
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
        $this->curlOptions = $curlOptions + $defaults;
        $this->curlOptions[CURLOPT_RETURNTRANSFER] = true;
        $this->curlOptions[CURLOPT_FOLLOWLOCATION] = true;
    }

    /**
     * Add one Paramameter
     *
     * @param string $field
     * @param mixed $value
     */
    public function addParam($field, $value)
    {
        $this->params[$field] = $value;
    }

    /**
     * Set all Parameters
     *
     * @param array $params An array with the field in the key.
     */
    public function setParams(array $params)
    {
        $this->params = $params;
    }

    /**
     * Clear all Parameters
     */
    public function clearParams()
    {
        $this->params = [];
    }

    /**
     * Get the Response from the server.
     *
     * @param boolean $withHeader If true return with the HTTP Header
     * @return \SimpleXMLElement
     */
    public function getResponse($withHeader = false)
    {
        $result = $this->getWebServiceResponse($withHeader);

        $response = $withHeader
            ? $this->createResponseWithHeader($result)
            : $this->createResponseWithoutHeader($result);

        if (self::STATUS_OK != (string) $response->status->attributes()->code) {
            unset($response);
            throw new \Exception('Action with invalid response.');
        }
        return $response;
    }

    /**
     * Post to Server and get the response.
     *
     * @param array $postParams The POST params to send. The GET params need be set with setParams method.
     * @return \SimpleXMLElement
     */
    public function postResponse(array $postParams = [])
    {
        $curl = curl_init($this->getURL());
        curl_setopt_array($curl, $this->curlOptions);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postParams);
        $result = curl_exec($curl);
        curl_close($curl);

        if (!$result) {
            throw new \Exception(sprintf('The endpoint "%s" is not returning.', $this->getURL()));
        }

        $response = $this->createResponseWithoutHeader($result);

        if (self::STATUS_OK != (string) $response->status->attributes()->code) {
            unset($response);
            throw new \Exception('Action with invalid response.');
        }
        return $response;
    }

    /**
     * Add the file to POST and send the request.
     *
     * @param string $filePath
     * @return \SimpleXMLElement
     */
    public function sendFile($filePath)
    {
        return $this->postResponse(['file' => new \CURLFile($filePath, mime_content_type($filePath))]);
    }

    /**
     * Get the Final URL
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getURL();
    }

    /**
     * Get the URI
     */
    protected function getURI()
    {
        return http_build_query($this->params, '', '&');
    }

    /**
     * Get the URL
     */
    protected function getURL()
    {
        return $this->host . '/api/xml?' . $this->getURI();
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
     * @param boolean $withHeader If true return with the HTTP Header
     * @return string
     * @throws \Exception
     */
    protected function getWebServiceResponse($withHeader)
    {
        $curl = curl_init($this->getURL());
        curl_setopt_array($curl, $this->curlOptions);
        curl_setopt($curl, CURLOPT_HEADER, $withHeader);
        $result = curl_exec($curl);
        curl_close($curl);

        if (!$result) {
            throw new \Exception(sprintf('The endpoint "%s" is not returning.', $this->getURL()));
        }

        return $result;
    }
}
