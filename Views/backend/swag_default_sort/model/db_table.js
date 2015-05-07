Ext.define('Shopware.apps.SwagDefaultSort.model.DbTable', {
    extend: 'Shopware.data.Model',

    configure: function () {
        return {
            controller: 'SwagDefaultSort'
        };
    },

    fields: [
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
    ],
});
