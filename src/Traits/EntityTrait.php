<?php

namespace AdobeConnectClient\Traits;

use \AdobeConnectClient\Helper\StringCaseTransform as SCT;

trait EntityTrait
{
    /**
     * Set the attributes using an Associative Array
     * @param array $attributes
     */
    public function setAttributes(array $attributes)
    {
        foreach ($attributes as $attr => $value) {
            if (\is_array($value)) {
                $this->setAttributes($value);
                continue;
            }
            $attributeSetMethod = 'set' . SCT::toUpperCamelCase($attr);

            if (\method_exists($this, $attributeSetMethod)) {
                $this->$attributeSetMethod($value);
            }
        }
    }
}
