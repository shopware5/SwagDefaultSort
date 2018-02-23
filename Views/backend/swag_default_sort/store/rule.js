
// {block name="backend/swag_default_sort/store/rule"}
Ext.define('Shopware.apps.SwagDefaultSort.store.Rule', {
    extend: 'Shopware.store.Listing',

    configure: function() {
        return {
            controller: 'SwagDefaultSort',

            proxy: {
                type: 'ajax',
                reader: {
                    type: 'json',
                    root: 'data',
                    totalProperty: 'total'
                },
                api: {
                    read: '{url controller="base" action="list"}',
                    create: '{url controller="base" action="create"}',
                    update: '{url controller="base" action="update"}',
                    destroy: '{url controller="base" action="delete"}'
                }
            }
        };
    },

    sorters: {
        property: 'sortOrder',
        direction: 'ASC'
    },

    model: 'Shopware.apps.SwagDefaultSort.model.Rule'
});
// {/block}
