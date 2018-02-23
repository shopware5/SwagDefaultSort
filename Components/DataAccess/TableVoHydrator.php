<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\SwagDefaultSort\Components\DataAccess;

use Shopware\SwagDefaultSort\Components\DataAccess\Translate\TranslateFilterChain;

/**
 * Class TableHydrator.
 *
 * TableVO factory
 */
class TableVoHydrator
{
    const SNIPPET_NAMESPACE = 'backend/swagdefaultsort/tables';

    /**
     * @var TranslateFilterChain
     */
    private $translateFilter;

    /**
     * @param TranslateFilterChain $translateFilter
     */
    public function __construct(TranslateFilterChain $translateFilter)
    {
        $this->translateFilter = $translateFilter;
    }

    /**
     * @param array $tableNames
     *
     * @return TableVo[]
     */
    public function createTableVos(array $tableNames)
    {
        $ret = [];

        foreach ($tableNames as $tableName) {
            $ret[] = $this->createTableVo($tableName);
        }

        return $ret;
    }

    /**
     * @param $tableName
     *
     * @return TableVo
     */
    public function createTableVo($tableName)
    {
        return new TableVo($tableName, $this->translateFilter);
    }
}
