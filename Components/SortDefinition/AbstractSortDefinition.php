<?php


namespace Shopware\SwagDefaultSort\Components\SortDefinition;


/**
 * Interface ConditionInterface
 *
 * A single Type, for frontend performance we use plain sql
 *
 * @todo better naming!
 * @package Shopware\Swag\Components\Conditions
 */
abstract class AbstractSortDefinition {

    /**
     * @return string
     */
    abstract public function getTableName();

    /**
     * @return string
     */
    abstract public function getFieldName();

    /**
     * @return string
     */
    public function getUniqueIdentifier() {
        $insertion = '';

        if($this instanceof GroupExpressionConditionInterface) {
            $insertion = $this->getGroupingFunction() . '::';
        }

        return $this->getTableName() . '::' . $insertion . $this->getFieldName();
    }
}