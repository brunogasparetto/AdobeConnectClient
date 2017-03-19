<?php

namespace AdobeConnectClient\Traits;

use \AdobeConnectClient\Helper\StringCaseTransform;

trait EntityTrait
{
    /**
     * Set the attributes using an Associative Array
     * @param array $attributes
     */
    public function setAttributes(array $attributes)
    {
        foreach ($attributes as $attr => $value) {
            if (is_array($value)) {
                $this->setAttributes($value);
                continue;
            }
            $attributeSetMethod = 'set' . StringCaseTransform::toUpperCamelCase($attr);

            if (method_exists($this, $attributeSetMethod)) {
                $this->$attributeSetMethod($value);
            }
        }
    }
}
