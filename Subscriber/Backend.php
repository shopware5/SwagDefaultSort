<?php

namespace Shopware\SwagDefaultSort\Subscriber;

use Shopware\SwagdefaultSort\Components\RegistrationService;

class Backend implements \Enlight\Event\SubscriberInterface
{
    /**
     * @var RegistrationService
     */
    protected $registrationService;

    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Dispatcher_ControllerPath_Backend_SwagDefaultSort' => 'onGetControllerPathBackend',
            'Enlight_Controller_Dispatcher_ControllerPath_Backend_SwagDefaultSortCategory' => 'onGetControllerPathBackend',
        ];
    }

    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    /**
     * Register the backend controller
     *
     * @param   \Enlight_Event_EventArgs $args
     * @return  string
     * @Enlight\Event Enlight_Controller_Dispatcher_ControllerPath_Backend_SwagDefaultSort
     * @todo remove injection security bug
     */
    public function onGetControllerPathBackend(\Enlight_Event_EventArgs $args)
    {
        $this->registrationService->registerTemplateDir();
        $this->registrationService->registerSnippets();

        $controllerName = Shopware()->Front()->Request()->getControllerName();

        return $this->registrationService->getPluginPath() .
            '/Controllers/Backend/' .
            $controllerName .
            '.php';
    }
}