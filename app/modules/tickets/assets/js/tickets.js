function ticket_status(x) {
    var y = x.split('__'), r = '';

    if (y[0] == 'T') {
        r = '<div class="text-center"><span class="label label-success">' +
            '<i class="glyphicon glyphicon-ok"></i> Activo</span></div>';
    } else {
        r = '<div class="text-center"><span class="label label-danger">' +
            '<i class="fa fa-close"></i> Inactivo</span></div>';
    }
    return r;
}
function linkEdit(x) {
    var y = x.split('__');
    return '<a href="' + site.base_url + 'tickets/edit/' + y[1] + '" data-toggle="modal" data-target="#myModal">' + y[0] + '</a>';
}

oTable = $('#TicketTable').dataTable({
    "aaSorting": [[1, "asc"]],
    "aLengthMenu": [[10, 15, 25, 50, 100], [10, 15, 25, 50, 100]],
    "iDisplayLength": oLengthMenu,
    'bProcessing': true, 'bServerSide': true,
    'sAjaxSource': site.base_url + 'tickets/getTickets',
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
    }, {"mRender" : linkEdit}, null, null, null, { "mRender": ticket_status }, { "bSortable": false }]
});

$(document).on('change', '.check', function (e) {
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
}).on('click', '#btn_add', function (e) {
    $.ajax({
        url: site.base_url + 'tickets/createTicket',
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
        url: site.base_url + 'tickets/updateTicket',
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
}).on('click', '.po-delete-ticket', function (e) {
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