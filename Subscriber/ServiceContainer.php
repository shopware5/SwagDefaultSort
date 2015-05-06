<?php

namespace Shopware\SwagDefaultSort\Subscriber;

use Enlight\Event\SubscriberInterface;
use Shopware\SwagDefaultSort\Components\DataAccess\FieldVo;
use Shopware\SwagDefaultSort\Components\DataAccess\TableVo;
use Shopware\SwagDefaultSort\Components\ORMReflector\ORMReflector;
use Shopware\SwagDefaultSort\Components\QueryExtender\JoinProviderCollection;
use Shopware\SwagDefaultSort\Components\QueryExtender\OrderByProvider\OrderByFilterChain;
use Shopware\SwagDefaultSort\Components\QueryExtender\QueryExtensionGateway;
use Shopware\SwagDefaultSort\Components\SortDefinition\DefinitionCollection;
use Shopware\SwagDefaultSort\Components\DataAccess\DatabaseAdapter;
use Shopware\SwagDefaultSort\Components\DataAccess\FieldVoHydrator;
use Shopware\SwagDefaultSort\Components\DataAccess\RuleHydrator;
use Shopware\SwagDefaultSort\Components\DataAccess\TableVoHydrator;
use Symfony\Component\DependencyInjection\Container;

/**
 * Class ServiceContainer.
 *
 * Contains all service definitions of this plugin
 */
class ServiceContainer implements SubscriberInterface
{
    /**
     * @var Container
     */
    private $container;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Bootstrap_InitResource_swag_default_sort.definition_collection' => 'createDefinitionCollection',
            'Enlight_Bootstrap_InitResource_swag_default_sort.orm_inflector' => 'createOrmInflector',
            'Enlight_Bootstrap_InitResource_swag_default_sort.database_adapter' => 'createDatabaseAdapter',
            'Enlight_Bootstrap_InitResource_swag_default_sort.rule_vo_hydrator' => 'createRuleHydrator',
            'Enlight_Bootstrap_InitResource_swag_default_sort.table_vo_hydrator' => 'createTableVoHydrator',
            'Enlight_Bootstrap_InitResource_swag_default_sort.field_vo_hydrator' => 'createFieldVoHydrator',
            'Enlight_Bootstrap_InitResource_swag_default_sort.table_vo_collection' => 'createTableVos',
            'Enlight_Bootstrap_InitResource_swag_default_sort.field_vo_collection' => 'createFieldVos',
            'Enlight_Bootstrap_InitResource_swag_default_sort.query_extender_order_by_filter_chain' => 'createOrderByFilterChain',
            'Enlight_Bootstrap_InitResource_swag_default_sort.query_extender_join_provider_collection' => 'createJoinProvider',
            'Enlight_Bootstrap_InitResource_swag_default_sort.query_extension_gateway' => 'createQueryExtensionGateway',
        ];
    }

    /**
     * @return DefinitionCollection
     */
    public function createDefinitionCollection()
    {
        return new DefinitionCollection();
    }

    /**
     * @return ORMReflector
     */
    public function createOrmInflector()
    {
        return new ORMReflector(Shopware()->Models());
    }

    /**
     * @return TableVoHydrator
     */
    public function createTableVoHydrator()
    {
        return new TableVoHydrator(Shopware()->Snippets());
    }

    /**
     * @return TableVo[]
     */
    public function createTableVos()
    {
        return $this->container->get('swag_default_sort.table_vo_hydrator')->createTableVos(
            $this->container->get('swag_default_sort.definition_collection')->getTableNames()
        );
    }

    /**
     * @return FieldVoHydrator
     */
    public function createFieldVoHydrator()
    {
        return new FieldVoHydrator(Shopware()->Snippets());
    }

    /**
     * @return FieldVo[]
     */
    public function createFieldVos()
    {
        return $this->container->get('swag_default_sort.field_vo_hydrator')->createFieldVos(
            $this->container->get('swag_default_sort.definition_collection')
        );
    }

    /**
     * @return OrderByFilterChain
     */
    public function createOrderByFilterChain()
    {
        return new OrderByFilterChain();
    }

    /**
     * @return JoinProviderCollection
     */
    public function createJoinProvider()
    {
        return new JoinProviderCollection();
    }

    /**
     * @return DatabaseAdapter
     */
    public function createDatabaseAdapter()
    {
        return new DatabaseAdapter(
            $this->container->get('dbal_connection')
        );
    }

    /**
     * @return RuleHydrator
     */
    public function createRuleHydrator()
    {
        return new RuleHydrator();
    }

    /**
     * @return QueryExtensionGateway
     */
    public function createQueryExtensionGateway()
    {
        return new QueryExtensionGateway(
            $this->container->get('swag_default_sort.definition_collection'),
            $this->container->get('swag_default_sort.query_extender_order_by_filter_chain'),
            $this->container->get('swag_default_sort.query_extender_join_provider_collection')
        );
    }
}
