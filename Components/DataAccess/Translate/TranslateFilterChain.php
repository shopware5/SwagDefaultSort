<?php

namespace Shopware\SwagDefaultSort\Components\DataAccess\Translate;

/**
 * Class TranslateFilterChain.
 *
 * Add multiple filters and the first actually transforming the value will be used
 */
class TranslateFilterChain
{
    /**
     * @var FilterInterface[]
     */
    private $filters = [];

    /**
     * @param array $filters
     */
    public function __construct(array $filters)
    {
        foreach ($filters as $filter) {
            $this->addFilter($filter);
        }
    }

    /**
     * @param FilterInterface $filter
     */
    public function addFilter(FilterInterface $filter)
    {
        $this->filters[] = $filter;
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function filter($value)
    {
        foreach ($this->filters as $filter) {
            $newValue = $filter->filter($value);

            if ($newValue != $value) {
                return $newValue;
            }

            $value = $newValue;
        }

        throw new \InvalidArgumentException('No translation found for "'.$value.'" in filterChain');
    }
}
