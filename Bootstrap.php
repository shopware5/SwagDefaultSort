<?php

/**
 * The Bootstrap class is the main entry point of any shopware plugin.
 *
 * Short function reference
 * - install: Called a single time during (re)installation. Here you can trigger install-time actions like
 *   - creating the menu
 *   - creating attributes
 *   - creating database tables
 *   You need to return "true" or array('success' => true, 'invalidateCache' => array()) in order to let the installation
 *   be successfull
 *
 * - update: Triggered when the user updates the plugin. You will get passes the former version of the plugin as param
 *   In order to let the update be successful, return "true"
 *
 * - uninstall: Triggered when the plugin is reinstalled or uninstalled. Clean up your tables here.
 */
class Shopware_Plugins_Frontend_SwagDefaultSort_Bootstrap extends Shopware_Components_Plugin_Bootstrap
{
    /**
     * @return mixed
     * @throws Exception
     */
    public function getVersion() {
        $info = json_decode(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR .'plugin.json'), true);
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
        return 'Kategorie Sortierung';
    }

    /**
     * @return bool
     */
    public function uninstall()
    {
        $this->registerCustomModels();

        $em = $this->Application()->Models();
        $tool = new \Doctrine\ORM\Tools\SchemaTool($em);

        $classes = array(
            $em->getClassMetadata('Shopware\CustomModels\SwagDefaultSort\Rule')
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
        } catch(BadMethodCallException $e) {
            return false;
        }

        return true;
    }


    /**
     * Returns capabilities
     */
    public function getCapabilities()
    {
        return [
            'install' => true,
            'update' => true,
            'enable' => true,
            'secureUninstall' => true
        ];
    }

    public function getInfo() {
        return [
            'version' => $this->getVersion(),
            'label' => $this->getLabel(),
            'description' => 'Change article listing sorting for certain categories',
            'supplier' => 'shopware AG',
            'support' => 'Shopware Forum',
            'link' => 'http://www.shopware.com'
        ];
    }

    public function update($oldVersion)
    {
        return true;
    }

    public function install()
    {
        if (!$this->assertVersionGreaterThen('5.0.0')) {
            throw new \RuntimeException('At least Shopware 5.0.0 is required');
        }


        $this->createMenuItem(array(
            'label' => 'Kategorie Sortierung',
            'controller' => 'SwagDefaultSort',
            'class' => 'sprite-sort',
            'action' => 'Index',
            'active' => 0,
            'position' => -3,
            'parent' => $this->Menu()->findOneBy('label', 'Einstellungen')
        ));

        $this->subscribeEvent(
            'Enlight_Controller_Front_DispatchLoopStartup',
            'onStartDispatch'
        );

        $this->Config()->isDirty();

        $this->updateSchema();

        return array('success' => true, 'invalidateCache' => array('frontend', 'backend'));
    }

    public function enable() {
        try {
            $this->storeMenuState(true);
        } catch(BadMethodCallException $e) {
            return false;
        }

        return true;
    }

    public function disable() {
        try{
            $this->storeMenuState(false);
        } catch(BadMethodCallException $e) {
            return false;
        }


        return true;
    }

    private function storeMenuState($isActive) {
        $menuItem = $this->Menu()->findOneBy('label', 'Kategorie Sortierung');

        if(!$menuItem) {
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

        $em = $this->Application()->Models();
        $tool = new \Doctrine\ORM\Tools\SchemaTool($em);

        $classes = array(
            $em->getClassMetadata('Shopware\CustomModels\SwagDefaultSort\Rule')
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
     * plugin for new events - any event and hook can simply be registerend in the event subscribers
     */
    public function onStartDispatch(Enlight_Event_EventArgs $args)
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
     * Register namespaces
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
    private function getEntityManager() {
        return Shopware()->Models();
    }
}