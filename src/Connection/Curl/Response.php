<?php
namespace AdobeConnectClient\Connection\Curl;

/**
 * The server response for cURL Connection.
 */
class Response implements \AdobeConnectClient\Connection\ResponseInterface
{
    /** @var int The response status code */
    protected $statusCode = 0;

    /** @var array An associative array */
    protected $headers = [];

    /** @var \AdobeConnectClient\Connection\StreamInterface The response body */
    protected $body = null;

    /**
     * Create the Response.
     *
     * @param int $statusCode The response status code
     * @param array $headers Associative array as name => value. Value is an array of strings
     * @param \AdobeConnectClient\Connection\StreamInterface $body The response body
     */
    public function __construct($statusCode, array $headers, \AdobeConnectClient\Connection\StreamInterface $body)
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
     * Gets the response reason phrase associated with the status code.
     *
     * @return string
     */
    public function getReasonPhrase()
    {
        switch ($this->statusCode) {
            case 100: $text = 'Continue'; break;
            case 101: $text = 'Switching Protocols'; break;
            case 200: $text = 'OK'; break;
            case 201: $text = 'Created'; break;
            case 202: $text = 'Accepted'; break;
            case 203: $text = 'Non-Authoritative Information'; break;
            case 204: $text = 'No Content'; break;
            case 205: $text = 'Reset Content'; break;
            case 206: $text = 'Partial Content'; break;
            case 300: $text = 'Multiple Choices'; break;
            case 301: $text = 'Moved Permanently'; break;
            case 302: $text = 'Moved Temporarily'; break;
            case 303: $text = 'See Other'; break;
            case 304: $text = 'Not Modified'; break;
            case 305: $text = 'Use Proxy'; break;
            case 400: $text = 'Bad Request'; break;
            case 401: $text = 'Unauthorized'; break;
            case 402: $text = 'Payment Required'; break;
            case 403: $text = 'Forbidden'; break;
            case 404: $text = 'Not Found'; break;
            case 405: $text = 'Method Not Allowed'; break;
            case 406: $text = 'Not Acceptable'; break;
            case 407: $text = 'Proxy Authentication Required'; break;
            case 408: $text = 'Request Time-out'; break;
            case 409: $text = 'Conflict'; break;
            case 410: $text = 'Gone'; break;
            case 411: $text = 'Length Required'; break;
            case 412: $text = 'Precondition Failed'; break;
            case 413: $text = 'Request Entity Too Large'; break;
            case 414: $text = 'Request-URI Too Large'; break;
            case 415: $text = 'Unsupported Media Type'; break;
            case 500: $text = 'Internal Server Error'; break;
            case 501: $text = 'Not Implemented'; break;
            case 502: $text = 'Bad Gateway'; break;
            case 503: $text = 'Service Unavailable'; break;
            case 504: $text = 'Gateway Time-out'; break;
            case 505: $text = 'HTTP Version not supported'; break;
            default: $text = ''; break;
        }
        return $text;
    }

    /**
     * Normalize the string to compare with others strings
     *
     * @return string
     */
    protected function normalizeString($string)
    {
        return mb_strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $string));
    }
}
