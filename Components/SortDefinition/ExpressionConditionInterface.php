<?php


namespace Shopware\SwagDefaultSort\Components\SortDefinition;


/**
 * Interface GroupExpressionConditionInterface
 *
 * Optional: Implement this so that the field will use a method
 *
 * @package Shopware\SwagDefaultSort\Components\SortDefinition
 */
interface ExpressionConditionInterface
{
    const GROUPFKT_COUNT = 'COUNT';
    const GROUPFKT_MAX = 'MAX';
    const GROUPFKT_MIN = 'MIN';
    const GROUPFKT_SUM = 'SUM';

    /**
     * @return string
     */
    public function getGroupingFunction();

}