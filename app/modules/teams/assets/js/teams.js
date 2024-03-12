function linkEdit(x) {
    var y = x.split('__');
    return '<a href="' + site.base_url + 'personal/edit/' + y[1] + '">' + y[0] + '</a>';
}
oTable = $('#team_table').dataTable({
    "aaSorting": [[1, "asc"], [2, "asc"]],
    "aLengthMenu": [[10, 15, 25, 50, 100], [10, 15, 25, 50, 100]],
    "iDisplayLength": oLengthMenu,
    'bProcessing': true, 'bServerSide': true,
    'sAjaxSource': 'teams/get_teams',
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
    },  null, null, null, { "bSortable": false }]
});

$(document).on('click', '.po-delete-avatar', function (e) {
    var row = $(this).closest('tr');
    e.preventDefault();
    $('.po').popover('hide');
    var link = $(this).attr('href');
    var return_id = $(this).attr('data-return-id');
    $.ajax({
        type: 'get',
        url: link,
        dataType: 'json',
        success: function (data) {
            if (data.error == 1) {
                addAlert(data.msg, 'danger');
            } else {
                addAlert(data.msg, 'success');
                if (oTable != '') {
                    oTable.fnDraw();
                }
            }
        },
        error: function (data) {
            addAlert('Ajax call failed', 'danger');
        },
    });
    return false;
});