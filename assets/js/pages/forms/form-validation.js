jQuery(function () {
    jQuery('#form_validation').validate({
        rules: {
            'checkbox': {
                required: true
            },
            'gender': {
                required: true
            }
        },
        highlight: function (input) {
            jQuery(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            jQuery(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            jQuery(element).parents('.form-group').append(error);
        }
    });

    //Advanced Form Validation
    jQuery('#form_advanced_validation').validate({
        rules: {
            'date': {
                customdate: true
            },
            'creditcard': {
                creditcard: true
            }
        },
        highlight: function (input) {
            jQuery(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            jQuery(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            jQuery(element).parents('.form-group').append(error);
        }
    });

    //Custom Validations ===============================================================================
    //Date
    jQuery.validator.addMethod('customdate', function (value, element) {
        return value.match(/^\d\d\d\d?-\d\d?-\d\djQuery/);
    },
        'Please enter a date in the format YYYY-MM-DD.'
    );

    //Credit card
    jQuery.validator.addMethod('creditcard', function (value, element) {
        return value.match(/^\d\d\d\d?-\d\d\d\d?-\d\d\d\d?-\d\d\d\djQuery/);
    },
        'Please enter a credit card in the format XXXX-XXXX-XXXX-XXXX.'
    );
    //==================================================================================================
});