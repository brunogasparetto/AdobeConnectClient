<?php
namespace AdobeConnectClient\Connection;

/**
 * The server response
 */
class CurlResponse implements ResponseInterface
{
    /**
     * @var int
     */
    protected $statusCode = 0;

    /**
     * @var array An array as name => value. Value is an array
     */
    protected $headers = [];

    /**
     * @var \AdobeConnectClient\Connection\StreamInterface The response body
     */
    protected $body = null;

    /**
     * Create the Response
     *
     * @param int $statusCode The response status code
     * @param array $headers An array as name => value. Value is an array of strings.
     * @param \AdobeConnectClient\Connection\StreamInterface $body The response body
     */
    public function __construct($statusCode, array $headers, StreamInterface $body)
    {
        $this->statusCode = intval($statusCode);
        $this->headers = $headers;
        $this->body = $body;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Get the Body
     *
     * @return \AdobeConnectClient\Connection\StreamInterface
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Get all Headers
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Get a specific header
     *
     * @param string $name The header name
     * @return array
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
     * Get a specific header concat the values with comma
     *
     * @param string The header name
     * @return string
     */
    public function getHeaderLine($name)
    {
        return implode(', ', $this->getHeader($name));
    }

    /**
     * Get the reason phrase
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
