<?php


namespace Shopware\SwagDefaultSort\Components\QueryExtender\JoinProvider;


use Shopware\Bundle\SearchBundleDBAL\QueryBuilder;
use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;

abstract class AbstractJoinProvider {

    const TYPE_TABLE = 'table';

    const TYPE_UIDLIKE = 'uid_like';

    /**
     * @var int
     */
    private $uniqueCount = 0;

    /**
     * @var bool
     */
    private $generateUniqueJoin = false;

    /**
     * @return string a type constant
     */
    abstract public function getType();

    /**
     * @return string
     */
    abstract public function getTableName();

    /**
     * @return string
     */
    public function getUidPrefix() {
        throw new \BadMethodCallException('Type: "' . $this->getType() . '" does not support uid prefix');
    }

    /**
     * Extends the query and returns the alias to bind the definitition to
     *
     * @param QueryBuilder $queryBuilder
     * @return string join alias
     */
    abstract public function extendQuery(QueryBuilder $queryBuilder);

    /**
     * @param bool $set
     * @return $this
     */
    public function setAddUniqueJoin($set = true)
    {
        $this->generateUniqueJoin = (bool) $set;
        return $this;
    }

    protected function createAlias($suffix = '') {
        $className = get_class($this);
        $lastIndex = strrpos($className, '\\');

        if(false === $lastIndex) {
            throw new \LogicException('Unable to parse class name');
        }

        $realClassName = substr($className, $lastIndex + 1);

        $realClassName .= $suffix;

        if($this->generateUniqueJoin) {
            $realClassName .= '_' . $this->uniqueCount++;
        }

        return 'swagDefaultSort' . $realClassName;
    }

}