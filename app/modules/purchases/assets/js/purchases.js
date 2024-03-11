oTable = $('#PurchaseTable').dataTable({
    "aaSorting": [[3, "asc"]],
    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 500]],
    "iDisplayLength": 10,
    'bProcessing': true, 'bServerSide': true,
    'sAjaxSource': 'purchases/getPurchases',
    'oLanguage' : dt_lang,
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
    }, null, null, null, null, {"mRender": city_status}, {"bSortable": false}]
});

$(document).on("click", "#btn_add", function (e) {
	$.ajax({
		url: site.base_url + 'purchases/createCity',
		type: 'POST',
		dataType: 'json',
		data: $('#frmCreate').serialize()
	})
	.done(function(data) {
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
}).on('click','#btn_edit',function(e){
	$.ajax({
		url: site.base_url + 'purchases/updateCity',
		type: 'POST',
		dataType: 'json',
		data: $('#frmEdit').serialize()
	})
	.done(function(data) {
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