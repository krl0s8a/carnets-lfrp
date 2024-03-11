function link_view(x) {
    var y = x.split('__');
    return '<a data-toggle="modal" data-target="#myModal" href="' + site.base_url + 'permissions/edit/' + y[1] + '" title="Ver detalles del permiso">' + y[0] + '</a>';
}

function permission_status(x) {
    var y = x.split('__');

    if (y[0] == 'active') {
        r = '<div class="text-center"><span class="label label-success">Activo</span></div>';
    } else if (y[0] == 'inactive') {
        r = '<div class="text-center"><span class="label label-warning">Inactivo</span></div>';
    } else {
        r = '<div class="text-center"><span class="label label-danger">Eliminado</span></div>';
    }
    return r;
}

oTable = $('#PermissionTable').dataTable({
    "aaSorting": [[1, "asc"]],
    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 500]],
    "iDisplayLength": oLengthMenu,
    'bProcessing': true, 'bServerSide': true,
    'sAjaxSource': 'permissions/getPermissions',
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
    }, { "mRender": link_view }, null, { "mRender": permission_status }]
});

$(document).on("click", "#action_edit", function (e) {
    $.ajax({
        url: site.base_url + 'permissions/updatePermission',
        type: 'POST',
        dataType: 'json',
        data: $('#frm_permission').serialize()
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
}).on('click', '#action_create', function (e) {
    $.ajax({
        url: site.base_url + 'permissions/createPermission',
        type: 'POST',
        dataType: 'json',
        data: $('#frm_permission').serialize()
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

    // $(document).on("change", "#school", function (e) {
    //     if (e && e.preventDefault) {
    //         e.preventDefault();
    //     }
    //     let school = $('#school').val(),
    //         type = $('#type').val(),
    //         route = $('#route').val();
    //     $.ajax({
    //         type: "get", async: false,
    //         url: $base_url + 'tickets/ajaxGetPassengersBySchool',
    //         dataType: 'html',
    //         data: { school: school, type: type, route: route },
    //     })
    //         .done(function (data) {
    //             $('#grid').html(data);
    //             $('#save').removeClass('disabled');
    //             $('#print').removeClass('disabled');
    //         })
    //         .fail(function () {
    //             console.log("error");
    //         })
    //         .always(function () {
    //             console.log("complete");
    //         });
    // });