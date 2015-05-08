<?php

namespace Shopware\SwagDefaultSort\Components\SortDefinition;

class GenericDefinition extends AbstractSortDefinition
{
    /**
     * @var string
     */
    private $fieldName;

    /**
     * @param string               $fieldName
     * @param TableLoaderInterface $tableLoader
     */
    public function __construct($fieldName, TableLoaderInterface $tableLoader)
    {
        parent::__construct($tableLoader);

        $this->fieldName = (string) $fieldName;
    }

    /**
     * @return string
     */
    public function getFieldName()
    {
        return $this->fieldName;
    }
}
