function linkView(x) {
    var y = x.split('__');
    return '<a data-toggle="modal" data-target="#myModal" href="' + site.base_url + 'cities/edit/' + y[1] + '" title="Ver detalles del permiso">' + y[0] + '</a>';
}

oTable = $('#CityTable').dataTable({
    "aaSorting": [[1, "asc"]],
    "aLengthMenu": [[10, 15, 25, 50, 100], [10, 15, 25, 50, 100]],
    "iDisplayLength": oLengthMenu,
    'bProcessing': true, 'bServerSide': true,
    'sAjaxSource': 'cities/getCities',
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
    }, { "mRender": linkView, "bSortable": true }, null, null, { "mRender": city_status }]
});

$(document).on("click", "#btn_add", function (e) {
    $.ajax({
        url: site.base_url + 'cities/createCity',
        type: 'POST',
        dataType: 'json',
        data: $('#frmCreate').serialize()
    })
        .done(function (data) {
            if (data.error == 1) {
                addAlertModal(data.msg, 'danger');
            } else {
                addAlert(data.msg, 'success');
                if (oTable != '') {
                    oTable.fnDraw();
                }
                $('#myModal').modal('hide');
            }
        });
}).on('click', '#btn_edit', function (e) {
    $.ajax({
        url: site.base_url + 'cities/updateCity',
        type: 'POST',
        dataType: 'json',
        data: $('#frmEdit').serialize()
    })
        .done(function (data) {
            if (data.error == 1) {
                addAlertModal(data.msg, 'danger');
            } else {
                addAlert(data.msg, 'success');
                if (oTable != '') {
                    oTable.fnDraw();
                }
                $('#myModal').modal('hide');
            }
        });
});