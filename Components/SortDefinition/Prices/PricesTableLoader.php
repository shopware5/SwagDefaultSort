<?php

namespace Shopware\SwagDefaultSort\Components\SortDefinition\Prices;

use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractGenericTableLoader;

class PricesTableLoader extends AbstractGenericTableLoader
{
    /**
     * @return array mapped field names
     */
    public function getMappedFieldNames()
    {
        return [
            'price',
            'pseudoprice',
            'baseprice',
            'percent',
        ];
    }
    /**
     * @return string
     */
    public function getTableName()
    {
        return 's_articles_prices';
    }
}
