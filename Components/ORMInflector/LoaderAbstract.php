<?php


namespace Shopware\SwagDefaultSort\Components\ORMInflector;


use Doctrine\ORM\EntityManager;
use \Doctrine\Common\Persistence\Mapping\ClassMetadata;

abstract class LoaderAbstract {

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $dbTableName
     * @return InflectorResult|null
     */
    abstract public function load($dbTableName);

    protected function createInflectorResult(ClassMetadata $metadata) {
        return new InflectorResult($metadata);
    }
}