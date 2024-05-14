function ref(x) {
    var y = x.split('__');
    return '<a href="' + site.base_url + 'matchday/edit/' + y[1] + '">J-' + y[0] + '</a>';
}

function playoff(x){
    if (x == 0) {
        return '<center>No</center>';
    } else {
        return '<center>Si</center>';
    }
}

oTable = $('#player_table').dataTable({
    "aaSorting": [[1, "desc"],[4, "asc"]],
    "aLengthMenu": [[10, 15, 25, 50, 100], [10, 15, 25, 50, 100]],
    "iDisplayLength": oLengthMenu,
    'bProcessing': true,
    'bServerSide': true,
    'sAjaxSource': 'matchday/get_matchday',

    'oLanguage': dt_lang,
    'fnServerData': function (sSource, aoData, fnCallback) {
        $.ajax({
            'dataType': 'json',
            'type': 'POST',
            'url': sSource,
            'data': aoData,
            'success': fnCallback
        });
    },
    "aoColumns": [{
        "bSortable": false,
        "mRender": checkbox
    }, {"mRender":ref}, null, {"mRender" : playoff},{"mRender" : alignCenter}, null, null,{"bSortable":false}],    
}).fnSetFilteringDelay().dtFilter([
    {column_number: 2, filter_default_label: "[Jornada]", filter_type: "text", data: []},
    {column_number: 5, filter_default_label: "[Torneo]", filter_type: "text", data: []},
    {column_number: 6, filter_default_label: "[Categoria]", filter_type: "text", data: []},
    ], "footer");