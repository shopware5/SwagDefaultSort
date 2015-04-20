<?php

class PluginTest extends Shopware\Components\Test\Plugin\TestCase
{
    protected static $ensureLoadedPlugins = array(
        'SwagDefaultSort' => array(
        )
    );

    public function setUp()
    {
        parent::setUp();

        $helper = \TestHelper::Instance();
        $loader = $helper->Loader();


        $pluginDir = getcwd() . '/../';

        $loader->registerNamespace(
            'Shopware\\SwagDefaultSort',
            $pluginDir
        );
    }

    public function testCanCreateInstance()
    {
        /** @var Shopware_Plugins_Frontend_SwagDefaultSort_Bootstrap $plugin */
        $plugin = Shopware()->Plugins()->Frontend()->SwagDefaultSort();

        $this->assertInstanceOf('Shopware_Plugins_Frontend_SwagDefaultSort_Bootstrap', $plugin);
    }
}