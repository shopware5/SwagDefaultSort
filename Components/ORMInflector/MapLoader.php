<?php


namespace Shopware\SwagDefaultSort\Components\ORMInflector;

class MapLoader extends LoaderAbstract {

    const MAIN_SW_MODEL_NAMEAPSCE_PREFIX = 'Shopware\Models';


    /**
     * @var string[]
     */
    private $map = [
        's_articles_details' => 'Article\Detail',
        's_articles' => 'Article\Article',
        's_articles_attributes' => 'Attribute\Article'
    ];

    /**
     * @param string $dbTableName
     * @return InflectorResult|null
     */
    public function load($dbTableName)
    {
        if(!isset($this->map[$dbTableName])) {
            return null;
        }

        return  $this
            ->createInflectorResult(
                $this->entityManager->getMetadataFactory()->getMetadataFor(
                    self::MAIN_SW_MODEL_NAMEAPSCE_PREFIX . '\\' . $this->map[$dbTableName]
                )
            );
    }
}