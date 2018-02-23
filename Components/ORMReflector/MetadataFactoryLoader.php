<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\SwagDefaultSort\Components\ORMReflector;

use Doctrine\ORM\Mapping\ClassMetadataInfo;

/**
 * Class MetadataFactoryLoader.
 *
 * Slow fallback searches all registered models
 */
class MetadataFactoryLoader extends LoaderAbstract
{
    /**
     * {@inheritdoc}
     */
    public function load($dbTableName)
    {
        $metadata = $this->entityManager->getMetadataFactory()->getAllMetadata();

        /** @var ClassMetadataInfo $tableMetadata */
        foreach ($metadata as $tableMetadata) {
            if ($dbTableName !== $tableMetadata->getTableName()) {
                continue;
            }

            return $this->createInflectorResult($tableMetadata);
        }
    }
}
