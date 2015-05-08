<?php

namespace Shopware\SwagDefaultSort\Components\SortDefinition\Votes;

use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;
use Shopware\SwagDefaultSort\Components\SortDefinition\ExpressionConditionInterface;

class SumPoints extends AbstractSortDefinition implements ExpressionConditionInterface
{
    /**
     * @return string
     */
    public function getFieldName()
    {
        return 'points';
    }

    /**
     * @return string
     */
    public function getGroupingFunction()
    {
        return self::GROUPFKT_SUM;
    }
}
