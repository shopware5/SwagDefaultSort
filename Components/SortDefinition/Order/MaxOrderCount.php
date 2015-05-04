<?php



namespace Shopware\SwagDefaultSort\Components\SortDefinition\Order;

use Shopware\SwagDefaultSort\Components\SortDefinition\GroupExpressionConditionInterface;

/**
 * Class MaxOrderCount
 *
 * @package Shopware\Components\SortDefinition\Order
 */
class MaxOrderCount extends OrderAbstract implements GroupExpressionConditionInterface {

    /**
     * @return string
     */
    public function getFieldName()
    {
        return 'id';
    }

    /**
     * @return string
     */
    public function getGroupingFunction()
    {
        return self::GROUPFKT_COUNT;
    }
}