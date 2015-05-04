<?php


namespace Shopware\SwagDefaultSort\Components\ValueObject;


class TableVO implements \JsonSerializable
{

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
            'translation' => $this->getTranslation(),
        ];
    }
}