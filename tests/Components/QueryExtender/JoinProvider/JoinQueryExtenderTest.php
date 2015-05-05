<?php


namespace Shopware\SwagDefaultSort\Test\Components\QueryExtender\JoinProvider;



use Shopware\SwagDefaultSort\Components\QueryExtender\JoinProvider\AbstractJoinProvider;
use Shopware\SwagDefaultSort\Components\QueryExtender\JoinProviderCollection;
use Shopware\SwagDefaultSort\Test\AbstractSearchBundleDependantTest;

class JoinQueryExtenderTest extends AbstractSearchBundleDependantTest
{

    private function createJoinCollection() {
        return new JoinProviderCollection();
    }

    public function testJoinCollection() {
        $joinCollection = $this->createJoinCollection();

        $this->assertGreaterThan(0, count($joinCollection));
        $this->containsOnlyInstancesOf('Shopware\SwagDefaultSort\Components\QueryExtender\JoinQueryExtender\AbstractJoinProvider', $joinCollection);
    }

    public function testSingleJoinProviders() {
        /** @var AbstractJoinProvider $joinProvider */
        foreach($this->createJoinCollection() as $joinProvider) {
            $qb = $this->getQueryBuilder();

            $qb->select('*');

            $alias = $joinProvider->extendQuery($qb);

            $this->assertContains($alias, $qb->getSQL(), 'test if alias is present');

            $stmt = $qb->execute();

            $this->assertTrue(is_array($stmt->fetchAll()));
        }
    }

    public function testJoinProvidersDoubleCall() {
        /** @var AbstractJoinProvider $joinProvider */
        foreach($this->createJoinCollection() as $joinProvider) {
            $qb = $this->getQueryBuilder();

            $qb->select('*');

            $alias = $joinProvider->extendQuery($qb);
            $alias = $joinProvider->extendQuery($qb);

            $this->assertContains($alias, $qb->getSQL(), 'test if alias is present');

            $stmt = $qb->execute();

            $this->assertTrue(is_array($stmt->fetchAll()));
        }
    }

    public function testJoinProvidersCombinded() {
        $qb = $this->getQueryBuilder();
        $qb->select('*');


        /** @var AbstractJoinProvider $joinProvider */
        foreach($this->createJoinCollection() as $joinProvider) {
            $alias = $joinProvider->extendQuery($qb);

            $this->assertContains($alias, $qb->getSQL(), 'test if alias is present');

            $stmt = $qb->execute();

            $this->assertTrue(is_array($stmt->fetchAll()));
        }
    }

}