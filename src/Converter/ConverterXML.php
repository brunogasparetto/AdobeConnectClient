<?php

namespace AdobeConnectClient\Converter;

use InvalidArgumentException;
use AdobeConnectClient\Connection\ResponseInterface;
use AdobeConnectClient\Helper\StringCaseTransform as SCT;

class ConverterXML implements ConverterInterface
{
    /**
     * Converts the data into an associative array with camelCase keys
     *
     * Example:
     *     [
     *         'status' => [
     *             'code' => 'invalid',
     *             'invalid' => [
     *                 'field' => 'login',
     *                 'type' => 'string',
     *                 'subcode' => 'missing',
     *             ],
     *         ],
     *         'common' => [
     *             'zoneId' => 3,
     *             'locale' => '',
     *         ],
     *     ];
     *
     * @param ResponseInterface $response
     * @throws InvalidArgumentException if data is invalid
     * @return array
     */
    public static function convert(ResponseInterface $response)
    {
        $xml = simplexml_load_string($response->getBody());

        if ($xml === false) {
            throw new InvalidArgumentException('The response body needs be a valid XML');
        }
        return static::normalize(json_decode(json_encode($xml), true));
    }

    /**
     * Recursive transform the array
     *
     * @param array $arr The array piece
     * @return array
     */
    protected static function normalize($arr)
    {
        $ret = [];

        if (isset($arr['@attributes'])) {
            $arr = array_merge($arr, $arr['@attributes']);
            unset($arr['@attributes']);
        }

        foreach ($arr as $key => $value) {
            if (is_array($value)) {
                $value = static::normalize($value);
            }
            $ret[SCT::toCamelCase($key)] = $value;
        }

        return $ret;
    }
}
