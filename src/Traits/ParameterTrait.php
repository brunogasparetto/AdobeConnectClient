<?php

namespace AdobeConnectClient\Traits;

trait ParameterTrait
{
    /**
     * Retrieves all not null attributes as an associative array
     *
     * @return array An associative array
     */
    public function toArray()
    {
        $values = [];

        foreach ($this as $prop => $value) {
            if (!isset($value)) {
                continue;
            }
            if (is_bool($value)) {
                $value = \AdobeConnectClient\Helper\BooleanTransform::toString($value);
            } elseif ($value instanceof \DateTime) {
                $value = $value->format(\DateTime::W3C);
            }
            $values[\AdobeConnectClient\Helper\StringCaseTransform::toHyphen($prop)] = $value;
        }
        return $values;
    }
}
