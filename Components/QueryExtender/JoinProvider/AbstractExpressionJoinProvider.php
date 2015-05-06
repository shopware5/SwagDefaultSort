<?php


namespace Shopware\SwagDefaultSort\Components\QueryExtender\JoinProvider;

use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;
use Shopware\SwagDefaultSort\Components\SortDefinition\ExpressionConditionInterface;

/**
 * Class AbstractExpressionJoinProvider
 *
 * Provides helper functions for Expression Join extender
 *
 * @package Shopware\SwagDefaultSort\Components\QueryExtender\JoinProvider
 */
abstract class AbstractExpressionJoinProvider extends AbstractJoinProvider
{

    /**
     * @param AbstractSortDefinition $definition
     * @return string
     */
    abstract public function isSupportedInterface(AbstractSortDefinition $definition);

    /**
     * Helper function
     *
     * @param ExpressionConditionInterface $definition
     * @param $alias
     * @return string
     */
    protected function getSelectWithExpression(ExpressionConditionInterface $definition, $alias) {
        $groupingFunction = strtoupper($definition->getGroupingFunction());

        if(!$groupingFunction) {
            throw new \UnexpectedValueException('->getGroupingFunction() must return a value.');
        }

        return $groupingFunction . '(' . $alias . '.' . $definition->getFieldName() . ')';
    }
}