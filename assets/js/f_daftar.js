$(document).ready(function() {
    $.validate({
        form: '#form_daftar',
        lang: 'en',
        modules: 'date, security, html5, sanitize',
        onModulesLoaded: function() {
            $('#alamat').restrictLength($('#maxlength'));
        },
        // disabledFormFilter: 'form.toggle-disabled',
        showErrorDialogs: true,
        // validateOnEvent: true,
        onError: function($form) {
            $('#content2').notifyModal({
                duration: 2500,
                placement: 'center',
                overlay: true,
                type: 'danger', //simple, dark
                icon: false,
                onLoad: function(el) {
                    el.find(".content_inner").html('Validation of form ' + $form.attr('id') + ' failed!');
                },
                // onClose: function(el) {
                //     $form.get(0).reset();
                // }
            });
        },
        onSuccess: function($form) {
            var _action = $form.attr('action');
            var _method = $form.attr('method');
            // var _data = new FormData($form);
            var _data = $form.serialize();
            $.ajax({
                url: _action,
                method: _method,
                data: _data,
                dataType: 'json',
                beforeSend: function() {
                    $('button[type=submit]').prop('disabled', true).html('<div class="d-flex justify-content-center align-items-center"><div style="width: 30px; height:30px;" class="loader_small"></div></div>');
                },
                success: function(response) {
                    $('#content2').notifyModal({
                        duration: 2500,
                        placement: 'center',
                        overlay: true,
                        type: 'simple', //simple, dark
                        icon: false,
                        onLoad: function(el) {
                            el.find(".content_inner").html(response.msg);
                        }
                    });
                    $('button[type=submit]').prop('disabled', true).html(`<div class="d-flex justify-content-center align-items-center"><div style="width: 30px; height:30px;" class="loader_small"></div></div>`);
                    if (response.valid == true) {
                        // window.location.replace("<?= base_url('frontend/v1/daftar/') ?>");
                        $form.get(0).reset();
                        setTimeout(() => {
                        $('button[type=submit]').prop('disabled', false).html(`<i class="fas fa-check mr-2"></i> Daftar`);
                        window.location.replace(response.redirect);
                        }, 2500);
                    } else {
                        $('button[type=submit]').prop('disabled', false).html(`<i class="fas fa-check mr-2"></i> Daftar`);
                    }
                },
                error: function(_error) {
                    $('button[type=submit]').prop('disabled', false).html(`<i class="fas fa-check mr-2"></i> Daftar`);
                    $('#content2').notifyModal({
                        duration: 2500,
                        placement: 'center',
                        overlay: true,
                        type: 'danger', //simple, dark
                        icon: false,
                        onLoad: function(el) {
                            el.find(".content_inner").html('Terjadi kesalahan dalam pengiriman data');
                        }
                    });
                }
            });
            return false; // Will stop the submission of the form
        }
    });
    // Callendar Event
    $('#tl-container input#tl').datepicker({
        clearBtn: true,
        forceParse: true,
        calendarWeeks: true,
        autoclose: true,
        format: 'dd/mm/yyyy',
        todayHighlight: false,
        toggleActive: true,
    });
    // API 
    $('#nohp').mask('0000-0000-0000', {
        placeholder: "____   -   ____   -  ____",
        selectOnFocus: true
    });
    $('#tl').mask('00/00/0000', {
        placeholder: "__/__/____"
    });
});