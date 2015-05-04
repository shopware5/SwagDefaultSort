<?php


namespace Shopware\SwagDefaultSort\Components\SortDefinition\Order;


use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;
use Shopware\SwagDefaultSort\Components\SortDefinition\TableLoaderInterface;

class OrderTableLoader implements TableLoaderInterface {

    /**
     * @return string
     */
    public function getTableName()
    {
        return 's_order';
    }

    /**
     * @return AbstractSortDefinition[]
     */
    public function createDefinitions()
    {
        return [
            new MaxOrderCount()
        ];
    }
}