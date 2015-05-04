<?php


namespace Shopware\SwagDefaultSort\Components\SortDefinition\Articles;

use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;
use Shopware\SwagDefaultSort\Components\SortDefinition\TableLoaderInterface;

class ArticleTableLoader implements TableLoaderInterface {


    /**
     * @return string
     */
    public function getTableName()
    {
        return 's_articles';
    }

    /**
     * @return AbstractSortDefinition[]
     */
    public function createDefinitions()
    {
        return [
            new ArticleName(),
            new ArticleDate()
        ];
    }
}