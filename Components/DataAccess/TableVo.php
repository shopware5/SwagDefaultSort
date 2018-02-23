<?php
/*
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Shopware\SwagDefaultSort\Components\DataAccess;

use JsonSerializable;
use Shopware\SwagDefaultSort\Components\DataAccess\Translate\TranslateFilterChain;

/**
 * Class TableVo.
 *
 * ValueObject containing the different table names and translations
 */
class TableVo implements JsonSerializable
{
    /**
     * @var string
     */
    private $tableName;

    /**
     * @var TranslateFilter
     */
    private $filter;

    public function __construct($tableName, TranslateFilterChain $filter)
    {
        $this->tableName = $tableName;
        $this->filter = $filter;
    }

    /**
     * @return mixed
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * @return mixed
     */
    public function getTranslation()
    {
        return $this->filter->filter($this->getTableName());
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
            'tableName' => $this->getTableName(),
            'translation' => $this->getTranslation(),
        ];
    }
}
