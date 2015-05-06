<?php

namespace Shopware\SwagDefaultSort\Components\SortDefinition;

/**
 * Interface ConditionInterface.
 *
 * A single Type, for frontend performance we use plain sql
 */
abstract class AbstractSortDefinition
{
    private $tableLoader;

    public function __construct(TableLoaderInterface $tableLoader)
    {
        $this->tableLoader = $tableLoader;
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return $this->tableLoader->getTableName();
    }

    /**
     * @return string
     */
    abstract public function getFieldName();

    /**
     * @return string
     */
    public function getUniqueIdentifier()
    {
        $insertion = '';

        if ($this instanceof ExpressionConditionInterface) {
            $insertion = $this->getGroupingFunction().'::';
        }

        return $this->getTableName().'::'.$insertion.$this->getFieldName();
    }
}
