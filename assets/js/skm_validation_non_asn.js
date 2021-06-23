$(document).ready(function() {
    $.validate({
        form: '#f-survei-non-asn',
        modules: 'toggleDisabled, date, security, html5, sanitize',
        disabledFormFilter: 'form.toggle-disabled',
        showErrorDialogs: true,
        // reCaptchaSiteKey: '6LfiM08bAAAAAJkf5geIEBau6f9-kMOEzxkxw06_',
        // reCaptchaTheme: 'light',
        onError: function($form) {
            $.notify({
                icon: `fas fa-times`,
                title: '<strong>Gagal!</strong>',
                message: 'Formulir ' + $form.attr('id') + ' gagal, cek kembali kelengkapan survei!',
            }, {
                type: 'danger'
            });
        },
        onSuccess: function($form) {
            var _action = $form.attr('action');
            var _method = $form.attr('method');
            var _data = $form.serialize();
            $.ajax({
                url: _action,
                method: _method,
                data: _data,
                beforeSend: function() {
                    $.notify({
                        message: '<strong>Processing</strong>, Mohon tunggu mengirim data...',
                    }, {
                        type: 'warning',
                        allow_dismiss: false,
                        showProgressbar: true
                    });
                    $('.main').addClass('blured');
                    $('button[type=submit]').prop('disabled', true);
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status == true) {
                        setTimeout(function() {
                            // window.location.replace("<?= base_url('frontend/v1/daftar/') ?>");
                            $.notify({
                                'icon': 'far fa-check-circle',
                                'message': '<strong>Success</strong> Your survei has been saved!',
                            }, {
                                type: 'success',
                                timer: 500,
                                onClose: function() {
                                    window.location.replace(response.redirectTo);
                                    $('.main').removeClass('blured');
                                }
                            });
                            $.notify({
                                'icon': 'fas fa-external-link-alt',
                                'message': '<strong>Please wait rediracting ...</strong>',
                            }, {
                                type: 'info'
                            });
                            $form.get(0).reset();
                            $('button[type=submit]').prop('disabled', true);
                        }, 5000);
                    }
                },
                error: function(error) {
                    $('button[type=submit]').prop('disabled', false);
                    $.notify({
                        icon: 'fas fa-times',
                        title: '<strong>Error!</strong>',
                        message: error.responseText,
                    }, {
                        type: 'danger'
                    });
                }
            });
            return false; // Will stop the submission of the form
        },
    });
});