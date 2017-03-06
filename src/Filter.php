<?php

namespace Bruno\AdobeConnectClient;

use \Bruno\AdobeConnectClient\Helper\StringCaseTransform as SCT;
use \Bruno\AdobeConnectClient\Helper\BooleanTransform as B;

/**
 * Create valid filters using Fluent Interface
 *
 * See {@link https://helpx.adobe.com/content/help/en/adobe-connect/webservices/filter-definition.html}
 */
class Filter implements Parameter
{
    /**
     * @var array
     */
    protected $filters = [];

    /**
     * Prefix to use in filters to indicate it's filter
     *
     * @var string
     */
    protected $prefix = 'filter';

    /**
     * Returns if exactly matches.
     *
     * @param string $field The Field in camelCase
     * @param string $value The Value to compare
     * @return \Bruno\AdobeConnectClient\Filter Fluent Interface
     */
    public function equals($field, $value)
    {
        $this->setFilter('', $field, $value);
        return $this;
    }

    /**
     * Returns even if is not an exact match.
     *
     * @param string $field The Field in camelCase
     * @param string $value The Value to compare
     * @return \Bruno\AdobeConnectClient\Filter Fluent Interface
     */
    public function like($field, $value)
    {
        $this->setFilter('like', $field, $value);
        return $this;
    }

    /**
     * Filters out or excludes.
     *
     * @param string $field The Field in camelCase
     * @param string $value The Value to compare
     * @return \Bruno\AdobeConnectClient\Filter Fluent Interface
     */
    public function out($field, $value)
    {
        $this->setFilter('out', $field, $value);
        return $this;
    }

    /**
     * Limits the results to the number of rows specified.
     *
     * @param int $limit The limit rows
     * @return \Bruno\AdobeConnectClient\Filter Fluent Interface
     */
    public function rows($limit)
    {
        $this->setFilter('', 'rows', $limit);
        return $this;
    }

    /**
     * Starts the results at the index number specified.
     *
     * @param int $offset The initial index
     * @return \Bruno\AdobeConnectClient\Filter Fluent Interface
     */
    public function start($offset)
    {
        $this->setFilter('', 'start', $offset);
        return $this;
    }

    /**
     * Selects all items with a date after.
     *
     * @param string $dateField The Date Field in camelCase
     * @param \DateTimeInterface $date The value to compare
     * @param boolean $inclusive Filter inclusive the date
     * @return \Bruno\AdobeConnectClient\Filter Fluent Interface
     */
    public function dateAfter($dateField, \DateTimeInterface $date, $inclusive = true)
    {
        $this->setFilter(
            $inclusive ? 'gte' : 'gt',
            $dateField,
            $date->format(\DateTime::W3C)
        );
        return $this;
    }

    /**
     * Selects all items with a date earlier
     *
     * @param string $dateField The Date Field in camelCase
     * @param \DateTimeInterface $date The value to compare
     * @param boolean $inclusive Filter inclusive the date
     * @return \Bruno\AdobeConnectClient\Filter Fluent Interface
     */
    public function dateBefore($dateField, \DateTimeInterface $date, $inclusive = true)
    {
        $this->setFilter(
            $inclusive ? 'lte' : 'lt',
            $dateField,
            $date->format(\DateTime::W3C)
        );
        return $this;
    }

    /**
     * Selects all principals that are members of a group, specified in a separate parameter.
     *
     * @param boolean $value The value to compare
     * @return \Bruno\AdobeConnectClient\Filter Fluent Interface
     */
    public function isMember($value)
    {
        $this->setFilter('', 'is-member', $value);
        return $this;
    }

    /**
     * Remove all filters using the Field
     *
     * @param string $field The Field in camelCase
     * @return \Bruno\AdobeConnectClient\Filter
     */
    public function removeField($field)
    {
        $field = SCT::toHyphen($field);
        $this->filters = array_filter(
            $this->filters,
            function ($filter) use ($field) {
                return mb_strpos($filter, $field) === false;
            },
            ARRAY_FILTER_USE_KEY
        );
        return $this;
    }

    /**
     * Convert the items in an array for filter parameter
     *
     * @return array
     */
    public function toArray()
    {
        return $this->filters;
    }

    /**
     * Set the Filter.
     *
     * @param string $operator
     * @param string $field
     * @param string $value
     */
    protected function setFilter($operator, $field, $value)
    {
        $this->filters[$this->prefix . '-' . $operator . ($operator ? '-' : '') . SCT::toHyphen($field)] = is_bool($value) ? B::toString($value) : $value;
    }
}
