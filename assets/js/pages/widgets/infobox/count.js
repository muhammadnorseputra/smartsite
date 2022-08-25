jQuery(function () {

	//Widgets count
	jQuery('.count-to').countTo();

	//Sales count to
	jQuery('.sales-count-to').countTo({
		formatter: function (value, options) {
			return value.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, ' ').replace('.', ',');
		}
	});

});
