$(function () {
	"use strict";
	$(document).on("ready", main);

	function trip_status(x){
		var y = x.split('__'), r = '';
    
	    if (y[0] =='T') {
	        r = '<span class="label label-success">'+
	        '<i class="fa fa-print"></i> Habilitado</span';
	    } else {
	        r = '<span class="label label-danger">'+
	        '<i class="fa fa-close"></i> Suspendido</span';
	    }
	    return r;
	}	

	function main(){
		show_data("");
	
		$("input[name=date]").change(function(){
			show_data($(this).val());
		});
		$(".today").click(function(){
			show_data("");
		});
	}

	function show_data(date){
		
		$.ajax({
			url : site.base_url + "collections/getTrips",
			type: "POST",
			data: {date : date},
			dataType:"html",
			success:function(response){
				$("#CollectionTable tbody").html(response);
			}
		});
	}

	$(document).on('change','.check', function(e){
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
	}).on('click','#type_day',function(){
		$('.box-day').show();
        $('.box-period').hide();
	}).on('click','#type_period',function(){
		$('.box-day').hide();
        $('.box-period').show();
	});
});