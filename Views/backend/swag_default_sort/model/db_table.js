
// {block name="backend/swag_default_sort/model/db_table"}
Ext.define('Shopware.apps.SwagDefaultSort.model.DbTable', {
    extend: 'Shopware.data.Model',

    configure: function () {
        return {
            controller: 'SwagDefaultSort'
        };
    },

    fields: [
        // {block name="backend/swag_default_sort/model/db_table/fields"}{/block}
        {
            name: 'tableName',
            type: 'string',
            useNull: false
        },
        {
            name: 'translation',
            type: 'string',
            useNull: false
        }
    ]
});
// {/block}
