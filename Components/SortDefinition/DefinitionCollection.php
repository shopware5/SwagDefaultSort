<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\SwagDefaultSort\Components\SortDefinition;

use Behat\Behat\Definition\DefinitionInterface;
use Shopware\SwagDefaultSort\Components\SortDefinition\ArticleAttributes\AttributeTableLoader;
use Shopware\SwagDefaultSort\Components\SortDefinition\ArticleDetails\DetailsTableLoader;
use Shopware\SwagDefaultSort\Components\SortDefinition\Articles\ArticleTableLoader;
use Shopware\SwagDefaultSort\Components\SortDefinition\OrderDetails\OrderTableLoader;
use Shopware\SwagDefaultSort\Components\SortDefinition\Prices\PricesTableLoader;
use Shopware\SwagDefaultSort\Components\SortDefinition\Votes\VotesTableLoader;

/**
 * Class DefaultSortLoader.
 *
 * Simple Loader class, don't forget to register your Definitions here!
 */
class DefinitionCollection implements \IteratorAggregate, \Countable
{
    /**
     * @var TableLoaderInterface[]
     */
    private $tableLoaders;

    /**
     * @var DefinitionInterface[]
     */
    private $definitions;

    /**
     * @var string[][]
     */
    private $tableMap;

    /**
     * @return array
     */
    public function getDefinitions()
    {
        $this->getTableLoaders();

        if (!$this->definitions) {
            $this->loadDefinitions();
        }

        return $this->definitions;
    }

    /**
     * @param $definitionUid
     *
     * @return AbstractSortDefinition
     */
    public function getDefinition($definitionUid)
    {
        $definitions = $this->getDefinitions();

        if (!isset($definitions[$definitionUid])) {
            throw new \InvalidArgumentException('Unable to fetch definition, definitionUid "' . $definitionUid . '" not found"');
        }

        return $definitions[$definitionUid];
    }

    /**
     * Return a subset for a specific table.
     *
     * @param $tableName
     *
     * @return \ArrayIterator
     */
    public function getTableIterator($tableName)
    {
        //trigger loading
        $this->getDefinitions();

        if (!isset($this->tableMap[$tableName])) {
            throw new \InvalidArgumentException('Missing or invalid $tableName ("' . $tableName . '")');
        }

        return new \ArrayIterator($this->tableMap[$tableName]);
    }

    public function getTableNames()
    {
        $ret = [];

        foreach ($this->getTableLoaders() as $tableLoader) {
            $ret[] = $tableLoader->getTableName();
        }

        return $ret;
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->getDefinitions());
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->getDefinitions());
    }

    private function getTableLoaders()
    {
        if (!$this->tableLoaders) {
            $this->loadTableLoaders();
        }

        return $this->tableLoaders;
    }

    private function loadTableLoaders()
    {
        $this->tableLoaders = [
           new ArticleTableLoader(),
           new DetailsTableLoader(),
           new AttributeTableLoader(Shopware()->Container()->get('swag_default_sort.orm_inflector')),
           new OrderTableLoader(),
           new VotesTableLoader(),
           new PricesTableLoader(),
       ];
    }

    private function loadDefinitions()
    {
        $this->definitions = [];

        foreach ($this->tableLoaders as $loader) {
            $currentTable = $loader->getTableName();

            $this->tableMap[$currentTable] = [];

            foreach ($loader->createDefinitions() as $definition) {
                $definitionUid = $definition->getUniqueIdentifier();

                if (array_key_exists($definitionUid, $this->definitions)) {
                    throw new \LogicException('Unable to continue - a unique identifier is not unique - found "' . $definitionUid . '" twice');
                }

                $this->tableMap[$currentTable][] = $definition;
                $this->definitions[$definitionUid] = $definition;
            }
        }
    }
}
