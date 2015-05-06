<?php


namespace Shopware\SwagDefaultSort\Components\SortDefinition\Prices;


use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;

class PricesPseudoprice extends AbstractSortDefinition {

    /**
     * @return string
     */
    public function getFieldName()
    {
        return 'pseudoprice';
    }
}