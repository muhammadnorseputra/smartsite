jQuery(function () {

	//Masked Input ============================================================================================================================
	var jQuerydemoMaskedInput = jQuery('.masked-input');

	//Date
	jQuerydemoMaskedInput.find('.date').inputmask('dd/mm/yyyy', {
		placeholder: '__/__/____'
	});

	//Time
	jQuerydemoMaskedInput.find('.time12').inputmask('hh:mm t', {
		placeholder: '__:__ _m',
		alias: 'time12',
		hourFormat: '12'
	});
	jQuerydemoMaskedInput.find('.time24').inputmask('hh:mm', {
		placeholder: '__:__ _m',
		alias: 'time24',
		hourFormat: '24'
	});

	//Date Time
	jQuerydemoMaskedInput.find('.datetime').inputmask('d/m/y h:s', {
		placeholder: '__/__/____ __:__',
		alias: "datetime",
		hourFormat: '24'
	});

	//Mobile Phone Number
	jQuerydemoMaskedInput.find('.mobile-phone-number').inputmask('+99 (999) 999-99-99', {
		placeholder: '+__ (___) ___-__-__'
	});
	//Phone Number
	jQuerydemoMaskedInput.find('.phone-number').inputmask('+99 (999) 999-99-99', {
		placeholder: '+__ (___) ___-__-__'
	});

	//Dollar Money
	jQuerydemoMaskedInput.find('.money-dollar').inputmask('99,99 jQuery', {
		placeholder: '__,__ jQuery'
	});
	//Euro Money
	jQuerydemoMaskedInput.find('.money-euro').inputmask('99,99 â‚¬', {
		placeholder: '__,__ â‚¬'
	});

	//IP Address
	jQuerydemoMaskedInput.find('.ip').inputmask('999.999.999.999', {
		placeholder: '___.___.___.___'
	});

	//Credit Card
	jQuerydemoMaskedInput.find('.credit-card').inputmask('9999 9999 9999 9999', {
		placeholder: '____ ____ ____ ____'
	});

	//Email
	jQuerydemoMaskedInput.find('.email').inputmask({
		alias: "email"
	});

	//Serial Key
	jQuerydemoMaskedInput.find('.key').inputmask('****-****-****-****', {
		placeholder: '____-____-____-____'
	});

});
