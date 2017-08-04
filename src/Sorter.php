<?php

namespace AdobeConnectClient;

use \AdobeConnectClient\Helpers\StringCaseTransform as SCT;

/**
 * Create valid sort using Fluent Interface
 *
 * @see https://helpx.adobe.com/content/help/en/adobe-connect/webservices/sort-definition.html
 */
class Sorter implements ParameterInterface
{
    /**
     * @var array
     */
    protected $sorts = [];

    /**
     * Prefix to use in sorts
     *
     * @var string
     */
    protected $prefix = 'sort';

    /**
     * Return a new Sorter instance
     *
     * @return Sorter
     */
    public static function instance()
    {
        return new static;
    }

    /**
     * Add an ASC sort
     *
     * @param string $field
     * @return Sorter
     */
    public function asc($field)
    {
        $this->sorts[SCT::toHyphen($field)] = 'asc';
        return $this;
    }

    /**
     * Add a DESC sort
     *
     * @param string $field
     * @return Sorter
     */
    public function desc($field)
    {
        $this->sorts[SCT::toHyphen($field)] = 'desc';
        return $this;
    }

    /**
     * Remove item to sort.
     *
     * @param string $field
     * @return Sorter
     */
    public function removeField($field)
    {
        $field = SCT::toHyphen($field);

        if (isset($this->sorts[$field])) {
            unset($this->sorts[$field]);
        }
        return $this;
    }

    /**
     * Convert the items in an array for sort parameter
     *
     * @return array
     */
    public function toArray()
    {
        if (count($this->sorts) === 1) {
            $order = reset($this->sorts);
            $field = key($this->sorts);

            return [$this->prefix . '-' . SCT::toHyphen($field) => $order];
        }

        $sorts = [];
        $i = 1;

        foreach (array_slice($this->sorts, 0, 2) as $field => $order) {
            $sorts[$this->prefix . $i . '-' . SCT::toHyphen($field)] = $order;
            ++$i;
        }
        return $sorts;
    }
}
