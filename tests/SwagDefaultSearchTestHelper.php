<?php

require __DIR__ . '/../../../../../../../tests/Shopware/TestHelper.php';

class SwagDefaultSearchTestHelper {

    /**
     * @var Shopware
     */
    private $helper;

    public function __construct() {
        $this->helper = \TestHelper::Instance();
        $this->initPluginComponentsNamespace();
        $this->initTestNamespace();
    }

    private function initPluginComponentsNamespace() {
        $this->helper->Loader()->registerNamespace(
            'Shopware\\SwagDefaultSort\\Components',
            $this->getPluginRoot() . '/Components/'
        );
    }

    private function initTestNamespace() {
        $this->helper->Loader()->registerNamespace(
            'Shopware\\SwagDefaultSort\\Test',
            __DIR__ . '/'
        );
    }

    private function getPluginRoot() {
        return  $pluginDir = __DIR__ . '/..';
    }
}

new SwagDefaultSearchTestHelper();