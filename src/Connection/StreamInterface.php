<?php
namespace AdobeConnectClient\Connection;

interface StreamInterface
{
    /**
     * Reads all data from the stream into a string, from the beginning to end.
     *
     * @return string
     */
    public function __toString();
}
