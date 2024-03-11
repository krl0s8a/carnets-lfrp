function linkView(x) {
	var y = x.split('__');
	return '<a href="' + site.base_url + 'schools/edit/' + y[1] + '">' + y[0] + '</a>';
}

oTable = $('#SchoolTable').dataTable({
	"aaSorting": [[1, "asc"], [2, "asc"]],
	"aLengthMenu": [[10, 15, 25, 50, 100], [10, 15, 25, 50, 100]],
	"iDisplayLength": oLengthMenu,
	'bProcessing': true, 'bServerSide': true,
	'sAjaxSource': 'schools/getSchools',
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
	'fnRowCallback': function (nRow, aData, iDisplayIndex) {
		nRow.id = aData[0];
		nRow.className = "school_details_link";
		return nRow;
	},
	"aoColumns": [{
		"bSortable": false,
		"mRender": checkbox
	}, { "mRender": linkView }, {"mRender" : alignCenter}, {"mRender" : alignCenter}, {"mRender" : alignCenter}, null, { "bSortable": false }]
});

$(document).ready(function () {
	$('body').on('click', '.school_details_linkk td:not(:first-child, :last-child)', function () {
		$('#myModal').modal({
			remote:
				site.base_url +
				'schools/view/' +
				$(this)
					.parent('.school_details_link')
					.attr('id'),
		});
		$('#myModal').modal('show');
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
}).on('click','.po-delete-school', function(e){
	e.preventDefault();
    $('.po').popover('hide');
    var link = $(this).attr('href');
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