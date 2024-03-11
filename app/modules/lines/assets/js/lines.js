function linkView(x) {
    var y = x.split('__');
    return '<a data-toggle="modal" data-target="#myModal" href="' +
        site.base_url + 'lines/edit/' + y[1] +
        '" title="Ver detalles del permiso">' + y[0] + '</a>';
}
function lineStatus(x) {
    var y = x.split('__');

    if (y[0] == 'T') {
        r = '<span class="label label-success">' +
            '<i class="fa fa-ok-circle"></i> Activo</span';
    } else {
        r = '<span class="label label-danger">' +
            '<i class="fa fa-close"></i> Inactivo</span';
    }
    return r;
}

oTable = $('#LineTable').dataTable({
    "aaSorting": [[1, "asc"]],
    "aLengthMenu": [[10, 15, 25, 50, 100], [10, 15, 25, 50, 100]],
    "iDisplayLength": oLengthMenu,
    'bProcessing': true, 'bServerSide': true,
    'sAjaxSource': 'lines/getLines',
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
    }, { "mRender": linkView }, { "mRender": lineStatus }]
});

$(document).on("click", "#action_edit", function (e) {
    $.ajax({
        url: site.base_url + 'lines/updateLine',
        type: 'POST',
        dataType: 'json',
        data: $('#frm_line').serialize()
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
        url: site.base_url + 'lines/createLine',
        type: 'POST',
        dataType: 'json',
        data: $('#frm_line').serialize()
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


$(document).on("click", "#del", function (e) {
    e.preventDefault();
    $('#form_action').val($(this).attr('data-action'));
    $('#val').val($(this).attr('data-identifier'));
    $('#action-form').submit();

}).on('change', '.check', function (e) {
    if (e && e.preventDefault) {
        e.preventDefault();
    }
    if ($(this).is(':checked')) {
        var element = $(this).parent().parent();
        element.find('select').attr('disabled', false);
        element.find('input[type="number"]').attr('disabled', false);
    } else {
        var element = $(this).parent().parent();
        element.find('select').attr('disabled', true);
        element.find('input[type="number"]').attr('disabled', true);
    }
});