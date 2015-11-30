<?php

namespace Shopware\SwagDefaultSort\Components\SortDefinition\OrderDetails;

use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;
use Shopware\SwagDefaultSort\Components\SortDefinition\TableLoaderInterface;

class OrderTableLoader implements TableLoaderInterface
{
    /**
     * @return string
     */
    public function getTableName()
    {
        return 's_order_details';
    }

    /**
     * @return AbstractSortDefinition[]
     */
    public function createDefinitions()
    {
        return [
            new SumOrderAmount($this),
        ];
    }
}
