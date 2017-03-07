<?php
namespace Bruno\AdobeConnectClient\Connection;

class CurlStream implements StreamInterface
{
    /**
     * @var string
     */
    protected $content = '';

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
