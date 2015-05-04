<?php


namespace Shopware\SwagDefaultSort\Components\SortDefinition\ArticleDetails;


use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;

/**
 * Class ArticleDetailsAbstract
 * @package Shopware\SwagDefaultFilter\Components\SortDefinition\ArticleDetails
 */
abstract class ArticleDetailsAbstract extends AbstractSortDefinition {

    /**
     * @return string
     */
    public function getTableName() {
        return 's_articles_details';
    }
}