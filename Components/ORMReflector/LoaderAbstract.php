<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\SwagDefaultSort\Components\ORMReflector;

use Doctrine\Common\Persistence\Mapping\ClassMetadata;
use Doctrine\ORM\EntityManager;

abstract class LoaderAbstract
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $dbTableName
     *
     * @return InflectorResult|null
     */
    abstract public function load($dbTableName);

    protected function createInflectorResult(ClassMetadata $metadata)
    {
        return new InflectorResult($metadata);
    }
}
