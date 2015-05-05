Ext.define('Shopware.apps.SwagDefaultSort.model.DbField', {
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
