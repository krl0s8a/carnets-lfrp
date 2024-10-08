function link_edit(x) {
    var y = x.split('__');
    return '<a href="' + site.base_url + 'buses/edit/' + y[1] + '">' + y[0] + '</a>';
}

function player_status(x) {
    var y = x.split('__');

    if (y[0] == 'Activo') {
        r = '<span class="label label-success">Activo</span>';
    } else if(y[0] == 'Inactivo') {
        r = '<span class="label label-warning">Inactivo</span>';
    } else {
        r = '<span class="label label-danger">Suspendido</span>';
    }
    return r;
}

function img_hl(x) {
    var image_link = x == null || x == '' ? 'no_image.png' : x;
    return (
        '<div class="text-center"><a href="' +
        site.url +
        'assets/photos/players/' +
        image_link +
        '" data-toggle="lightbox"><img src="' +
        site.url +
        'assets/photos/players/thumbs/' +
        image_link +
        '" alt="" style="width:30px; height:30px;" /></a></div>'
    );
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
    }, {"mRender":img_hl}, null, null, null, {"mRender" : fsd}, null, {"mRender" : player_status}, { "bSortable": false }]
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