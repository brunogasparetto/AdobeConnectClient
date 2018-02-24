<?php

namespace AdobeConnectClient\Converter;

use \DomainException;
use \AdobeConnectClient\Connection\ResponseInterface;

abstract class Converter
{
    /**
     * @param ResponseInterface $response
     * @throws DomainException if data type is not implemented
     * @return array An associative array
     */
    public static function convert(ResponseInterface $response)
    {
        $type = $response->getHeaderLine('Content-Type');

        switch (mb_strtolower($type)) {
            case 'text/xml':
                return ConverterXML::convert($response);
            default:
                throw new DomainException('Type "' . $type . '" not implemented.');
        }
    }
}
