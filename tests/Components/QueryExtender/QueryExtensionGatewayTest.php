<?php
/*
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Shopware\SwagDefaultSort\Test\Components\QueryExtender;

use Shopware\SwagDefaultSort\Components\QueryExtender\JoinProviderCollection;
use Shopware\SwagDefaultSort\Components\QueryExtender\OrderByProvider\OrderByFilterChain;
use Shopware\SwagDefaultSort\Components\QueryExtender\QueryExtensionGateway;
use Shopware\SwagDefaultSort\Components\SortDefinition\DefinitionCollection;
use Shopware\SwagDefaultSort\Components\DataAccess\RuleVo;
use Shopware\SwagDefaultSort\Components\SortDefinition\OrderDetails\OrderTableLoader;
use Shopware\SwagDefaultSort\Components\SortDefinition\OrderDetails\SumOrderAmount;
use Shopware\SwagDefaultSort\Test\AbstractSearchBundleDependantTest;

class QueryExtensionGatewayTest extends AbstractSearchBundleDependantTest
{
    private function createQueryExtensionGateway()
    {
        return new QueryExtensionGateway(
            new DefinitionCollection(),
            new OrderByFilterChain(),
            new JoinProviderCollection()
        );
    }

    public function testDefaultFieldQueryExtender()
    {
        $extensionGateway = $this->createQueryExtensionGateway();
        $queryBuilder = $this->getQueryBuilder();
        $config = new SumOrderAmount(new OrderTableLoader());
        $rule = new RuleVo(1);
        $rule->setDefinitionUid($config->getUniqueIdentifier());
        $rule->setOrder(0);

        $beforeSql = $queryBuilder->getSQL();

        $extensionGateway->addRule(
            $rule,
            $queryBuilder
        );

        $afterSql = $queryBuilder->getSQL();

        $this->assertNotEquals($beforeSql, $afterSql);
    }
}
