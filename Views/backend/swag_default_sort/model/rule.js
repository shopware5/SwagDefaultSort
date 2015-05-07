
Ext.define('Shopware.apps.SwagDefaultSort.model.Rule', {
    extend: 'Shopware.data.Model',

    configure: function() {
        return {
            controller: 'SwagDefaultSort'
        };
    },

    fields: [
        {
            name : 'id',
            type: 'int',
            useNull: true
        },
        {
            name : 'tableName',
            type: 'string',
            useNull: false,
            defaultValue: 's_articles'
        },
        {
            name : 'definitionUid',
            type: 'string',
            useNull: false,
            defaultValue: 's_articles::name'
        },
        {
            name : 'direction',
            type: 'int',
            useNull: false
        },
        {
            name: 'sortOrder',
            type: 'int'
        },
        {
            name: 'categoryId',
            type: 'int'
        },
    ]
});

