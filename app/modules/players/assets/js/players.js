function link_edit(x) {
    var y = x.split('__');
    return '<a href="' + site.base_url + 'buses/edit/' + y[1] + '">' + y[0] + '</a>';
}

function bus_status(x) {
    var y = x.split('__');

    if (y[0] == 'T') {
        r = '<div class="text-center"><span class="label label-success">Habilitado</span></div>';
    } else {
        r = '<div class="text-center"><span class="label label-danger">Deshabilitado</span></div>';
    }
    return r;
}

oTable = $('#player_table').dataTable({
    "aaSorting": [[2, "asc"]],
    "aLengthMenu": [[10, 15, 25, 50, 100], [10, 15, 25, 50, 100]],
    "iDisplayLength": oLengthMenu,
    'bProcessing': true,
    'bServerSide': true,
    'sAjaxSource': 'players/get_players',
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
    }, null, null, null, null, {"mRender" : fsd}, null, { "bSortable": false }]
}).on('click', '.po-delete-player', function (e) {
    e.preventDefault();
    $('.po').popover('hide');
    var link = $(this).attr('href');
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