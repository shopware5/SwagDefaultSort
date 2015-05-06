<?php

namespace Shopware\SwagDefaultSort\Components\SortDefinition\Votes;

use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;
use Shopware\SwagDefaultSort\Components\SortDefinition\TableLoaderInterface;

class VotesTableLoader implements TableLoaderInterface
{
    /**
     * @return string
     */
    public function getTableName()
    {
        return 's_articles_vote';
    }

    /**
     * @return AbstractSortDefinition[]
     */
    public function createDefinitions()
    {
        return [
            new SumPoints($this),
        ];
    }
}
