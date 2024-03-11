$(function () {
	"use strict";

	oTable = $('#BusTable').dataTable({
        "aaSorting": [[2, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 500]],
        "iDisplayLength": 10,
        'bProcessing': true, 'bServerSide': true,
        'sAjaxSource': 'cities/getCities',
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
        }, null, null, {"mRender": city_status}, {"bSortable": false}]
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
			data: {school: school, type:type, route:route},
		})
		.done(function(data) {
			$('#grid').html(data);
			$('#save').removeClass('disabled');
			$('#print').removeClass('disabled');
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});		
	}).on('change','.check', function(e){
		if (e && e.preventDefault) {
			e.preventDefault();
		}
		if ($(this).is(':checked')) {
			var element = $(this).parent().parent();	
			element.find('select').attr('disabled',false);	
			element.find('input[type="number"]').attr('disabled',false);
		} else {
			var element = $(this).parent().parent();	
			element.find('select').attr('disabled',true);
			element.find('input[type="number"]').attr('disabled',true);	
		}
	});
});