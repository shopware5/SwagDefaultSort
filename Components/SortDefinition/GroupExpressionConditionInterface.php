<?php


namespace Shopware\SwagDefaultSort\Components\SortDefinition;


/**
 * Interface GroupExpressionConditionInterface
 *
 * Optional: Implement this so that the actual groupoing will be done by a group-by statement - this will use modified query builder
 *
 * @package Shopware\SwagDefaultSort\Components\SortDefinition
 */
interface GroupExpressionConditionInterface {
    const GROUPFKT_COUNT = 'count';
    const GROUPFKT_MAX = 'max';
    const GROUPFKT_MIN = 'min';
    const GROUPFKT_SUM = 'sum';

    /**
     * @return string
     */
    public function getGroupingFunction();

}