function link_edit(x) {
    var y = x.split('__');
    return '<a href="' + site.base_url + 'banks/edit/' + y[1] + '">' + y[0] + '</a>';
}
function bank_type(x) {

    if (x == 0) {
        return 'Caja de ahorro';
    } else if (x == 1) {
        return 'Cuenta corriente';
    } else {
        return 'Cuenta caja';
    }
}
function bank_status(x) {

    if (x == 0) {
        r = '<span class="label label-success">' +
            '<i class="fa fa-print"></i> Abierto</span';
    } else {
        r = '<span class="label label-danger">' +
            '<i class="fa fa-close"></i> Cerrado</span';
    }
    return r;
}

oTable = $('#BanksTable').dataTable({
    "aaSorting": [[3, "asc"]],
    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 500]],
    "iDisplayLength": 10,
    'bProcessing': true, 'bServerSide': true,
    'sAjaxSource': 'banks/getBanksAccount',
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
    }, { "mRender": link_edit }, { "mRender": bank_type }, null, null, { "mRender": bank_status },{ "bSortable": false }]
});

$(document).on("click", "#btn_add_bank", function (e) {
    $.ajax({
        url: site.base_url + 'banks/createBank',
        type: 'POST',
        dataType: 'json',
        data: $('#frmCreateBank').serialize()
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
        url: site.base_url + 'banks/updateBank',
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

$(document).on('click', '.po-delete-bank', function (e) {
    e.preventDefault();
    $('.po').popover('hide');
    var link = $(this).attr('href');
    var s = $(this).attr('id');
    var sp = s.split('__');
    alert(link);
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