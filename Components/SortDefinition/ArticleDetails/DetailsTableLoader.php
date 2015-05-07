<?php

namespace Shopware\SwagDefaultSort\Components\SortDefinition\ArticleDetails;

use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractGenericTableLoader;

class DetailsTableLoader extends AbstractGenericTableLoader
{
    /**
     * @return string
     */
    public function getTableName()
    {
        return 's_articles_details';
    }

    /**
     * @return array mapped field names
     */
    public function getMappedFieldNames()
    {
        return [
            'kind',
            'length',
            'maxpurchase',
            'minpurchase',
            'ordernumber',
            'position',
            'releasedate',
            'shippingfree',
            'suppliernumber',
            'weight',
            'height',
            'width',
        ];
    }
}
