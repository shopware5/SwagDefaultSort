<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\SwagDefaultSort\Subscriber;

use Enlight\Event\SubscriberInterface;
use Shopware\SwagDefaultSort\Components\RegistrationService;

class Backend implements SubscriberInterface
{
    /**
     * @var RegistrationService
     */
    protected $registrationService;

    /**
     * @param RegistrationService $registrationService
     */
    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Dispatcher_ControllerPath_Backend_SwagDefaultSort' => 'onGetControllerPathBackend',
            'Enlight_Controller_Dispatcher_ControllerPath_Backend_SwagDefaultSortCategory' => 'onGetControllerCategoryPathBackend',
        ];
    }

    /**
     * Register the backend controller.
     *
     * @param \Enlight_Event_EventArgs $args
     *
     * @return string
     * @Enlight\Event Enlight_Controller_Dispatcher_ControllerPath_Backend_SwagDefaultSort
     */
    public function onGetControllerPathBackend()
    {
        $this->registrationService->registerTemplateDir();
        $this->registrationService->registerSnippets();

        return $this->registrationService->getBackendControllerPath('SwagDefaultSort');
    }

    /**
     * @param \Enlight_Event_EventArgs $args
     *
     * @return string
     * @Enlight\Event Enlight_Controller_Dispatcher_ControllerPath_Backend_SwagDefaultSortCategory
     */
    public function onGetControllerCategoryPathBackend()
    {
        $this->registrationService->registerTemplateDir();
        $this->registrationService->registerSnippets();

        return $this->registrationService->getBackendControllerPath('SwagDefaultSortCategory');
    }
}
