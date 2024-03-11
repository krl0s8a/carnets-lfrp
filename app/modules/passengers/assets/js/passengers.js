function typeLevel(x) {
	if (x == 'P') {
		r = 'Primario';
	} else if (x == 'S') {
		r = 'Secundario';
	} else if (x == 'T') {
		r = 'Terciario';
	} else if (x == 'U') {
		r = 'Universitario'
	} else {
		r = '---';
	}
	return r;
}

function linkCustomer(x) {
	var y = x.split('__');
	return '<a href="' + site.base_url + 'passengers/edit/' + y[1] + '">' + y[0] + '</a>';
}

function typeCustomer(x) {
	return '<div class="text-center">' + types_of_passenger[x] + '</div>';
}

oTable = $('#table_customers').dataTable({
	"aaSorting": [[1, "asc"]],
	"aLengthMenu": [[10, 15, 25, 50, 100], [10, 15, 25, 50, 100]],
	"iDisplayLength": oLengthMenu,
	'bProcessing': true, 'bServerSide': true,
	'sAjaxSource': 'passengers/getPassengers',
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
	}, { "mRender": linkCustomer }, {"mRender" : alignCenter}, { "mRender": typeCustomer }, null, null, { "bSortable": false }]
});

$(document).on("change", "#school", function (e) {
	if (e && e.preventDefault) {
		e.preventDefault();
	}
	let school = $('#school').val(),
		type = $('#type').val(),
		route = $('#route').val();
	$.ajax({
		type: "get", async: false,
		url: $base_url + 'tickets/ajaxGetPassengersBySchool',
		dataType: 'html',
		data: { school: school, type: type, route: route },
	})
		.done(function (data) {
			$('#grid').html(data);
			$('#save').removeClass('disabled');
			$('#print').removeClass('disabled');
		})
		.fail(function () {
			console.log("error");
		})
		.always(function () {
			console.log("complete");
		});
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
}).on('click', '.delete-school', function (e) {
	if (e && e.preventDefault) {
		e.preventDefault();
	}
	let t = $(this), ps = t.attr('id'),
		fd = $('#fd_' + ps);
	$.ajax({
		url: site.base_url + '/passengers/deleteSchool',
		type: 'POST',
		dataType: 'json',
		data: { ps: ps },
	})
		.done(function (data) {
			if (data.error == 0) {
				t.parent().remove();
				// removemos el fieldset asociado
				fd.remove();
			}
		});
}).on('change', '#school_id', function (e) {
	let school = $(this).val(), pass = $('#id').val();
	if (school != '') {
		$.ajax({
			url: site.base_url + '/passengers/addSchool',
			type: 'POST',
			dataType: 'json',
			data: { school: school, passenger: pass }
		})
			.done(function (data) {
				$('#schools').append(data.school);
				$('#tramos').append(data.tramo);
			});
	}
}).on('click', '.add-tramo', function (e) {
	let arr_ps = $(this).attr('id').split('_');
	let ps = arr_ps[1];
	let cities = $('#cities_' + ps);

	if ($('#from_' + ps).val() != $('#to_' + ps).val()) {
		$.ajax({
			url: site.base_url + '/passengers/addTramo',
			type: 'POST',
			dataType: 'html',
			data: { ps: ps, from: $('#from_' + ps).val(), to: $('#to_' + ps).val() },
		})
			.done(function (data) {
				cities.append(data);
			});
	} else {
		alert('El punto origen y destino son iguales.');
	}
}).on('click', '.delete-tramo', function (e) {
	if (e && e.preventDefault) {
		e.preventDefault();
	}
	let t = $(this), tr = $(this).attr('id'),
		arr = tr.split('_'),
		fd = $('#tr_' + arr[1]);
	$.ajax({
		url: site.base_url + '/passengers/deleteTramo',
		type: 'POST',
		dataType: 'json',
		data: { tr: arr[1] },
	})
		.done(function (data) {
			if (data.error == 0) {
				t.parent().remove();
				// removemos el fieldset asociado
				fd.remove();
			}
		});
}).on('click', '#btn_add', function (e) {
	$.ajax({
		url: site.base_url + 'passengers/ajaxSaveCreate',
		type: 'POST',
		dataType: 'json',
		data: $('#frmCreateAjax').serialize()
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
}).on('click', '.po-delete-customer', function (e) {
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
}).on('change', '#type', function (e) {
	// institucion : full_name, 
	// alumno y docente : dni, apellio, nombre, nivel
	// particular : dni, apellido, nombre
	let type = $(this).val();
	switch (type) {
		case '1':
		case '2':
			$('.institucion').hide();
			$('.adp').show();
			$('.no-particular').show();
			break;
		case '3':
			$('.institucion').hide();
			$('.adp').show();
			$('.no-particular').hide();
			break;
		default:
			$('.institucion').show();
			$('.adp').hide();
			$('.no-particular').hide();
			break;
	}
}).on('keyup','#dni', function(e){
	$.ajax({
		url: site.base_url + 'passengers/ajaxGetPassenger',
		type: 'POST',
		dataType: 'json',
		data: $('#frmCreateAjax').serialize()
	})
		.done(function (data) {
			// asignar los valores recuperados
			$('#last_name').val(data.last_name);
			$('#first_name').val(data.first_name);
			$('#people_id').val(data.id);
		});
});