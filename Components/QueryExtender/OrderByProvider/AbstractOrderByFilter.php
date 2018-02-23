<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\SwagDefaultSort\Components\QueryExtender\OrderByProvider;

use Shopware\SwagDefaultSort\Components\DataAccess\RuleVo;
use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;

/**
 * Class AbstractOrderByFilter.
 *
 * Filter the actual sort name, based on definition classes
 */
abstract class AbstractOrderByFilter
{
    /**
     * @var string
     */
    private $alias;

    /**
     * @var AbstractSortDefinition
     */
    private $definition;

    /**
     * @var RuleVo
     */
    private $rule;

    /**
     * @param string                 $alias
     * @param AbstractSortDefinition $definition
     * @param RuleVo                 $rule
     */
    public function setUp(
        $alias,
        AbstractSortDefinition $definition,
        RuleVo $rule
    ) {
        $this->alias = $alias;
        $this->definition = $definition;
        $this->rule = $rule;
    }

    /**
     * @param string $currentValue
     *
     * @return string filtered value
     */
    abstract public function filterSort($currentValue);

    /**
     * @param string $currentValue
     *
     * @return string filtered value
     */
    abstract public function filterOrder($currentValue);

    /**
     * @return string
     */
    protected function getAlias()
    {
        if (!$this->alias) {
            throw new \BadMethodCallException('missing property $alias');
        }

        return $this->alias;
    }

    /**
     * @return AbstractSortDefinition
     */
    protected function getDefinition()
    {
        if (!$this->definition) {
            throw new \BadMethodCallException('missing property $definition');
        }

        return $this->definition;
    }

    /**
     * @return RuleVo
     */
    protected function getRule()
    {
        if (!$this->rule) {
            throw new \BadMethodCallException('missing property $rule');
        }

        return $this->rule;
    }
}
