<?php

namespace Shopware\SwagDefaultSort\Components\SortDefinition;

/**
 * Interface TableLoaderInterface.
 *
 * Each mapped table has a table loader, containing all fields of this table
 */
interface TableLoaderInterface
{
    /**
     * @return string
     */
    public function getTableName();

    /**
     * @return AbstractSortDefinition[]
     */
    public function createDefinitions();
}
