<?php
namespace AdobeConnectClient\Converter;

abstract class Converter
{
    /**
     * @param \AdobeConnectClient\Connection\ResponseInterface $response
     * @throws \DomainException if data type is not implemented
     * @return array An associative array
     */
    public static function convert(\AdobeConnectClient\Connection\ResponseInterface $response)
    {
        $type = $response->getHeaderLine('Content-Type');

        switch (mb_strtolower($type)) {
            case 'text/xml':
                return ConverterXML::convert($response);
            default:
                throw new \DomainException('Type "' . $type . '" not implemented.');
        }
    }
}
