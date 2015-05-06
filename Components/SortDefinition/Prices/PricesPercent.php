<?php


namespace Shopware\SwagDefaultSort\Components\SortDefinition\Prices;


use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;

class PricesPercent extends AbstractSortDefinition {

    /**
     * @return string
     */
    public function getFieldName()
    {
        return 'percent';
    }
}