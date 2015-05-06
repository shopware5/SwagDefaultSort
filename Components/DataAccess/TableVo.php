<?php

namespace Shopware\SwagDefaultSort\Components\DataAccess;

use JsonSerializable;

/**
 * Class TableVo.
 *
 * ValueObject containing the different table names and translations
 */
class TableVo implements JsonSerializable
{
    /**
     * @var string
     */
    private $tableName;

    /**
     * @var TranslateFilter
     */
    private $filter;

    public function __construct($tableName, TranslateFilter $filter)
    {
        $this->tableName = $tableName;
        $this->filter = $filter;
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
        return $this->filter->filter($this->getTableName());
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
            'tableName' => $this->getTableName(),
            'translation' => $this->getTranslation(),
        ];
    }
}
