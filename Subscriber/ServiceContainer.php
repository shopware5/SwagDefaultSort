<?php


namespace Shopware\SwagDefaultSort\Subscriber;


use Enlight\Event\SubscriberInterface;
use Shopware\SwagDefaultSort\Components\ORMInflector\ORMInflector;
use Shopware\SwagDefaultSort\Components\QueryExtender\JoinProviderCollection;
use Shopware\SwagDefaultSort\Components\QueryExtender\OrderByProvider\OrderByFilterChain;
use Shopware\SwagDefaultSort\Components\SortDefinition\DefinitionCollection;
use Shopware\SwagDefaultSort\Components\ValueObject\FieldVoHydrator;
use Shopware\SwagDefaultSort\Components\ValueObject\TableVoHydrator;
use Symfony\Component\DependencyInjection\Container;

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
            'Enlight_Bootstrap_InitResource_swag_default_sort.table_vo_hydrator' => 'createTableVoHydrator',
            'Enlight_Bootstrap_InitResource_swag_default_sort.field_vo_hydrator' => 'createFieldVoHydrator',
            'Enlight_Bootstrap_InitResource_swag_default_sort.table_vo_collection' => 'createTableVos',
            'Enlight_Bootstrap_InitResource_swag_default_sort.field_vo_collection' => 'createFieldVos',
            'Enlight_Bootstrap_InitResource_swag_default_sort.query_extender_order_by_filter_chain' => 'createOrderByFilterChain',
            'Enlight_Bootstrap_InitResource_swag_default_sort.query_extender_join_provider_collection' => 'createJoinProvider',
        ];
    }

    public function createDefinitionCollection()
    {
        return new DefinitionCollection();
    }

    public function createOrmInflector()
    {
        return new ORMInflector(Shopware()->Models());
    }

    public function createTableVoHydrator()
    {
        return new TableVoHydrator(Shopware()->Snippets());
    }

    public function createTableVos()
    {
        return $this->container->get('swag_default_sort.table_vo_hydrator')->createTableVos(
            $this->container->get('swag_default_sort.definition_collection')->getTableNames()
        );
    }

    public function createFieldVoHydrator()
    {
        return new FieldVoHydrator(Shopware()->Snippets());
    }

    public function createFieldVos()
    {
        return $this->container->get('swag_default_sort.field_vo_hydrator')->createFieldVos(
            $this->container->get('swag_default_sort.definition_collection')
        );
    }

    public function createOrderByFilterChain()
    {
        return new OrderByFilterChain();
    }

    public function createJoinProvider()
    {
        return new JoinProviderCollection();
    }
}