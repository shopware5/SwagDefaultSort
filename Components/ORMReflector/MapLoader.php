<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\SwagDefaultSort\Components\ORMReflector;

/**
 * Class MapLoader.
 *
 * Performance-Tuning load metadata via a static table <-> entity mapping
 */
class MapLoader extends LoaderAbstract
{
    const MAIN_SW_MODEL_NAMEAPSCE_PREFIX = 'Shopware\Models';

    /**
     * @var string[]
     */
    private $map = [
        's_articles_details' => 'Article\Detail',
        's_articles' => 'Article\Article',
        's_articles_attributes' => 'Attribute\Article',
    ];

    /**
     * @param string $dbTableName
     *
     * @return InflectorResult|null
     */
    public function load($dbTableName)
    {
        if (!isset($this->map[$dbTableName])) {
            return;
        }

        return $this
            ->createInflectorResult(
                $this->entityManager->getMetadataFactory()->getMetadataFor(
                    self::MAIN_SW_MODEL_NAMEAPSCE_PREFIX . '\\' . $this->map[$dbTableName]
                )
            );
    }
}
