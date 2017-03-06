<?php
namespace Bruno\AdobeConnectClient\Connection;

class Response
{
    /**
     * @var array An array as Header => Value
     */
    protected $headers = [];

    /**
     * @var string The response body
     */
    protected $body = '';

    /**
     * Create the Response
     *
     * @param array $headers An array as Header => Value
     * @param string $body The response body
     */
    public function __construct(array $headers, $body)
    {
        $this->headers = $headers;
        $this->body = $body;
    }

    /**
     * Get the Body
     *
     * @return string
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
     * Get a Specific Header
     *
     * @return string
     */
    public function getHeader($header)
    {
        if (isset($this->headers[$header])) {
            return $this->headers[$header];
        }
        $header = $this->normalizeString($header);

        foreach ($this->headers as $key => $value) {
            if ($key === $header) {
                return $value;
            }
        }
        return '';
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