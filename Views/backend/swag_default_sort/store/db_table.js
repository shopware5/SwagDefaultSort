
Ext.define('Shopware.apps.SwagDefaultSort.store.DbTable', {
    extend:'Shopware.store.Listing',

    storeId: 'SwagDefaultSortDbTable',

    //url: '{url action="listInflection"}',

    data: [
        {
            tableName: 's_articles',
            translation: 'Artikel',
            dbfields: [
                {
                    tableName: 's_articles',
                    fieldName: 'id',
                    translation: 'ID'
                },
                {
                    tableName: 's_articles',
                    fieldName: 'name',
                    translation: 'Name'
                }
            ]
        },
        {
            tableName: 's_articles_details',
            translation: 'Artikel-Details',
            dbfields: [
                {
                    tableName: 's_articles_details',
                    fieldName: 'byid',
                    translation: 'BYID'
                }
            ]
        }
    ],

    configure: function() {
        return {
            controller: 'SwagDefaultSort'
        };
    },

    model: 'Shopware.apps.SwagDefaultSort.model.DbTable'
});