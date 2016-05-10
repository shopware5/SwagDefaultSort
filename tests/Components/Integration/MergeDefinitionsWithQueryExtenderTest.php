<?php
/*
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Components\Integration;

use Shopware\SwagDefaultSort\Components\QueryExtender\JoinProviderCollection;
use Shopware\SwagDefaultSort\Components\QueryExtender\OrderByProvider\OrderByFilterChain;
use Shopware\SwagDefaultSort\Components\QueryExtender\QueryExtensionGateway;
use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;
use Shopware\SwagDefaultSort\Components\SortDefinition\DefinitionCollection;
use Shopware\SwagDefaultSort\Components\DataAccess\RuleVo;
use Shopware\SwagDefaultSort\Test\AbstractSearchBundleDependantTest;

class MergeDefinitionsWithQueryExtenderTest extends AbstractSearchBundleDependantTest
{
    /**
     * @var QueryExtensionGateway
     */
    private $queryExtensionGateway;

    /**
     * @var DefinitionCollection
     */
    private $definitionCollection;

    public function setUp()
    {
        parent::setUp();

        $this->definitionCollection = new DefinitionCollection();
        $this->queryExtensionGateway = new QueryExtensionGateway(
            $this->definitionCollection,
            new OrderByFilterChain(),
            new JoinProviderCollection()
        );
    }

    public function testIntegrationSingle()
    {

        /** @var AbstractSortDefinition $definition */
        foreach ($this->definitionCollection as $definition) {
            $qb = $this->getQueryBuilder();
            $qb->select('*');

            $rule = new RuleVo(1);
            $rule->setOrder(0);
            $rule->setDescending(true);
            $rule->setDefinitionUid($definition->getUniqueIdentifier());

            $this->queryExtensionGateway->addRule($rule, $qb);

            $this->assertContains($definition->getFieldName(), $qb->getSQL());
            $this->assertContains($definition->getTableName(), $qb->getSql());

            $qb->execute();
        }
    }

    /**
     * triggers: Memory allocation error: 1038 Out of sort memory, consider increasing server sort buffer size.
     *
     * so no ->execute()
     */
    public function testIntegrationAll()
    {
        $qb = $this->getQueryBuilder();
        $qb->select('*');

        /** @var AbstractSortDefinition $definition */
        foreach ($this->definitionCollection as $definition) {
            $rule = new RuleVo(1);
            $rule->setOrder(0);
            $rule->setDescending(true);
            $rule->setDefinitionUid($definition->getUniqueIdentifier());

            $this->queryExtensionGateway->addRule($rule, $qb);

            $this->assertContains($definition->getFieldName(), $qb->getSQL());
            $this->assertContains($definition->getTableName(), $qb->getSQL());
        }
    }
}
