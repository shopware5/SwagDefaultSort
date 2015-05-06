<?php


namespace Shopware\SwagDefaultSort\Components\SortDefinition\Prices;


use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;
use Shopware\SwagDefaultSort\Components\SortDefinition\TableLoaderInterface;

class PricesTableLoader implements TableLoaderInterface{

    /**
     * @return string
     */
    public function getTableName()
    {
        return 's_articles_prices';
    }

    /**
     * @return AbstractSortDefinition[]
     */
    public function createDefinitions()
    {
        return [
            new PricesPrice($this),
            new PricesBaseprice($this),
            new PricesPseudoprice($this),
            new PricesPercent($this),
        ];
    }
}