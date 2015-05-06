<?php


namespace Shopware\SwagDefaultSort\Components\QueryExtender\OrderByProvider;

use Shopware\SwagDefaultSort\Components\SortDefinition\ExpressionConditionInterface;

/**
 * Class ExpressionConditionFilter
 *
 * Cahnges values so that the generated data from AbstractExpressionJoinProvider matches
 *
 * @package Shopware\SwagDefaultSort\Components\QueryExtender\OrderByProvider
 */
class ExpressionConditionFilter extends AbstractOrderByFilter
{


    /**
     * @param string $currentValue
     * @return string filtered value
     */
    public function filterSort($currentValue)
    {
        $definition = $this->getDefinition();

        if (!$definition instanceof ExpressionConditionInterface) {
            return $currentValue;
        }

        return str_replace('.', '_', $currentValue);
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