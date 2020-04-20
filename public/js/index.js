$(document).ready(function(){

    //Building the table list by the webservice list API
    $('#transactions').bootstrapTable({
        url: $('#url').val(),
        pagination: true,
        search: true,
        pageSize : 5,
        pageList : [5, 10, 25, 50, 100],
        showFooter : true,
        btSelectItem : 'id',
        columns: [{
            field: 'id',
            title: 'id',
            sortable : true,
        },{
            field: 'tmethod',
            title: 'Method',
            sortable : true
        }, {
            field: 'ttype',
            title: 'Type',
            sortable : true
        }, {
            field: 'bamount',
            title: 'Base amount'
        }, {
            field: 'bcurr',
            title: 'Base currency',
            sortable : true
        }, {
            field: 'tamount',
            title: 'Target amount'
        }, {
            field: 'tcurr',
            title: 'Target currency',
            sortable : true
        }, {
            field: 'xrate',
            title: 'Exchange rate'
        }, {
            field: 'actions',
            title: 'Actions'
        }]
    });

});