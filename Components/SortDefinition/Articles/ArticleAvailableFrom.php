<?php


namespace Shopware\SwagDefaultSort\Components\SortDefinition\Articles;


use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;

class ArticleAvailableFrom extends AbstractSortDefinition {

    /**
     * @return string
     */
    public function getFieldName()
    {
        return 'available_from';
    }
}