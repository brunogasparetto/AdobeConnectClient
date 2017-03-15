<?php
namespace AdobeConnectClient\Converter;

class Converter
{
    /**
     * @param \AdobeConnectClient\Connection\ResponseInterface $response
     * @throws \DomainException if data type is not implemented
     * @return \AdobeConnectClient\ResponseConverter\ConverterInterface
     */
    public static function convert($response)
    {
        switch (mb_strtolower($response->getHeaderLine('Content-Type'))) {
            case 'text/xml':
                return ConverterXML::convert($response);
                break;
            default:
                throw new \DomainException('Type "' . $response->getHeaderLine() . '" not implemented.');
                break;
        }
    }
}
