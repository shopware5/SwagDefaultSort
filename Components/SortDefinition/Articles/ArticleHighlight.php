<?php


namespace Shopware\SwagDefaultSort\Components\SortDefinition\Articles;


use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;

class ArticleHighlight extends AbstractSortDefinition {

    /**
     * @return string
     */
    public function getFieldName()
    {
        return 'topseller';
    }
}