<?php

namespace Shopware\SwagDefaultSort\Components\SortDefinition;

abstract class AbstractGenericTableLoader implements TableLoaderInterface
{
    /**
     * @return array mapped field names
     */
    abstract public function getMappedFieldNames();

    /**
     * @return AbstractSortDefinition[]
     */
    public function createDefinitions()
    {
        $ret = [];

        foreach ($this->getMappedFieldNames() as $fieldName) {
            $ret[] = new GenericDefinition($fieldName, $this);
        }

        return $ret;
    }
}
