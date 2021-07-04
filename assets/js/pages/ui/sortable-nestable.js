jQuery(function () {
	jQuery('.dd').nestable();

	jQuery('.dd').on('change', function () {
		var jQuerythis = jQuery(this);
		var serializedData = window.JSON.stringify(jQuery(jQuerythis).nestable('serialize'));

		jQuerythis.parents('div.body').find('textarea').val(serializedData);
	});
});
