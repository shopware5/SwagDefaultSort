<?php

namespace Shopware\SwagDefaultSort\Components\QueryExtender\JoinProvider;

use Shopware\Bundle\SearchBundleDBAL\QueryBuilder;
use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;

/**
 * Class AbstractJoinProvider.
 *
 * Provides a interface for join extension. These classes do not have a 1:1 relation to SortDefinitions
 */
abstract class AbstractJoinProvider
{
    /**
     * @var int
     */
    private $uniqueCount = 0;

    /**
     * @var bool
     */
    private $generateUniqueJoin = false;

    /**
     * @return string
     */
    abstract public function getTableName();

    /**
     * Extends the query and returns the alias to bind the definition to.
     *
     * @param QueryBuilder           $queryBuilder
     * @param AbstractSortDefinition $definition
     *
     * @return string join alias
     */
    abstract public function extendQuery(QueryBuilder $queryBuilder, AbstractSortDefinition $definition);

    /**
     * @param bool $set
     *
     * @return $this
     */
    public function setAddUniqueJoin($set = true)
    {
        $this->generateUniqueJoin = (bool) $set;

        return $this;
    }

    /**
     * @param string $suffix
     *
     * @return string
     */
    protected function createAlias($suffix = '')
    {
        $className = get_class($this);
        $lastIndex = strrpos($className, '\\');

        if (false === $lastIndex) {
            throw new \LogicException('Unable to parse class name');
        }

        $realClassName = substr($className, $lastIndex + 1);

        $realClassName .= $suffix;

        if ($this->generateUniqueJoin) {
            $realClassName .= '_'.$this->uniqueCount++;
        }

        return 'swagDefaultSort'.$realClassName;
    }
}
