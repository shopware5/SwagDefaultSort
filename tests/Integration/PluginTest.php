<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\SwagDefaultSort\Test\Integration;

class PluginTest extends \Shopware\Components\Test\Plugin\TestCase
{
    protected static $ensureLoadedPlugins = [
        'SwagDefaultSort' => [
        ],
    ];

    public function testCanCreateInstance()
    {
        /** @var Shopware_Plugins_Frontend_SwagDefaultSort_Bootstrap $plugin */
        $plugin = Shopware()->Plugins()->Frontend()->SwagDefaultSort();

        $this->assertInstanceOf('Shopware_Plugins_Frontend_SwagDefaultSort_Bootstrap', $plugin);
    }
}
