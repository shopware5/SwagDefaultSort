<?php


namespace Shopware\SwagDefaultSort\Components\ValueObject;


use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;

class FieldVO implements \JsonSerializable
{

    /**
     * @var string
     */
    private $tableName;

    /**
     * @var string
     */
    private $fieldName;


    /**
     * @var TranslateFilter
     */
    private $translationFilter;

    /**
     * @var string
     */
    private $definitionIdentifier;

    /**
     * @param AbstractSortDefinition $sortDefinition
     * @param TranslateFilter $translationFilter
     */
    public function __construct(AbstractSortDefinition $sortDefinition, TranslateFilter $translationFilter)
    {
        $this->tableName = (string)$sortDefinition->getTableName();
        $this->fieldName = (string)$sortDefinition->getFieldName();
        $this->translationFilter = $translationFilter;
        $this->definitionIdentifier = get_class($sortDefinition);
    }

    /**
     * @return mixed
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * @return mixed
     */
    public function getFieldName()
    {
        return $this->fieldName;
    }

    /**
     * @return mixed
     */
    public function getTranslation()
    {
        return $this->translationFilter->filter($this->getTableName(), $this->getFieldName());
    }

    /**
     * @return string
     */
    public function getDefinitionIdentifier()
    {
        return $this->definitionIdentifier;
    }


    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    function jsonSerialize()
    {
        return [
            'tableName' => $this->getTableName(),
            'fieldName' => $this->getFieldName(),
            'translation' => $this->getTranslation(),
            'definitionClassName' => $this->definitionIdentifier,
        ];
    }
}