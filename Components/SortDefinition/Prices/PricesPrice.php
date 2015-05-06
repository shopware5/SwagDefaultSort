<?php


namespace Shopware\SwagDefaultSort\Components\SortDefinition\Prices;


use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;

class PricesPrice extends AbstractSortDefinition {

    /**
     * @return string
     */
    public function getFieldName()
    {
        return 'price';
    }
}