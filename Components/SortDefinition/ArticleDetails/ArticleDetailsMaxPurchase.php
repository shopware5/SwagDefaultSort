<?php

namespace Shopware\SwagDefaultSort\Components\SortDefinition\ArticleDetails;

use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;

class ArticleDetailsMaxPurchase extends AbstractSortDefinition
{
    /**
     * @return string
     */
    public function getFieldName()
    {
        return 'maxpurchase';
    }
}
