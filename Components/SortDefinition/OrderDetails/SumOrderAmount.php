<?php



namespace Shopware\SwagDefaultSort\Components\SortDefinition\OrderDetails;

use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;
use Shopware\SwagDefaultSort\Components\SortDefinition\ExpressionConditionInterface;

/**
 * Class MaxOrderCount
 *
 * @package Shopware\Components\SortDefinition\Order
 */
class SumOrderAmount extends AbstractSortDefinition implements ExpressionConditionInterface {

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