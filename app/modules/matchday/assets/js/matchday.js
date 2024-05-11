function name(x) {
    var y = x.split('__');
    return '<a href="' + site.base_url + 'matchday/view/' + y[1] + '">' + y[0] + '</a>';
}
oTable = $('#player_table').dataTable({
    "aaSorting": [[3, "desc"],[2, "desc"]],
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
    }, {"mRender":name}, null, null, null]
})