function fst(oObj) {
	if (oObj != null) {
		var aDate = oObj.split(':');
		return aDate[0] + ':' + aDate[1];
	} else {
		return '';
	}
}
function linkView(x) {
	var y = x.split('__');
	return '<a href="' + site.base_url + 'services/edit/' + y[1] + '" title="Ver detalles del permiso">' + y[0] + '</a>';
}

oTable = $('#services_table').dataTable({
	"aaSorting": [[1, "asc"], [2, "asc"]],
	"aLengthMenu": [[10, 15, 25, 50, 100], [10, 15, 25, 50, 100]],
	"iDisplayLength": oLengthMenu,
	'bProcessing': true, 'bServerSide': true,
	'sAjaxSource': 'services/getServices',
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
	}, { "mRender": linkView }, null, null,
	{ "bSortable": false, "mRender": alignCenter },
	{ "bSortable": false, "mRender": alignCenter },
	{ "bSortable": false, "mRender": fsd },
	{ "bSortable": false, "mRender": fsd }, { "bSortable": false }]
});

$(document).on("change", "#line_id", function (e) {
	if (e && e.preventDefault) {
		e.preventDefault();
	}
	var line_id = $(this).val();
	$('#route_id').html('');
	$('#bs_service_locations').html('');

	$.ajax({
		url: site.base_url + 'services/getRoutes',
		type: 'POST',
		dataType: 'html',
		data: { line_id: line_id },
	})
		.done(function (data) {
			$('#route_id').html(data);
		});

}).on('change', '#route_id', function (e) {
	var route_id = $(this).val();
	if (route_id == '') {
		$('#bs_service_locations').html('');
	} else {
		$.ajax({
			url: site.base_url + '/services/getLocations',
			type: 'POST',
			dataType: 'html',
			data: { route_id: route_id },
		})
			.done(function (data) {
				$('#bs_service_locations').html(data);
			});
	}
});