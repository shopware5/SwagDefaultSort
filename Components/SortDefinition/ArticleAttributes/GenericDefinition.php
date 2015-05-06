<?php

namespace Shopware\SwagDefaultSort\Components\SortDefinition\ArticleAttributes;

use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;
use Shopware\SwagDefaultSort\Components\SortDefinition\TableLoaderInterface;

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
    public function getTableName()
    {
        return 's_articles_attributes';
    }

    /**
     * @return string
     */
    public function getFieldName()
    {
        return $this->fieldName;
    }
}
