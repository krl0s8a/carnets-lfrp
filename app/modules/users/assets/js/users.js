
function link_view(x) {
    var y = x.split('__');
    return '<a href="' + site.base_url + 'users/edit/' + y[1] + '">' + y[0] + '</a>';
}
oTable = $('#UsrTable').dataTable({
    "aaSorting": [[1, "asc"], [2, "asc"]],
    "aLengthMenu": [[10, 15, 25, 50, 100], [10, 15, 25, 50, 100]],
    "iDisplayLength": oLengthMenu,
    'bProcessing': true, 'bServerSide': true,
    'sAjaxSource': 'users/getUsers',
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
    },
    { "mRender": link_view }, null, null,{ "mRender": fld }, null, { "mRender": user_status }, { "bSortable": false }]
});