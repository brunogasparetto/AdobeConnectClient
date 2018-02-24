<?php

namespace AdobeConnectClient\Connection\Curl;

use \AdobeConnectClient\Connection\StreamInterface;

/**
 * Stream for a cURL Connection.
 */
class Stream implements StreamInterface
{
    /**
     * @var string
     */
    protected $content = '';

    /**
     * Create the Stream
     *
     * @param string $content
     */
    public function __construct($content)
    {
        $this->content = is_string($content) ? $content : '';
    }

    /**
     * Reads all data from the stream into a string, from the beginning to end.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->content;
    }
}
