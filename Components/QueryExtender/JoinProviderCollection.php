<?php


namespace Shopware\SwagDefaultSort\Components\QueryExtender;


use Shopware\SwagDefaultSort\Components\QueryExtender\JoinProvider\TableJoinProviderInterface;
use Shopware\SwagDefaultSort\Components\QueryExtender\JoinProvider\AbstractJoinProvider;
use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;
use Traversable;

class JoinProviderCollection implements \Countable, \IteratorAggregate
{

    private $tableJoinProviders = [];

    private $uidJoinProviders = [];

    public function find(AbstractSortDefinition $sortDefinition)
    {
        $this->testLoadProviders();

        foreach ($this->uidJoinProviders as $uidPrefix => $provider) {
            if (0 === strpos($sortDefinition->getUniqueIdentifier(), $uidPrefix)) {
                return $provider;
            }
        }

        if (!isset($this->tableJoinProviders[$sortDefinition->getTableName()])) {
            throw new \InvalidArgumentException('Invalid definition provided - no join provider present.');
        }

        return $this->tableJoinProviders[$sortDefinition->getTableName()];
    }

    private function testLoadProviders()
    {
        if ($this->tableJoinProviders) {
            return;
        }

        foreach ($this->loadJoinProviders() as $provider) {
            switch ($provider->getType()) {
                case AbstractJoinProvider::TYPE_TABLE:
                    $this->tableJoinProviders[$provider->getTableName()] = $provider;
                    break;
                case AbstractJoinProvider::TYPE_UIDLIKE:
                    $this->uidJoinProviders[$provider->getUidPrefix()] = $provider;
                    break;
                default:
                    throw new \UnexpectedValueException('Provider without a sorting interface found!');
            }
        }
    }

    /**
     * @return AbstractJoinProvider[]
     */
    private function loadJoinProviders()
    {
        return [
            new JoinProvider\Articles(),
            new JoinProvider\OrderDetails(),
            new JoinProvider\ArticleAttributes(),
            new JoinProvider\ArticleDetails(),
            new JoinProvider\Taxes(),
            new JoinProvider\Votes(),
        ];
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     */
    public function getIterator()
    {
        $this->testLoadProviders();

        return new \ArrayIterator(array_merge(
            array_values($this->tableJoinProviders),
            array_values($this->uidJoinProviders)
        ));
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     */
    public function count()
    {
        $this->testLoadProviders();

        return count($this->tableJoinProviders) + count($this->uidJoinProviders);
    }
}