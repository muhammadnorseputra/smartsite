jQuery(function () {
	//Horizontal form basic
	jQuery('#wizard_horizontal').steps({
		headerTag: 'h2',
		bodyTag: 'section',
		transitionEffect: 'slideLeft',
		onInit: function (event, currentIndex) {
			setButtonWavesEffect(event);
		},
		onStepChanged: function (event, currentIndex, priorIndex) {
			setButtonWavesEffect(event);
		}
	});

	//Vertical form basic
	jQuery('#wizard_vertical').steps({
		headerTag: 'h2',
		bodyTag: 'section',
		transitionEffect: 'slideLeft',
		stepsOrientation: 'vertical',
		onInit: function (event, currentIndex) {
			setButtonWavesEffect(event);
		},
		onStepChanged: function (event, currentIndex, priorIndex) {
			setButtonWavesEffect(event);
		}
	});

	//Advanced form with validation
	var form = jQuery('#wizard_with_validation').show();
	form.steps({
		headerTag: 'h3',
		bodyTag: 'fieldset',
		transitionEffect: 'slideLeft',
		onInit: function (event, currentIndex) {
			jQuery.AdminBSB.input.activate();

			//Set tab width
			var jQuerytab = jQuery(event.currentTarget).find('ul[role="tablist"] li');
			var tabCount = jQuerytab.length;
			jQuerytab.css('width', (100 / tabCount) + '%');

			//set button waves effect
			setButtonWavesEffect(event);
		},
		onStepChanging: function (event, currentIndex, newIndex) {
			if (currentIndex > newIndex) {
				return true;
			}

			if (currentIndex < newIndex) {
				form.find('.body:eq(' + newIndex + ') label.error').remove();
				form.find('.body:eq(' + newIndex + ') .error').removeClass('error');
			}

			form.validate().settings.ignore = ':disabled,:hidden';
			return form.valid();
		},
		onStepChanged: function (event, currentIndex, priorIndex) {
			setButtonWavesEffect(event);
		},
		onFinishing: function (event, currentIndex) {
			form.validate().settings.ignore = ':disabled';
			return form.valid();
		},
		onFinished: function (event, currentIndex) {
			swal("Good job!", "Submitted!", "success");
		}
	});

	form.validate({
		highlight: function (input) {
			jQuery(input).parents('.form-line').addClass('error');
		},
		unhighlight: function (input) {
			jQuery(input).parents('.form-line').removeClass('error');
		},
		errorPlacement: function (error, element) {
			jQuery(element).parents('.form-group').append(error);
		},
		rules: {
			'confirm': {
				equalTo: '#password'
			}
		}
	});
});

function setButtonWavesEffect(event) {
	jQuery(event.currentTarget).find('[role="menu"] li a').removeClass('waves-effect');
	jQuery(event.currentTarget).find('[role="menu"] li:not(.disabled) a').addClass('waves-effect');
}
