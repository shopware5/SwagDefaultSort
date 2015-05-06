<?php

namespace Shopware\SwagDefaultSort\Components\SortDefinition\ArticleDetails;

use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;

class ArticleDetailsWeight extends AbstractSortDefinition
{
    /**
     * @return string
     */
    public function getFieldName()
    {
        return 'weight';
    }
}
