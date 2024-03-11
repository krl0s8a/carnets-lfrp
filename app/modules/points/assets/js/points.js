function point_status(x) {
    var y = x.split('__');
    return y[0] == 'T'
        ? '<a href="' +
        site.base_url +
        'points/inactivate/' +
        y[1] +
        '"><span class="label label-success"><i class="fa fa-check"></i> ' +
        lang['active'] +
        '</span></a>'
        : '<a href="' +
        site.base_url +
        'points/activate/' +
        y[1] +
        '"><span class="label label-danger"><i class="fa fa-times"></i> ' +
        lang['inactive'] +
        '</span><a/>';
}

function linkEdit(x) {
    var y = x.split('__');
    return '<a href="' + site.base_url + 'points/edit/' + y[1] + '" data-toggle="modal" data-target="#myModal">' + y[0] + '</a>';
}

oTable = $('#pointTable').dataTable({
    "aaSorting": [[1, "asc"]],
    "aLengthMenu": [[10, 15, 25, 50, 100], [10, 15, 25, 50, 100]],
    "iDisplayLength": oLengthMenu,
    'bProcessing': true, 'bServerSide': true,
    'sAjaxSource': 'points/getPoints',
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
    }, { "mRender": linkEdit }, null, { "bSortable": false }]
});

$(document).on("click", "#btn_add", function (e) {
    $.ajax({
        url: site.base_url + 'points/save',
        type: 'POST',
        dataType: 'json',
        data: $('#frmCreatePoint').serialize()
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
        })
        .fail(function () {
            console.log("error");
        })
        .always(function () {
            console.log("complete");
        });
}).on("click", "#btn_edit", function (e) {
    $.ajax({
        url: site.base_url + 'points/save',
        type: 'POST',
        dataType: 'json',
        data: $('#frmEditPoint').serialize()
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
        })
        .fail(function () {
            console.log("error");
        })
        .always(function () {
            console.log("complete");
        });
}).on("click", '.po-delete-point', function (e) {
    e.preventDefault();
    $('.po').popover('hide');
    var link = $(this).attr('href');
    var s = $(this).attr('id');
    var sp = s.split('__');
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