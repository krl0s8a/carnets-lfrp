function payments(x) {
    return types_of_payment[x];
}

function status_payment(x) {
    if (x == 0) { // Pendiente de pago
        return '<span class="label label-warning">Pendiente de pago</span>';
    } else if (x == 1) { // Pagado
        return '<span class="label label-default">Pagado</span>';
    } else { // Pagado parcialmente
        return '<span class="label label-info">Pagado parcialmente</span>';
    }
}

function link_view(x) {
    var y = x.split('__');
    return '<a href="' + site.base_url + 'salaries/edit/' + y[1] + '">' + y[0] + '</a>';
}

oTable = $('#SalaryTable').dataTable({
    "aaSorting": [[0, "desc"]],
    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 500]],
    "iDisplayLength": 10,
    'bProcessing': true, 'bServerSide': true,
    'sAjaxSource': 'salaries/getSalaries',
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
    }, { "mRender": link_view }, null, null, { "mRender": fsd }, { "mRender": fsd }, { "mRender": alignCenter }, { "mRender": status_payment }, { "bSortable": false }]
});
oTable1 = $('#PaymentsTable').dataTable({
    "aaSorting": [[1, "desc"]],
    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 500]],
    "iDisplayLength": 10,
    'bProcessing': true, 'bServerSide': true,
    'sAjaxSource': 'salaries/getPayments',
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
    }, null, null, null, null, { "mRender": fsd }, { "mRender": fsd }, {"mRender" : payments}, null,{ "mRender": fsd },null]
});

$(document).on("click", "#btn_add", function (e) {
    $.ajax({
        url: site.base_url + 'salaries/createSalary',
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
        url: site.base_url + 'salaries/updateSalary',
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
}).on('click', '#btn-add-pay', function (e) {
    e.preventDefault();
    $.ajax({
        url: site.base_url + 'salaries/save_add_pay',
        type: 'POST',
        dataType: 'json',
        data: $('#frm-add-pay').serialize(),
        async : false,
        success: function (response) {
            if(response.error == 1){
                addAlertModal(response.msg, 'danger');
            } else {
                location.reload();
            }
        }
    });
    return false;
}).on('click', '.po-delete-pay', function(e){
    e.preventDefault();
    val = $(this).attr('id');
    $.ajax({
        url: site.base_url + 'salaries/delete_pay',
        type: 'POST',
        dataType: 'json',
        data: {'id':val},
        success: function () {
            location.reload();
        },
        error: function () {
            alert('Error');
        }
    });
});