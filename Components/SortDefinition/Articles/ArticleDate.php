<?php

namespace Shopware\SwagDefaultSort\Components\SortDefinition\Articles;

use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;

class ArticleDate extends AbstractSortDefinition
{
    /**
     * @return string
     */
    public function getFieldName()
    {
        return 'datum';
    }
}
