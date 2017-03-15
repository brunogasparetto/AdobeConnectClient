<?php
namespace AdobeConnectClient\Converter;

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
     * @param \AdobeConnectClient\Connection\ResponseInterface $response
     * @throws \InvalidArgumentException if data is invalid
     * @return array
     */
    public static function convert($response)
    {
        $xml = simplexml_load_string($response->getBody());

        if ($xml === false) {
            throw new \InvalidArgumentException('The response body needs be a valid XML');
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
            $ret[\AdobeConnectClient\Helper\StringCaseTransform::toCamelCase($key)] = $value;
        }

        return $ret;
    }
}
