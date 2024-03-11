function type(x) {
    return oTypes[x];
}
function client_provider(x) {
    var y = x.split('__');
    r = '';
    if (y[0] == 1) {
        r += 'Cliente ';
    }
    if (y[1] == 1) {
        r += 'Proveedor';
    }
    return r;
}

function linkView(x) {
    var y = x.split('__');
    return '<a href="' + site.base_url + 'societe/edit/' + y[1] + '">' + y[0] + '</a>';
}


oTable = $('#SocieteTable').dataTable({
    "aaSorting": [[3, "asc"]],
    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 500]],
    "iDisplayLength": 10,
    'bProcessing': true, 'bServerSide': true,
    'sAjaxSource': 'societe/getSociete',
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
    }, { "mRender": linkView }, null, { "mRender": type }, null, { "mRender": client_provider }, { "bSortable": false }]
});

$(document).on("click", "#btn_add", function (e) {
    $.ajax({
        url: site.base_url + 'societe/createSociete',
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
        url: site.base_url + 'societe/updateSociete',
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
}).on('click', '.title', function (e) {

    alert(carlos);
}).on('click', '#btn_add_paymentmode', function (e) {
    $.ajax({
        url: site.base_url + 'societe/createPaymentmode',
        type: 'POST',
        dataType: 'json',
        data: $('#frmCreatePaymentmode').serialize()
    })
        .done(function (data) {
            if (data.error == 1) {
                addAlertModal(data.msg, 'danger');
            } else {
                location.reload();
                // addAlert(data.msg, 'success');
                // if (oTable != '') {
                //     oTable.fnDraw();
                // }
                // $('#myModal').modal('hide');
            }
        });
});