<?php
/*
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Shopware\SwagDefaultSort\Components\DataAccess\Translate;

use Shopware\SwagDefaultSort\Components\ORMReflector\ORMReflector;
use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;
use Shopware\SwagDefaultSort\Components\SortDefinition\TranslateTableInterface;

/**
 * Class TranslateFilter.
 *
 * From TranslateTableInterface and a SortDefinition to a readable string
 */
class FromTableDefinitionFilter implements FilterInterface
{
    /**
     * @var \Enlight_Components_Snippet_Manager
     */
    private $snippedManager;

    /**
     * @var ORMReflector
     */
    private $ormReflector;

    /**
     * @param \Enlight_Components_Snippet_Manager $snippetManager
     * @param ORMReflector $ormReflector
     */
    public function __construct(\Enlight_Components_Snippet_Manager $snippetManager, ORMReflector $ormReflector)
    {
        $this->snippedManager = $snippetManager;
        $this->ormReflector = $ormReflector;
    }

    /**
     * {@inheritdoc}
     */
    public function filter($value)
    {
        if (!$value instanceof AbstractSortDefinition) {
            throw new \InvalidArgumentException('Unable to generate translation $value of wrong type');
        }

        $table = $value->getTable();

        if (!$table instanceof TranslateTableInterface) {
            return $value;
        }

        $snippetNamespace = $this->getSnippetNamespace($table->getSnippetNamespace());
        $snippetName = $table->getSnippetPrefix().$this->getOrmFieldName($value);

        $ret = $snippetNamespace->get($snippetName);

        if (!$ret) {
            return $value;
        }

        return $ret;
    }

    private function getSnippetNamespace($namespace)
    {
        return $this->snippedManager->getNamespace($namespace);
    }

    private function getOrmFieldName(AbstractSortDefinition $definition)
    {
        return $this->ormReflector
            ->getTable(
                $definition->getTable()->getTableName()
            )
            ->getMap()
            ->getOrmValue($definition->getFieldName());
    }
}
