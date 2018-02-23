<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\SwagDefaultSort\Bundle\SearchBundle;

use Enlight_Controller_Request_RequestHttp as Request;
use Shopware\Bundle\SearchBundle\Criteria;
use Shopware\Bundle\SearchBundle\CriteriaRequestHandlerInterface;
use Shopware\Bundle\StoreFrontBundle\Struct\ShopContextInterface;
use Shopware\SwagDefaultSort\Bundle\SearchBundle\Sorting\DefaultSorting;
use Shopware\SwagDefaultSort\Components\DataAccess\DatabaseAdapter;
use Shopware\SwagDefaultSort\Components\DataAccess\RuleHydrator;

/**
 * Class DefaultSortRequestHandler.
 *
 * Main entry point Search bundle
 */
class DefaultSortRequestHandler implements CriteriaRequestHandlerInterface
{
    const REQUEST_VALUE = 'swag_default_sort';

    private $enabled = false;

    /**
     * @var DatabaseAdapter
     */
    private $databaseAdapter;

    /**
     * @var RuleHydrator
     */
    private $ruleHydrator;

    /**
     * @param DatabaseAdapter $databaseAdapater
     * @param RuleHydrator    $ruleHydrator
     */
    public function __construct(
        DatabaseAdapter $databaseAdapater,
        RuleHydrator $ruleHydrator
    ) {
        $this->databaseAdapter = $databaseAdapater;
        $this->ruleHydrator = $ruleHydrator;
    }

    /**
     * @param Request              $request
     * @param Criteria             $criteria
     * @param ShopContextInterface $context
     */
    public function handleRequest(
        Request $request,
        Criteria $criteria,
        ShopContextInterface $context
    ) {
        $requestedCategoryId = $request->getParam('sCategory',
            $request->getParam('categoryId', false)
        );

        if (!$requestedCategoryId) {
            return;
        }

        $closestIdWithRules = $this->databaseAdapter
            ->fetchClosestCategoryIdWithRule($requestedCategoryId);

        if (!$closestIdWithRules) {
            return;
        }

        $this->enabled = true;

        $sSort = $request->getParam('sSort');
        if ($sSort && $sSort !== self::REQUEST_VALUE) {
            return;
        }

        $request->setParam('sSort', self::REQUEST_VALUE);

        $rules = $this->ruleHydrator->createRuleVos(
            $this->databaseAdapter->fetchRawData($closestIdWithRules)
        );

        $criteria->resetSorting();
        $criteria->addSorting(new DefaultSorting($rules));
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }
}
