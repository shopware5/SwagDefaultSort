<?php


namespace Shopware\SwagDefaultSort\Components\SortDefinition\Articles;


use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;

class ArticleAvailableTo extends AbstractSortDefinition {

    /**
     * @return string
     */
    public function getFieldName()
    {
        return 'available_to';
    }
}