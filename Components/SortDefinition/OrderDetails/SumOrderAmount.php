<?php



namespace Shopware\SwagDefaultSort\Components\SortDefinition\OrderDetails;

use Shopware\SwagDefaultSort\Components\SortDefinition\GroupExpressionConditionInterface;

/**
 * Class MaxOrderCount
 *
 * @package Shopware\Components\SortDefinition\Order
 */
class SumOrderAmount extends OrderAbstract implements GroupExpressionConditionInterface {

    /**
     * @return string
     */
    public function getFieldName()
    {
        return 'quantity';
    }

    /**
     * @return string
     */
    public function getGroupingFunction()
    {
        return self::GROUPFKT_SUM;
    }
}