
//{block name="backend/swag_default_sort/model/rule"}
Ext.define('Shopware.apps.SwagDefaultSort.model.Rule', {
    extend: 'Shopware.data.Model',

    configure: function() {
        return {
            controller: 'SwagDefaultSort'
        };
    },

    fields: [
        //{block name="backend/swag_default_sort/model/rule/fields"}{/block}
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
            name : 'descending',
            type: 'bool'
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
//{/block}
