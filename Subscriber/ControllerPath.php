<?php

namespace Shopware\SwagDefaultSort\Subscriber;

class ControllerPath implements \Enlight\Event\SubscriberInterface
{
    /**
     * @var \Shopware_Plugins_Frontend_SwagDefaultSort_Bootstrap
     */
    protected $bootstrap;

    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Dispatcher_ControllerPath_Backend_SwagDefaultSort' => 'onGetControllerPathBackend',
            'Enlight_Controller_Dispatcher_ControllerPath_Backend_SwagDefaultSortCategory' => 'onGetControllerPathBackend',
        ];
    }

    public function __construct(\Shopware_Plugins_Frontend_SwagDefaultSort_Bootstrap $bootstrap)
    {
        $this->bootstrap = $bootstrap;
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
        $this->bootstrap->registerMyTemplateDir();
        $this->bootstrap->registerMySnippets();

        $controllerName = Shopware()->Front()->Request()->getControllerName();

        $path = $this->bootstrap->Path() . 'Controllers/Backend/' . $controllerName . '.php';

        return $path;
    }
}