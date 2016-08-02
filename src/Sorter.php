<?php

namespace Bruno\AdobeConnectClient;

use \Bruno\AdobeConnectClient\Helper\CamelCase as CC;

/**
 * Create valid sort using Fluent Interface
 *
 * See {@link https://helpx.adobe.com/content/help/en/adobe-connect/webservices/sort-definition.html}
 */
class Sorter implements Parameter
{
    /**
     * @var array
     */
    protected $sorts = [];

    /**
     * Add an ASC sort
     *
     * @param string $field
     * @return \Bruno\AdobeConnectClient\Sorter
     */
    public function asc($field)
    {
        $this->sorts[CC::toHyphen($field)] = 'asc';
        return $this;
    }

    /**
     * Add a DESC sort
     *
     * @param string $field
     * @return \Bruno\AdobeConnectClient\Sorter
     */
    public function desc($field)
    {
        $this->sorts[CC::toHyphen($field)] = 'desc';
        return $this;
    }

    /**
     * Remove item to sort.
     *
     * @param string $field
     * @return \Bruno\AdobeConnectClient\Sorter
     */
    public function removeField($field)
    {
        $field = CC::toHyphen($field);

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

            return ['sort-' . CC::toHyphen($field) => $order];
        }

        $sorts = [];
        $i = 1;

        foreach (array_slice($this->sorts, 0, 2) as $field => $order) {
            $sorts['sort' . $i . '-' . CC::toHyphen($field)] = $order;
            ++$i;
        }
        return $sorts;
    }

}
