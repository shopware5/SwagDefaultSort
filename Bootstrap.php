<?php
/*
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

/**
 * {@inheritdoc}
 */
class Shopware_Plugins_Frontend_SwagDefaultSort_Bootstrap extends Shopware_Components_Plugin_Bootstrap
{
    const MENU_ITEM_IDENTIFIER = 'SwagDefaultSort';

    /**
     * @return mixed
     *
     * @throws Exception
     */
    public function getVersion()
    {
        $info = json_decode(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'plugin.json'), true);
        if ($info) {
            return $info['currentVersion'];
        } else {
            throw new Exception('The plugin has an invalid version file.');
        }
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return 'Standard Kategorie Sortierung';
    }

    /**
     * @return bool
     */
    public function uninstall()
    {
        $this->registerCustomModels();

        /** @var \Shopware\Components\Model\ModelManager $em */
        $em = $this->get('models');
        $tool = new \Doctrine\ORM\Tools\SchemaTool($em);

        $classes = array(
            $em->getClassMetadata('Shopware\CustomModels\SwagDefaultSort\Rule'),
        );
        $tool->dropSchema($classes);

        return true;
    }

    /**
     * @return bool
     */
    public function secureUninstall()
    {
        try {
            $this->storeMenuState(false);
        } catch (BadMethodCallException $e) {
        }

        return true;
    }

    /**
     * Returns capabilities.
     */
    public function getCapabilities()
    {
        return [
            'install' => true,
            'update' => true,
            'enable' => true,
            'secureUninstall' => true,
        ];
    }

    public function getInfo()
    {
        return [
            'version' => $this->getVersion(),
            'label' => $this->getLabel(),
            'description' => 'Change article listing sorting for certain categories',
            'supplier' => 'shopware AG',
            'support' => 'Shopware Forum',
            'link' => 'http://www.shopware.com',
        ];
    }

    public function update($oldVersion)
    {
        return true;
    }

    public function install()
    {
        if (!$this->assertMinimumVersion('5.0.0')) {
            throw new \RuntimeException('At least Shopware 5.0.0 is required');
        }

        $this->createMenuItem(
            [
                'label' => self::MENU_ITEM_IDENTIFIER,
                'controller' => 'SwagDefaultSort',
                'class' => 'sprite-sort',
                'action' => 'Index',
                'active' => 0,
                'position' => -3,
                'parent' => $this->Menu()->findOneBy(['label' => 'Einstellungen']),
            ]
        );

        $this->subscribeEvent(
            'Enlight_Controller_Front_DispatchLoopStartup',
            'onStartDispatch'
        );

        $this->Config()->isDirty();

        $this->updateSchema();

        return [
            'success' => true,
            'invalidateCache' => ['frontend', 'backend'],
        ];
    }

    public function enable()
    {
        try {
            $this->storeMenuState(true);
        } catch (BadMethodCallException $e) {
            return false;
        }

        return true;
    }

    public function disable()
    {
        try {
            $this->storeMenuState(false);
        } catch (BadMethodCallException $e) {
            return false;
        }

        return true;
    }

    private function storeMenuState($isActive)
    {
        $menuItem = $this->Menu()->findOneBy(['label' => self::MENU_ITEM_IDENTIFIER]);

        if (!$menuItem) {
            throw new BadMethodCallException('Unable to set Menu state - no item found');
        }

        $menuItem->setActive((bool) $isActive);

        $this->getEntityManager()->persist($menuItem);
        $this->getEntityManager()->flush();
    }

    /**
     * Creates the database scheme from an existing doctrine model.
     *
     * Will remove the table first, so handle with care.
     */
    protected function updateSchema()
    {
        $this->registerCustomModels();

        /** @var \Shopware\Components\Model\ModelManager $em */
        $em = $this->get('models');
        $tool = new \Doctrine\ORM\Tools\SchemaTool($em);

        $classes = array(
            $em->getClassMetadata('Shopware\CustomModels\SwagDefaultSort\Rule'),
        );

        try {
            $tool->dropSchema($classes);
        } catch (Exception $e) {
            //ignore
        }
        $tool->createSchema($classes);
    }

    /**
     * This callback function is triggered at the very beginning of the dispatch process and allows
     * us to register additional events on the fly. This way you won't ever need to reinstall you
     * plugin for new events - any event and hook can simply be registerend in the event subscribers.
     */
    public function onStartDispatch()
    {
        $this->registerCustomModels();
        $this->registerPluginNamespace();

        $registrationService = new \Shopware\SwagDefaultSort\Components\RegistrationService();
        $subscribers = [
            new \Shopware\SwagDefaultSort\Subscriber\ServiceContainer(Shopware()->Container()),
            new \Shopware\SwagDefaultSort\Subscriber\Frontend(Shopware()->Container(), $registrationService),
            new \Shopware\SwagDefaultSort\Subscriber\Backend($registrationService),
        ];

        foreach ($subscribers as $subscriber) {
            $this->Application()->Events()->addSubscriber($subscriber);
        }
    }

    /**
     * Register namespaces.
     */
    private function registerPluginNamespace()
    {
        Shopware()->Loader()->registerNamespace(
            'Shopware\SwagDefaultSort',
            $this->Path()
        );
    }

    /**
     * @return \Shopware\Components\Model\ModelManager
     */
    private function getEntityManager()
    {
        return Shopware()->Models();
    }
}
