<?php

namespace AdobeConnectClient;

/**
 * Grant the items in an array to use in Request
 */
interface Arrayable
{
    /**
     * Converts the attributes in an associative array
     *
     * @return array
     */
    public function toArray();
}
