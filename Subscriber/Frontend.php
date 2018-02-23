<?php
/*
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
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

    public function __construct(Container $container, RegistrationService $registrationService)
    {
        $this->container = $container;
        $this->registrationService = $registrationService;
    }

    public static function getSubscribedEvents()
    {
        return [
            'Shopware_SearchBundle_Collect_Criteria_Request_Handlers' => 'onRequestHandlerCollect',
            'Shopware_SearchBundleDBAL_Collect_Sorting_Handlers' => 'onSortingHandlerCollect',
            'Enlight_Controller_Action_PostDispatchSecure_Frontend_Listing' => 'registerView',
        ];
    }

    public function onRequestHandlerCollect(\Enlight_Event_EventArgs $args)
    {
        return $this->getSortRequestHandler();
    }

    public function onSortingHandlerCollect(\Enlight_Event_EventArgs $args)
    {
        return new DefaultSortingHandler(
            $this->container->get('swag_default_sort.query_extension_gateway')
        );
    }

    public function registerView(\Enlight_Event_EventArgs $args)
    {
        if (!$this->getSortRequestHandler()->isEnabled()) {
            return;
        }

        $this->registrationService->registerSnippets();
        $this->registrationService->registerTemplateDir();
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
