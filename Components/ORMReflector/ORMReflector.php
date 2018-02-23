<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\SwagDefaultSort\Components\ORMReflector;

use Doctrine\ORM\EntityManager;
use InvalidArgumentException;

/**
 * Class ORMInflector.
 */
class ORMReflector
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var InflectorResult[]
     */
    private $instances = [];

    /**
     * @var LoaderAbstract[]
     */
    private $loaders = [];

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->loaders = [
            new MapLoader($em),
            new MetadataFactoryLoader($em),
        ];
    }

    /**
     * @param $dbTableName
     *
     * @return null|InflectorResult
     */
    public function getTable($dbTableName)
    {
        if (isset($this->instances[$dbTableName])) {
            return $this->instances[$dbTableName];
        }

        foreach ($this->loaders as $loader) {
            $instance = $loader->load($dbTableName);

            if ($instance) {
                return $this->instances[$dbTableName] = $instance;
            }
        }

        throw new InvalidArgumentException('Could not create inflector result for "' . $dbTableName . '"');
    }
}
