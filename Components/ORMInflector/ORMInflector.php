<?php
namespace Shopware\SwagDefaultSort\Components\ORMInflector;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;

class ORMInflector {

    /**
     * @var EntityManager
     */
    private $em;

    private $instances;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getTable($dbTableName) {
        if($this->instances[$dbTableName]) {
            return $this->instances[$dbTableName];
        }

        $metadata = $this->em->getMetadataFactory()->getAllMetadata();

        /** @var ClassMetadata $tableMetadata */
        foreach($metadata as $tableMetadata) {
            if($dbTableName !== $tableMetadata->getTableName()) {
                continue;
            }

            return $this->instances[$dbTableName] = $this->createInflectorResult($tableMetadata);
        }

        throw new \InvalidArgumentException('Could not create inflector result for "' . $dbTableName . '"');
    }

    private function createInflectorResult(ClassMetadata $metadata) {
        return new InflectorResult($metadata);
    }
}