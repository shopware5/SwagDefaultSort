<?php


namespace Shopware\SwagDefaultSort\Components\SortDefinition\OrderDetails;


use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;

abstract class OrderAbstract extends AbstractSortDefinition {

    /**
     * @return string
     */
    public function getTableName()
    {
        return 's_order_details';
    }
}