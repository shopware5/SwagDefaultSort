<?php

/**
 * Frontend controller.
 */
class Shopware_Controllers_Frontend_SwagDefaultSort extends Enlight_Controller_Action
{
    public function indexAction()
    {
        // Assign a template variable
        $this->View()->assign('name', 'SwagDefaultSort');
    }
}
