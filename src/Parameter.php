<?php

namespace AdobeConnectClient;

use DateTimeInterface;
use DateTime;
use AdobeConnectClient\Helpers\StringCaseTransform as SCT;
use AdobeConnectClient\Helpers\ValueTransform as VT;

/**
 * A generic Parameter class to extra parameters.
 */
class Parameter implements ParameterInterface
{
    /** @var array */
    protected $parameters = [];

    public static function instance()
    {
        return new static;
    }

    /**
     * Add a parameter
     *
     * @param string $parameter
     * @param mixed $value
     * @return Parameter Fluent Interface
     */
    public function set($parameter, $value)
    {
        $this->parameters[SCT::toHyphen($parameter)] = VT::toString($value);
        return $this;
    }

    /**
     * Remove a parameter
     *
     * @param string $parameter
     * @return Parameter Fluent Interface
     */
    public function remove($parameter)
    {
        $parameter = SCT::toHyphen($parameter);

        if (isset($this->parameters[$parameter])) {
            unset($this->parameters[SCT::toHyphen($parameter)]);
        }
        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->parameters;
    }
}
