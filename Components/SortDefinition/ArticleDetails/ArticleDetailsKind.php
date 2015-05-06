<?php


namespace Shopware\SwagDefaultSort\Components\SortDefinition\ArticleDetails;

use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;

class ArticleDetailsKind extends AbstractSortDefinition {

    /**
     * @return string
     */
    public function getFieldName()
    {
        return 'kind';
    }
}