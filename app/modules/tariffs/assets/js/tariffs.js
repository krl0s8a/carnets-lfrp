function linkEdit(x) {
	var y = x.split('__');
	return '<a href="' + site.base_url + 'tariffs/edit/' + y[1] + '">' + y[0] + '</a>';
}

var $frmCreateTariff = $('#frmCreateTariff'),
	$frmUpdateTariff = $('#frmUpdateTariff'),

	oTable = $('#TariffTable').dataTable({
		"aaSorting": [[1, "asc"]],
		"aLengthMenu": [[10, 15, 25, 50, 100], [10, 15, 25, 50, 100]],
		"iDisplayLength": oLengthMenu,
		'bProcessing': true, 'bServerSide': true,
		'sAjaxSource': site.base_url + 'tariffs/getTariffs',
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
		}, { "mRender":linkEdit }, null, {"mRender": fsd}, { "mRender": fsd }, { "mRender": tariff_status }, { "bSortable": false }]
	});

function tariff_status(x) {
	var y = x.split('__');
	return y[0] == 'T'
		? '<a href="' +
		site.base_url +
		'tariffs/desactivate/' +
		y[1] +
		'" <span class="label label-success"><i class="fa fa-check"></i> ' +
		lang['active'] +
		'</span></a>'
		: '<a href="' +
		site.base_url +
		'tariffs/activate/' +
		y[1] +
		'"><span class="label label-danger"><i class="fa fa-times"></i> ' +
		lang['inactive'] +
		'</span><a/>';
}

function initializePriceGrid() {
	if ($(".pj-location-grid").length > 0) {
		var head_height = $('.content-head-row').height();
		$('.content-head-row').height(head_height + 20);
		$('.title-head-row').height(head_height + 20);

		$('.title-row').each(function (index) {
			var id = $(this).attr('lang');
			var h = $('.content_row_' + id).height();
			if (h < 56) {
				h = 56;
			}
			$(this).height(h);
			$('.content_row_' + id).height(h);
		});
		$(".wrapper1").scroll(function () {
			$(".wrapper2")
				.scrollLeft($(".wrapper1").scrollLeft());
		});
		$(".wrapper2").scroll(function () {
			$(".wrapper1")
				.scrollLeft($(".wrapper2").scrollLeft());
		});

		$(".wrapper2").height($("#compare_table").height() + 24);
	}
}

if ($frmUpdateTariff.length > 0) {
	initializePriceGrid();
}

$(document).on("change", "#school", function (e) {
	if (e && e.preventDefault) {
		e.preventDefault();
	}

});
$('#line_id').on('change', function (e) {
	var line_id = $(this).val();
	if (line_id == '') {
		$('#grid_price').html('');
		return false;
	}
	$.ajax({
		url: site.base_url + '/tariffs/getGridPrice',
		type: 'GET',
		dataType: 'html',
		data: { line_id: line_id },
	})
		.done(function (grid) {
			$('#grid_price').html(grid);
			initializePriceGrid();
		});
});