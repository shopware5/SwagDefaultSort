<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\SwagDefaultSort\Subscriber;

use Enlight\Event\SubscriberInterface;
use Shopware\Components\DependencyInjection\Container;
use Shopware\SwagDefaultSort\Bundle\SearchBundle\DefaultSortRequestHandler;
use Shopware\SwagDefaultSort\Bundle\SearchBundleDBAL\SortingHandler\DefaultSortingHandler;
use Shopware\SwagDefaultSort\Components\RegistrationService;

class Frontend implements SubscriberInterface
{
    /**
     * @var DefaultSortRequestHandler|null
     */
    private $sortRequestHandler;

    /**
     * @var Container
     */
    private $container;

    /**
     * @var RegistrationService
     */
    private $registrationService;

    /**
     * @param Container           $container
     * @param RegistrationService $registrationService
     */
    public function __construct(Container $container, RegistrationService $registrationService)
    {
        $this->container = $container;
        $this->registrationService = $registrationService;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Action_PreDispatch' => 'onPreDispatchSecure',
            'Shopware_SearchBundle_Collect_Criteria_Request_Handlers' => 'onRequestHandlerCollect',
            'Shopware_SearchBundleDBAL_Collect_Sorting_Handlers' => 'onSortingHandlerCollect',
            'Enlight_Controller_Action_PostDispatchSecure_Frontend_Listing' => 'registerView',
        ];
    }
    
    /**
     * Registers the template directory on each Secure dispatch to prevent SmartySecurity errors
     */
    public function onPreDispatchSecure()
    {
        Shopware()->Template()->addTemplateDir(__DIR__ . '/Views/');
    }

    /**
     * @return DefaultSortRequestHandler
     */
    public function onRequestHandlerCollect()
    {
        return $this->getSortRequestHandler();
    }

    /**
     * @return DefaultSortingHandler
     */
    public function onSortingHandlerCollect()
    {
        return new DefaultSortingHandler(
            $this->container->get('swag_default_sort.query_extension_gateway')
        );
    }

    public function registerView()
    {
        if (!$this->getSortRequestHandler()->isEnabled()) {
            return;
        }

        $this->registrationService->registerSnippets();
    }

    /**
     * @return DefaultSortRequestHandler
     */
    private function getSortRequestHandler()
    {
        if (!$this->sortRequestHandler) {
            $this->sortRequestHandler = new DefaultSortRequestHandler(
                $this->container->get('swag_default_sort.database_adapter'),
                $this->container->get('swag_default_sort.rule_vo_hydrator')
            );
        }

        return $this->sortRequestHandler;
    }
}
