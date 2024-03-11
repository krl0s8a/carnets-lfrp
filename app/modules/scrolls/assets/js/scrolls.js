function linkEdit(x) {
    var y = x.split('__');
    return '<div class="text-center"><a href="' + site.base_url + 'scrolls/edit/' + y[1] + '" data-toggle="modal" data-target="#myModal">' + y[0] + '</a></div>';
}

oTable = $('#ScrollsTable').dataTable({
	"aaSorting": [[1, "desc"]],
	"aLengthMenu": [[10, 15, 25, 50, 100], [10, 15, 25, 50, 100]],
	"iDisplayLength": oLengthMenu,
	'bProcessing': true, 'bServerSide': true,
	'sAjaxSource': 'scrolls/getScrolls',
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
	}, {"mRender":linkEdit}, null, {"mRender" : alignCenter}, {"mRender" : alignCenter}, {"mRender" : alignCenter}, {"mRender" : alignCenter}, {"mRender" : alignCenter}, { "bSortable": false }]
});

$(document).ready(function () {
	$(document).on("change", "#ticket_id", function (e) {
		if (e && e.preventDefault) {
			e.preventDefault();
		}
		$.ajax({
			url: site.base_url + 'scrolls/getTicket',
			type: 'GET',
			dataType: 'json',
			data: { ticket_id: $(this).val() }
		})
			.done(function (data) {
				$('#tickets_scroll').val(data.quantity);
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
	}).on('click', '#prev', function (e) {
		$.ajax({
			url: site.base_url + 'scrolls/getScrollsLoad',
			type: 'GET',
			dataType: 'html',
			data: $('#frmLoad').serialize()
		})
			.done(function (scrolls) {
				$('#scrolls').html(scrolls);
			})
			.fail(function () {
				console.log("error");
			})
			.always(function () {
				console.log("complete");
			});
	}).on('click', '#btn_to_assign', function (e) {
		$.ajax({
			url: site.base_url + 'assignments/saveAssignment',
			type: 'POST',
			dataType: 'json',
			data: $('#frmCreateAssign').serialize()
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
	$(document).on('click', '#btn_edit', function (e) {
		$.ajax({
			url: site.base_url + 'scrolls/save',
			type: 'POST',
			dataType: 'json',
			data: $('#frmEditScroll').serialize()
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
	});
	$(document).on('click', '.po-delete-scroll', function (e) {
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
});