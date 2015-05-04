<?php


namespace Shopware\SwagDefaultSort\Components\SortDefinition\Articles;


use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;

abstract class ArticlesAbstract extends AbstractSortDefinition {

    public function getTableName() {
        return 's_articles';
    }
}