<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\SwagDefaultSort\Test\Components\ORMInflector;

use Shopware\Components\Test\Plugin\TestCase;
use Shopware\Models\Article\Article;
use Shopware\SwagDefaultSort\Components\ORMReflector\InflectorResult;
use Shopware\SwagDefaultSort\Components\ORMReflector\Map;
use Shopware\SwagDefaultSort\Components\ORMReflector\ORMReflector;

class ORMReflectorTest extends TestCase
{
    /**
     * @var ORMReflector
     */
    private $ormInflector;

    public function setUp()
    {
        $this->ormInflector = new ORMReflector(Shopware()->Models());
    }

    public function testReverseMapper()
    {
        $this->assertInstanceOf(
            InflectorResult::class,
            $this->ormInflector->getTable('s_articles')
        );
    }

    public function testResult()
    {
        $result = $this->ormInflector->getTable('s_articles');

        $this->assertEquals(
            's_articles',
            $result->getTableName()
        );

        $this->assertEquals(
            Article::class,
            $result->getClassName()
        );

        $this->assertContains(
            'main_detail_id',
            $result->getFieldNames()
        );

        $this->assertContains(
            'mainDetailId',
            $result->getPropertyNames()
        );
    }

    public function testMap()
    {
        $map = $this->ormInflector->getTable('s_articles')->getMap();

        $this->assertInstanceOf(Map::class, $map);

        $this->assertEquals(
            'main_detail_id',
            $map->getDbValue('mainDetailId')
        );

        $this->assertEquals(
            'mainDetailId',
            $map->getOrmValue('main_detail_id')
        );

        $this->assertArrayHasKey(
            'main_detail_id',
            $map->getOrmIterator()
        );

        $this->assertArrayHasKey(
            'mainDetailId',
            $map->getDbIterator()
        );
    }
}
