<?php


namespace Shopware\SwagDefaultSort\Components\QueryExtender\OrderByProvider;

use Shopware\SwagDefaultSort\Components\SortDefinition\GroupExpressionConditionInterface;

class GroupExpressionConditionFilter extends AbstractOrderByFilter {


    /**
     * @param string $currentValue
     * @return string filtered value
     */
    public function filterSort($currentValue)
    {
        $definition = $this->getDefinition();

        if(!$definition instanceof GroupExpressionConditionInterface) {
            return $currentValue;
        }

        $groupingFunction = strtoupper($definition->getGroupingFunction());

        if(!$groupingFunction) {
            throw new \UnexpectedValueException('->getGroupingFunction() must return a value.');
        }

        return $groupingFunction . '(' . $currentValue . ')';
    }

    /**
     * @param string $currentValue
     * @return string filtered value
     */
    public function filterOrder($currentValue)
    {
        return $currentValue;
    }
}