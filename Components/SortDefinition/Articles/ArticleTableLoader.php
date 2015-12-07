<?php
/*
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Shopware\SwagDefaultSort\Components\SortDefinition\Articles;

use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractGenericTableLoader;
use Shopware\SwagDefaultSort\Components\SortDefinition\TranslateTableInterface;

class ArticleTableLoader extends AbstractGenericTableLoader implements TranslateTableInterface
{
    /**
     * @return string
     */
    public function getTableName()
    {
        return 's_articles';
    }

    /**
     * @return array mapped field names
     */
    public function getMappedFieldNames()
    {
        return [
            'name',
            'pseudosales',
            'changetime',
            'datum',
            'topseller',
        ];
    }

    /**
     * @return string
     */
    public function getSnippetNamespace()
    {
        return 'backend/article_list/main';
    }

    /**
     * @return mixed
     */
    public function getSnippetPrefix()
    {
        return 'columns/product/Article_';
    }
}
