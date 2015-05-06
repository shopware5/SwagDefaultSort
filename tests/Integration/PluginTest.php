<?php

namespace Shopware\SwagDefaultSort\Test\Integration;

class PluginTest extends \Shopware\Components\Test\Plugin\TestCase
{
    protected static $ensureLoadedPlugins = array(
        'SwagDefaultSort' => array(
        ),
    );

    public function testCanCreateInstance()
    {
        /** @var Shopware_Plugins_Frontend_SwagDefaultSort_Bootstrap $plugin */
        $plugin = Shopware()->Plugins()->Frontend()->SwagDefaultSort();

        $this->assertInstanceOf('Shopware_Plugins_Frontend_SwagDefaultSort_Bootstrap', $plugin);
    }
}
