<?php
/*
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Shopware\SwagDefaultSort\Components\QueryExtender;

use Shopware\Bundle\SearchBundleDBAL\QueryBuilder;
use Shopware\SwagDefaultSort\Components\QueryExtender\JoinProvider\AbstractJoinProvider;
use Shopware\SwagDefaultSort\Components\QueryExtender\OrderByProvider\OrderByFilterChain;
use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;
use Shopware\SwagDefaultSort\Components\SortDefinition\DefinitionCollection;
use Shopware\SwagDefaultSort\Components\SortDefinition\ExpressionConditionInterface;
use Shopware\SwagDefaultSort\Components\DataAccess\RuleVo;

/**
 * Class QueryExtensionGateway.
 *
 * Extends Shopware DBAL Querys
 */
class QueryExtensionGateway
{
    /**
     * @var DefinitionCollection
     */
    private $definitionCollection;

    private $joinProviderCollection;

    private $orderByFilterChain;

    public function __construct(
        DefinitionCollection $definitionCollection,
        OrderByFilterChain $orderByFilterChain,
        JoinProviderCollection $joinProviderCollection
    ) {
        $this->definitionCollection = $definitionCollection;
        $this->orderByFilterChain = $orderByFilterChain;
        $this->joinProviderCollection = $joinProviderCollection;
    }

    /**
     * @param RuleVo       $rule
     * @param QueryBuilder $queryBuilder
     */
    public function addRule(RuleVo $rule, QueryBuilder $queryBuilder)
    {
        $definition = $this->loadDefinition($rule);

        $joinQueryExtender = $this->getJoinProvider($definition);

        if ($definition instanceof ExpressionConditionInterface) {
            $joinQueryExtender->setAddUniqueJoin(true);
        } else {
            $joinQueryExtender->setAddUniqueJoin(false);
        }

        $alias = $joinQueryExtender->extendQuery($queryBuilder, $definition);

        if (!$alias) {
            throw new \UnexpectedValueException('Missing required return value $alias on "'.get_class($joinQueryExtender).'"');
        }

        $this->orderByFilterChain->extendQuery($alias, $definition, $rule, $queryBuilder);
        $queryBuilder->addOrderBy('product.id');
    }

    /**
     * @param RuleVo $vo
     *
     * @return AbstractSortDefinition
     */
    private function loadDefinition(RuleVo $vo)
    {
        return $this->definitionCollection->getDefinition($vo->getDefinitionUid());
    }

    /**
     * @param AbstractSortDefinition $definition
     *
     * @return AbstractJoinProvider
     */
    private function getJoinProvider(AbstractSortDefinition $definition)
    {
        $provider = $this->joinProviderCollection->find($definition);

        if (!$provider) {
            throw new \InvalidArgumentException('Invalid $definition('.$definition->getUniqueIdentifier().') provided, no join provider found');
        }

        return $provider;
    }
}
