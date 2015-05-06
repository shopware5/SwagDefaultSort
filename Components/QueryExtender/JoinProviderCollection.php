<?php


namespace Shopware\SwagDefaultSort\Components\QueryExtender;


use Shopware\SwagDefaultSort\Components\QueryExtender\JoinProvider\AbstractExpressionJoinProvider;
use Shopware\SwagDefaultSort\Components\QueryExtender\JoinProvider\TableJoinProviderInterface;
use Shopware\SwagDefaultSort\Components\QueryExtender\JoinProvider\AbstractJoinProvider;
use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;
use Traversable;

/**
 * Class JoinProviderCollection
 *
 * * Loads all JoinProviders
 * * Matches providers with definitions
 *
 * @package Shopware\SwagDefaultSort\Components\QueryExtender
 */
class JoinProviderCollection implements \Countable, \IteratorAggregate
{

    /**
     * @var AbstractJoinProvider[]
     */
    private $tableJoinProviders = [];

    /**
     * @var AbstractExpressionJoinProvider[]
     */
    private $expressionJoinProviders = [];

    public function find(AbstractSortDefinition $sortDefinition)
    {
        $this->testLoadProviders();

        foreach ($this->expressionJoinProviders as $uidPrefix => $provider) {
            if($provider->isSupportedInterface($sortDefinition)) {
                return $provider;
            }
        }


        if (!isset($this->tableJoinProviders[$sortDefinition->getTableName()])) {
            throw new \InvalidArgumentException('Invalid definition provided - no join provider present.');
        }

        return $this->tableJoinProviders[$sortDefinition->getTableName()];
    }

    /**
     * helper function: call in each public function body!
     */
    private function testLoadProviders()
    {
        if ($this->tableJoinProviders) {
            return;
        }

        /** @var AbstractJoinProvider $provider */
        foreach ($this->loadJoinProviders() as $provider) {
            if($provider instanceof AbstractExpressionJoinProvider) {
                $this->expressionJoinProviders[] = $provider;
                continue;
            }

            $this->tableJoinProviders[$provider->getTableName()] = $provider;

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
            new JoinProvider\Prices(),
            new JoinProvider\OrderDetailsExpressionJoinProvider(),
            new JoinProvider\VotesExpressionJoinProvider(),
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
            array_values($this->expressionJoinProviders)
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

        return count($this->tableJoinProviders) + count($this->expressionJoinProviders);
    }
}