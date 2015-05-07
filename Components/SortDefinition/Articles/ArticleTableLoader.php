<?php

namespace Shopware\SwagDefaultSort\Components\SortDefinition\Articles;

use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractGenericTableLoader;
use Shopware\SwagDefaultSort\Components\SortDefinition\TranslateTableInterface;

class ArticleTableLoader extends AbstractGenericTableLoader implements TranslateTableInterface
{
    /**
     * @return string
     */
    public function getTableName()
    {
        return 's_articles';
    }

    /**
     * @return array mapped field names
     */
    public function getMappedFieldNames()
    {
        return [
            'name',
            'pseudosales',
            'available_from',
            'available_to',
            'changetime',
            'datum',
            'topseller',
        ];
    }

    /**
     * @return string
     */
    public function getSnippetNamespace()
    {
        return 'backend/article_list/main';
    }

    /**
     * @return mixed
     */
    public function getSnippetPrefix()
    {
        return 'columns/product/Article_';
    }
}
