<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\SwagDefaultSort\Bundle\SearchBundleDBAL\SortingHandler;

use Shopware\Bundle\SearchBundle\SortingInterface;
use Shopware\Bundle\SearchBundleDBAL\QueryBuilder;
use Shopware\Bundle\SearchBundleDBAL\SortingHandlerInterface;
use Shopware\Bundle\StoreFrontBundle\Struct\ShopContextInterface;
use Shopware\SwagDefaultSort\Bundle\SearchBundle\Sorting\DefaultSorting;
use Shopware\SwagDefaultSort\Components\DataAccess\RuleVo;
use Shopware\SwagDefaultSort\Components\QueryExtender\QueryExtensionGateway;

/**
 * Class DefaultSortingHandler.
 *
 * Handles query extension
 */
class DefaultSortingHandler implements SortingHandlerInterface
{
    /**
     * @var QueryExtensionGateway
     */
    private $gateway;

    /**
     * @param QueryExtensionGateway $gateway
     */
    public function __construct(QueryExtensionGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsSorting(SortingInterface $sorting)
    {
        return $sorting instanceof DefaultSorting;
    }

    /**
     * {@inheritdoc}
     */
    public function generateSorting(
        SortingInterface $sorting,
        QueryBuilder $query,
        ShopContextInterface $context
    ) {
        /** @var RuleVo[] $rules */
        $rules = $sorting->getRules();

        foreach ($rules as $rule) {
            $this->gateway->addRule(
                $rule,
                $query
            );
        }
        $query->addOrderBy('product.id');
    }
}
