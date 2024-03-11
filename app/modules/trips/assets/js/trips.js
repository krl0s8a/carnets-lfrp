function trip_status(x) {
    var y = x.split('__'), r = '';

    if (y[0] == 'T') {
        r = '<div class="text-center"><span class="label label-success">' +
            '<i class="fa fa-print"></i> Habilitado</span></div>';
    } else {
        r = '<span class="label label-danger">' +
            '<i class="fa fa-close"></i> Suspendido</span';
    }
    return r;
}

oTable = $('#TripTable').dataTable({
    "aaSorting": [[1, 'desc'], [2, "asc"]],
    "aLengthMenu": [[10, 15, 25, 50, 100], [10, 15, 25, 50, 100]],
    "iDisplayLength": oLengthMenu,
    'bProcessing': true, 'bServerSide': true,
    'sAjaxSource': 'trips/getTrips',
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
    }, null, { "mRender": fsd }, {"mRender": alignCenter}, null, null, null, null, {"mRender": alignCenter}, {"mRender": alignCenter}, { "mRender": trip_status }, { "bSortable": false }]
});

$('.check').on('change', function (e) {
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
$('#create_by').on('change', function (e) {
    if (e && e.preventDefault) {
        e.preventDefault();
    }
    if ($(this).val() == 'day') {
        $('.box-day').show();
        $('.box-period').hide();
    } else {
        $('.box-period').show();
        $('.box-day').hide();
    }
});