<?php

namespace AdobeConnectClient\Helpers;

use AdobeConnectClient\Helpers\StringCaseTransform as SCT;

abstract class SetEntityAttributes
{
    public static function setAttributes($object, $attributes)
    {
        foreach ($attributes as $attr => $value) {
            if (is_array($value)) {
                static::setAttributes($object, $value);
                continue;
            }

            $attributeSetMethod = 'set' . SCT::toUpperCamelCase($attr);

            if (method_exists($object, $attributeSetMethod)) {
                $object->$attributeSetMethod($value);
            }
        }
    }
}
