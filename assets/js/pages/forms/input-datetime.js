jQuery(function () {

	//Datetimepicker plugin
	jQuery('.datetimepicker').bootstrapMaterialDatePicker({
		format: 'dddd DD MMMM YYYY - HH:mm',
		clearButton: true,
		weekStart: 1
	});

	jQuery('.datepicker').bootstrapMaterialDatePicker({
		format: 'dddd DD MMMM YYYY',
		clearButton: true,
		weekStart: 1,
		time: false
	});

	jQuery('.timepicker').bootstrapMaterialDatePicker({
		format: 'HH:mm',
		clearButton: true,
		date: false
	});

	//Bootstrap datepicker plugin
	jQuery('#bs_datepicker_container input').datepicker({
		autoclose: true,
		container: '#bs_datepicker_container'
	});

	jQuery('#bs_datepicker_component_container').datepicker({
		autoclose: true,
		container: '#bs_datepicker_component_container'
	});
	//
	jQuery('#bs_datepicker_range_container, #datepicker_range_2').datepicker({
		autoclose: true,
		container: '#bs_datepicker_range_container'
	});

});
