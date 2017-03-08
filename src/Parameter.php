<?php

namespace AdobeConnectClient;

/**
 * Grant the items in an array to use in Request
 */
interface Parameter
{
    /**
     * Convert the items into an array with keys as param name and value as param value to send in the Request
     *
     * @return array
     */
    public function toArray();
}
