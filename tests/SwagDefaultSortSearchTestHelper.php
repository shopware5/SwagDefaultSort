<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require __DIR__ . '/../../../../../../../tests/Functional/bootstrap.php';

class SwagDefaultSortSearchTestHelper extends TestKernel
{
    public static function start()
    {
        parent::start();

        self::initPluginNamespaces();
        self::initTestNamespace();
        self::initServiceContainerSubscriber();
    }

    private static function initPluginNamespaces()
    {
        Shopware()->Loader()->registerNamespace(
            'Shopware\\SwagDefaultSort\\Components',
            self::getPluginRoot() . '/Components/'
        );
        Shopware()->Loader()->registerNamespace(
            'Shopware\\SwagDefaultSort\\Subscriber',
            self::getPluginRoot() . '/Subscriber/'
        );
        Shopware()->Loader()->registerNamespace(
            'Shopware\\SwagDefaultSort\\Bundle',
            self::getPluginRoot() . '/Bundle/'
        );
    }

    private static function initTestNamespace()
    {
        Shopware()->Loader()->registerNamespace('Shopware\\SwagDefaultSort\\Test', __DIR__ . '/');
    }

    /**
     * @return string
     */
    private static function getPluginRoot()
    {
        return __DIR__ . '/..';
    }

    private static function initServiceContainerSubscriber()
    {
        Shopware()->Events()->addSubscriber(
            new \Shopware\SwagDefaultSort\Subscriber\ServiceContainer(Shopware()->Container())
        );
    }
}

SwagDefaultSortSearchTestHelper::start();
