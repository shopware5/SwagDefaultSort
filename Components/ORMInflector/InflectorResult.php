<?php


namespace Shopware\SwagDefaultSort\Components\ORMInflector;


use \Doctrine\Common\Persistence\Mapping\ClassMetadata;

/**
 * Class InflectorResult
 * @package Shopware\SwagDefaultSort\Components\ORMInflector
 */
class InflectorResult {

    /**
     * @var ClassMetadata
     */
    private $metadata;

    /**
     * @param ClassMetadata $metadata
     */
    public function __construct(ClassMetadata $metadata) {
        $this->metadata = $metadata;
    }

    public function getClassName() {
        return $this->metadata->getName();
    }

    /**
     * @return Map
     */
    public function getMap() {
        $ret = $this->createMap();

        foreach($this->getFieldNames() as $fieldName) {
            $ret->add($fieldName, $this->metadata->getFieldName($fieldName));
        }

        return $ret;
    }

    /**
     * @return array
     */
    public function getPropertyNames() {
        return $this->metadata->getFieldNames();
    }

    /**
     * @return string
     */
    public function getTableName() {
        return $this->metadata->getTableName();
    }

    /**
     * @return array
     */
    public function getFieldNames() {
        return $this->metadata->getColumnNames();
    }

    /**
     * @return Map
     */
    private function createMap() {
        return new Map($this->getTableName());
    }
}