
var $frmCreateRoute = $("#frmCreateRoute"),
	$frmUpdateRoute = $('#frmUpdateRoute');

function setLocations() {
	var index_arr = new Array();

	$('#location_list').find(".location-row").each(function (index, row) {
		index_arr.push($(row).attr('data-index'));
	});
	$('#index_arr').val(index_arr.join("|"));
}

function direction(x) {
	var y = x.split('__'), r = '';

	if (y[0] == 1) {
		r = '<div class="text-center">Ida</div>';
	} else {
		r = '<div class="text-center">Vuelta</div>';
	}
	return r;
}

function linkView(x) {
	var y = x.split('__');
	return '<a href="' + site.base_url + 'routes/edit/' + y[1] + '" title="Ver detalles del permiso">' + y[0] + '</a>';
}
function routeStatus(x) {
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
if ($frmCreateRoute.length > 0) {
	$frmCreateRoute.submit(function (e) {
		setLocations();
	})
}
if ($frmUpdateRoute.length > 0) {
	$frmUpdateRoute.submit(function (e) {
		setLocations();
	})
}
$("#location_list").sortable({
	handle: '.location-move',
	stop: function (e) {
		$('#location_list').find(".location-row").each(function (order, row) {
			var index = $(row).attr('data-index'),
				title = myLabel.location + " " + (order + 1) + ":";
			$('.title-' + index).html(title);
		});
	}
});

oTable = $('#route_table').dataTable({
	"aaSorting": [[1, "asc"], [3, "asc"], [4, 'asc']],
	"aLengthMenu": [[10, 15, 25, 50, 100], [10, 15, 25, 50, 100]],
	"iDisplayLength": oLengthMenu,
	'bProcessing': true, 'bServerSide': true,
	'sAjaxSource': 'routes/getRoutes',
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
	}, { "mRender": linkView }, null, { "mRender": direction }, null, null, { "mRender": routeStatus }]
});

$(document).on("click", ".delete-route", function (e) {
	if (e && e.preventDefault) {
		e.preventDefault();
	}

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
}).on('click', '.add-location', function (e) {
	if (e && e.preventDefault) {
		e.preventDefault();
	}
	$.ajax({
		type: "get", async: false,
		url: site.base_url + 'routes/ajaxGetRowLocationHTML',
		dataType: 'html',
		data: {},
	})
		.done(function (data) {
			var clone_text = data,
				index = Math.ceil(Math.random() * 999999),
				number_of_locations = $('#location_list').find(".location-row").length,
				order = parseInt(number_of_locations, 10) + 1;

			if (number_of_locations < myLabel.number_of_cities) {
				clone_text = clone_text.replace(/\{INDEX\}/g, 'bs_' + index);
				clone_text = clone_text.replace(/\{ORDER\}/g, order);
				$('#location_list').append(clone_text);
			}
		});
}).on('click', '.location-delete', function (e) {
	if (e && e.preventDefault) {
		e.preventDefault();
	}
	var $location = $(this).parent().parent();
	$location.remove();

	$('#location_list').find(".location-row").each(function (order, row) {
		var index = $(row).attr('data-index'),
			title = myLabel.location + " " + (order + 1) + ":";
		$('.title-' + index).html(title);
	});
});