<?php


namespace Shopware\SwagDefaultSort\Components\SortDefinition\ArticleAttributes;

use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;


class GenericDefinition extends AbstractSortDefinition {

    /**
     * @var string
     */
    private $fieldName;

    /**
     * @param string $fieldName
     */
    public function __construct($fieldName) {
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