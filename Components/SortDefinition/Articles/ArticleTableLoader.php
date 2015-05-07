<?php

namespace Shopware\SwagDefaultSort\Components\SortDefinition\Articles;

use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractGenericTableLoader;

class ArticleTableLoader extends AbstractGenericTableLoader
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
}
