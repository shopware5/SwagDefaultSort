<?php


namespace Shopware\SwagDefaultSort\Components\SortDefinition;


interface TableLoaderInterface {

    /**
     * @return string
     */
    public function getTableName();

    /**
     * @return AbstractSortDefinition[]
     */
    public function createDefinitions();
}