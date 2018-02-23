
// {block name="backend/swag_default_sort/model/category_path"}
Ext.define('Shopware.apps.SwagDefaultSort.model.CategoryPath', {
    extend: 'Shopware.data.Model',

    configure: function() {
        return {
            controller: 'SwagDefaultSort'
        };
    },

    fields: [
        // {block name="backend/swag_default_sort/model/category_path/fields"}{/block}
        {
            name: 'id',
            type: 'int',
            useNull: true
        },
        {
            name: 'catId',
            type: 'int',
            useNull: true
        },
        {
            name: 'name',
            type: 'string',
            useNull: false
        },
        {
            name: 'parentPath',
            type: 'array'
        },
        {
            name: 'parentPathString',
            convert: function(value, record) {
                var parentPath = record.get('parentPath');
                var catId = record.get('catId');
                var name = record.get('name');

                value = name + ' (ID: ' + catId + ')';

                if (!Ext.isArray(parentPath) || !parentPath.length) {
                    return value;
                }

                return record.get('parentPath').join(' -> ') + ' -> ' + value;
            }
        }
    ]
});
// {/block}
