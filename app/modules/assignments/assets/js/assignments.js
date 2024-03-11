function assign_status(x) {
    var y = x.split('__');

    if (y[0] == 'T') {
        r = '<span class="label label-success">Asignado</span>';
    } else {
        r = '<span class="label label-warning">Rendido</span>';
    }
    return r;
}

oTable = $('#assignTable').dataTable({
    "aaSorting": [[2, "asc"]],
    "aLengthMenu": [[10, 15, 25, 50, 100], [10, 15, 25, 50, 100]],
    "iDisplayLength": oLengthMenu,
    'bProcessing': true, 'bServerSide': true,
    'sAjaxSource': site.base_url + 'assignments/getAssignments',
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
    }, null, null, null, {"mRender":alignCenter}, {"mRender":alignCenter}, {"mRender":alignCenter}, { "mRender": assign_status }, { "bSortable": false }]
});

$(document).on('click', '.po-delete-assign', function (e) {
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
// Verificar q haya rollos cargados segun el tipo elegido
$(document).on('change', '#ticket_id', function (e) {
    let ticket_id = $(this).val();
    $.ajax({
        url: site.base_url + 'assignments/getLastScrollAvailable',
        type: 'POST',
        dataType: 'json',
        data: { ticket_id: ticket_id }
    })
        .done(function (data) {
            if (data != 0) {
                $('#serial').val(data.serial);
                $('#number_ticket_start').val(data.ffrom);
                $('#number_ticket_end').val(data.tto);
                $('#scroll_id').val(data.id);
            } else {
                $('#serial').val('');
                $('#number_ticket_start').val('');
                $('#number_ticket_end').val('');
            }
        });
}).on('click', '#btn_to_assign', function (e) {
    $.ajax({
        url: site.base_url + 'assignments/saveAssignment',
        type: 'POST',
        dataType: 'json',
        data: $('#frmCreateAssignment').serialize()
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
}).on('click', '#in_progress', function (e) {
    $.ajax({
        url: site.base_url + 'assignments/assignToProgress',
        type: 'GET',
        dataType: 'html',
        data: { drive_id: $('#drive_id').val() }
    })
        .done(function (data) {
            $('#assignments').html(data);
        });
}).on('click', '#btn_edit', function (e) {
    $.ajax({
        url: site.base_url + 'assignments/updateAssign',
        type: 'POST',
        dataType: 'json',
        data: $('#frmUpdate').serialize()
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

