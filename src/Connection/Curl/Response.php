<?php

namespace AdobeConnectClient\Connection\Curl;

use AdobeConnectClient\Connection\ResponseInterface;
use AdobeConnectClient\Connection\StreamInterface;
use AdobeConnectClient\Traits\HttpReasonPhrase;

/**
 * The server response for cURL Connection.
 */
class Response implements ResponseInterface
{
    use HttpReasonPhrase;

    /**
     * @var int The response status code
     */
    protected $statusCode = 0;

    /**
     * @var array An associative array
     */
    protected $headers = [];

    /**
     * @var StreamInterface The response body
     */
    protected $body = null;

    /**
     * Create the Response.
     *
     * @param int $statusCode The response status code
     * @param array $headers Associative array as name => value. Value is an array of strings
     * @param StreamInterface $body The response body
     */
    public function __construct($statusCode, array $headers, StreamInterface $body)
    {
        $this->statusCode = intval($statusCode);
        $this->headers = $headers;
        $this->body = $body;
    }

    /**
     * Gets the response status code.
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Gets the body of the message.
     *
     * @return StreamInterface
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Retrieves all message header values.
     *
     * The keys represent the header name as it will be sent over the wire, and
     * each value is an array of strings associated with the header.
     *
     * @return array An associative array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Retrieves a message header value by the given case-insensitive name.
     *
     * This method returns an array of all the header values of the given
     * case-insensitive header name.
     *
     * @param string $name Case-insensitive header field name.
     * @return string[] An array of string values as provided for the given header.
     */
    public function getHeader($name)
    {
        if (isset($this->headers[$name])) {
            return $this->headers[$name];
        }
        $name = $this->normalizeString($name);

        foreach ($this->headers as $header => $value) {
            if ($this->normalizeString($header) === $name) {
                return $value;
            }
        }
        return [];
    }

    /**
     * Retrieves a comma-separated string of the values for a single header.
     *
     * This method returns all of the header values of the given
     * case-insensitive header name as a string concatenated together using
     * a comma.
     *
     * NOTE: Not all header values may be appropriately represented using
     * comma concatenation. For such headers, use getHeader() instead
     * and supply your own delimiter when concatenating.
     *
     * @param string $name Case-insensitive header field name.
     * @return string
     */
    public function getHeaderLine($name)
    {
        return implode(', ', $this->getHeader($name));
    }

    /**
     * Normalize the string to compare with others strings
     *
     * @param string $string
     * @return string
     */
    protected function normalizeString($string)
    {
        return mb_strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $string));
    }
}
