<?php


namespace Shopware\SwagDefaultSort\Components\SortDefinition\ArticleDetails;

use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;

class ArticleDetailsNumber extends AbstractSortDefinition {

    /**
     * @return string
     */
    public function getFieldName()
    {
        return 'ordernumber';
    }
}