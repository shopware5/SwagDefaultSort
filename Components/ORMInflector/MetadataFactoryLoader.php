<?php


namespace Shopware\SwagDefaultSort\Components\ORMInflector;

/**
 * Class MetadataFactoryLoader
 *
 * Slow fallback searches all registered models
 *
 * @package Shopware\Components\ORMInflector
 */
class MetadataFactoryLoader extends LoaderAbstract {

    public function load($dbTableName) {
        $metadata = $this->entityManager->getMetadataFactory()->getAllMetadata();

        /** @var ClassMetadata $tableMetadata */
        foreach($metadata as $tableMetadata) {
            if($dbTableName !== $tableMetadata->getTableName()) {
                continue;
            }

            return $this->createInflectorResult($tableMetadata);
        }

        return null;
    }
}