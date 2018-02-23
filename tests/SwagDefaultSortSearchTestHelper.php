<?php
/*
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

require __DIR__.'/../../../../../../../tests/Shopware/TestHelper.php';

class SwagDefaultSortSearchTestHelper
{
    /**
     * @var Shopware
     */
    private $helper;

    public function __construct()
    {
        $this->helper = \TestHelper::Instance();
        $this->initPluginNamespaces();
        $this->initTestNamespace();
        $this->initServiceContainerSubscriber();
    }

    private function initPluginNamespaces()
    {
        $this->helper->Loader()->registerNamespace(
            'Shopware\\SwagDefaultSort\\Components',
            $this->getPluginRoot().'/Components/'
        );
        $this->helper->Loader()->registerNamespace(
            'Shopware\\SwagDefaultSort\\Subscriber',
            $this->getPluginRoot().'/Subscriber/'
        );
        $this->helper->Loader()->registerNamespace(
            'Shopware\\SwagDefaultSort\\Bundle',
            $this->getPluginRoot().'/Bundle/'
        );
    }

    private function initTestNamespace()
    {
        $this->helper->Loader()->registerNamespace(
            'Shopware\\SwagDefaultSort\\Test',
            __DIR__.'/'
        );
    }

    private function getPluginRoot()
    {
        return  $pluginDir = __DIR__.'/..';
    }

    private function initServiceContainerSubscriber()
    {
        Shopware()->Events()->addSubscriber(
            new \Shopware\SwagDefaultSort\Subscriber\ServiceContainer(Shopware()->Container())
        );
    }
}

new SwagDefaultSortSearchTestHelper();
