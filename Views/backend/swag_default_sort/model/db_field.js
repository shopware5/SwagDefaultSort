
// {block name="backend/swag_default_sort/model/db_field"}
Ext.define('Shopware.apps.SwagDefaultSort.model.DbField', {
    extend: 'Shopware.data.Model',

    configure: function () {
        return {
            controller: 'SwagDefaultSort'
        };
    },

    fields: [
        // {block name="backend/swag_default_sort/model/db_field/fields"}{/block}
        {
            name: 'tableName',
            type: 'string',
            useNull: false
        },
        {
            name: 'definitionUid',
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
