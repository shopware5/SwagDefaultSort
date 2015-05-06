<?php


namespace Shopware\SwagDefaultSort\Components\ORMReflector;

/**
 * Class MetadataFactoryLoader
 *
 * Slow fallback searches all registered models
 *
 * @package Shopware\Components\ORMReflector
 */
class MetadataFactoryLoader extends LoaderAbstract
{

    /**
     * @inheritdoc
     */
    public function load($dbTableName)
    {
        $metadata = $this->entityManager->getMetadataFactory()->getAllMetadata();

        /** @var ClassMetadata $tableMetadata */
        foreach ($metadata as $tableMetadata) {
            if ($dbTableName !== $tableMetadata->getTableName()) {
                continue;
            }

            return $this->createInflectorResult($tableMetadata);
        }

        return null;
    }
}