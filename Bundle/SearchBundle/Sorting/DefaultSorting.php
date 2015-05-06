<?php


namespace Shopware\SwagDefaultSort\Bundle\SearchBundle\Sorting;

use Shopware\Bundle\SearchBundle\SortingInterface;
use Shopware\SwagDefaultSort\Components\DataAccess\RuleVo;

/**
 * Class DefaultSorting
 *
 * Triggers sorting
 *
 * @package Shopware\SwagDefaultSort\Bundle\SearchBundle\Sorting
 */
class DefaultSorting implements SortingInterface
{

    /**
     * @var RuleVo[]
     */
    private $rules;

    /**
     * @param RuleVo[] $rules
     */
    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'swag-default-sort-default-sorting';
    }

    /**
     * @return RuleVo[]
     */
    public function getRules()
    {
        return $this->rules;
    }
}