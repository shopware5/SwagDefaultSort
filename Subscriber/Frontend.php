<?php

namespace Shopware\SwagDefaultSort\Subscriber;

class Frontend implements \Enlight\Event\SubscriberInterface
{
    /**
     * @var \Shopware_Plugins_Frontend_SwagDefaultSort_Bootstrap
     */
    protected $bootstrap;

    public static function getSubscribedEvents()
    {
        return array(
            'Enlight_Controller_Action_PostDispatchSecure_Frontend' => 'onFrontendPostDispatch'
        );
    }

    public function onFrontendPostDispatch(\Enlight_Event_EventArgs $args)
    {
        /** @var $controller \Enlight_Controller_Action */
        $controller = $args->getSubject();
        $view = $controller->View();



    }
}