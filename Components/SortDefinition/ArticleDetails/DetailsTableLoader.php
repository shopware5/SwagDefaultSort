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
            new ArticleDetailsHeight($this),
            new ArticleDetailsKind($this),
            new ArticleDetailsLength($this),
            new ArticleDetailsMaxPurchase($this),
            new ArticleDetailsMinPurchase($this),
            new ArticleDetailsPosition($this),
            new ArticleDetailsReleaseDate($this),
            new ArticleDetailsSuppliernumber($this),
            new ArticleDetailsNumber($this),
            new ArticleDetailsShippingFree($this),
            new ArticleDetailsWeight($this),
            new ArticleDetailsWidth($this),
        ];
    }
}