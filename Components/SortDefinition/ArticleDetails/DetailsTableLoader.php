<?php


namespace Shopware\SwagDefaultSort\Components\SortDefinition\ArticleDetails;


use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;
use Shopware\SwagDefaultSort\Components\SortDefinition\TableLoaderInterface;

class DetailsTableLoader implements TableLoaderInterface {

    /**
     * @return string
     */
    public function getTableName()
    {
        return 's_articles_details';
    }

    /**
     * @return AbstractSortDefinition[]
     */
    public function createDefinitions()
    {
        return [
            new ArticleDetailsMinpurchase()
        ];
    }
}