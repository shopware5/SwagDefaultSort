
Ext.define('Shopware.apps.SwagDefaultSort.store.DbField', {
    extend:'Shopware.store.Listing',

    storeId: 'SwagDefaultSortDbField',
    //url: '{url action="listInflection"}',

    data: [
        {
            tableName: 's_articles',
            fieldName: 'id',
            translation: 'ID'
        },
        {
            tableName: 's_articles',
            fieldName: 'name',
            translation: 'Name'
        },
        {
            tableName: 's_articles_details',
            fieldName: 'byd',
            translation: 'ByID'
        }
    ],

    configure: function() {
        return {
            controller: 'SwagDefaultSort'
        };
    },
    model: 'Shopware.apps.SwagDefaultSort.model.DbField'
});