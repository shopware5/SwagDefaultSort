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
     * @var TranslateFilter
     */
    private $translationFilter;

    /**
     * @var string
     */
    private $definitionUid;

    /**
     * @param AbstractSortDefinition $sortDefinition
     * @param TranslateFilter $translationFilter
     */
    public function __construct(AbstractSortDefinition $sortDefinition, TranslateFilter $translationFilter)
    {
        $this->tableName = (string) $sortDefinition->getTableName();
        $this->translationFilter = $translationFilter;
        $this->definitionUid = $sortDefinition->getUniqueIdentifier();
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
    public function getTranslation()
    {
        return $this->translationFilter->filter($this->getDefinitionUid());
    }

    /**
     * @return string
     */
    public function getDefinitionUid()
    {
        return $this->definitionUid;
    }


    /**
     * {@inheritdoc}
     */
    function jsonSerialize()
    {
        return [
            'tableName' => $this->getTableName(),
            'translation' => $this->getTranslation(),
            'definitionUid' => $this->definitionUid,
        ];
    }
}