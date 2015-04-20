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
        return array(
                        'Enlight_Controller_Dispatcher_ControllerPath_Backend_SwagDefaultSort' => 'onGetControllerPathBackend',            'Enlight_Controller_Dispatcher_ControllerPath_Frontend_SwagDefaultSort' => 'onGetControllerPathFrontend',            'Enlight_Controller_Dispatcher_ControllerPath_Api_Rule' => 'getApiControllerRule'        );
    }

    public function __construct(\Shopware_Plugins_Frontend_SwagDefaultSort_Bootstrap $bootstrap)
    {
        $this->bootstrap = $bootstrap;
    }

    public function getApiControllerRule(\Enlight_Event_EventArgs $args)
    {
        $this->bootstrap->registerCustomModels();

        return $this->bootstrap->Path() . 'Controllers/Api/Rule.php';
    }

    /**
     * Register the backend controller
     *
     * @param   \Enlight_Event_EventArgs $args
     * @return  string
     * @Enlight\Event Enlight_Controller_Dispatcher_ControllerPath_Backend_SwagDefaultSort     */
    public function onGetControllerPathBackend(\Enlight_Event_EventArgs $args)
    {
        $this->bootstrap->registerMyTemplateDir();
        $this->bootstrap->registerMySnippets();

        return $this->bootstrap->Path() . 'Controllers/Backend/SwagDefaultSort.php';
    }


    /**
     * Register the frontend controller
     *
     * @param   \Enlight_Event_EventArgs $args
     * @return  string
     * @Enlight\Event Enlight_Controller_Dispatcher_ControllerPath_Frontend_SwagDefaultSort     */
    public function onGetControllerPathFrontend(\Enlight_Event_EventArgs $args)
    {
        $this->bootstrap->registerMyTemplateDir();
        $this->bootstrap->registerMySnippets();

        return $this->bootstrap->Path() . 'Controllers/Frontend/SwagDefaultSort.php';
    }
}