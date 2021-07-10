// Image Preview
function readURL(input, $element) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $($element).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}

$(document).ready(function() {
    $.validate({
        form: '#form_daftar',
        lang: 'en',
        modules: 'date, security, html5, file, sanitize',
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
                onClose: function(el) {
                    $form.get(0).reset();
                }
            });
        },
        onSuccess: function($form) {
            var _action = $form.attr('action');
            var _method = $form.attr('method');
            //   var _data   = $form.serialize();
            $.ajax({
                url: _action,
                method: _method,
                data: new FormData($form),
                processData: false,
                cache: false,
                beforeSend: function() {
                    $('button[type=submit]').text('Loading ...');
                },
                dataType: 'json',
                success: function(response) {
                    if (response.valid == true) {
                        // window.location.replace("<?= base_url('frontend/v1/daftar/') ?>");
                        $form.get(0).reset();
                        $('button[type=submit]').html(`<i class="fas fa-check mr-2"></i> Daftar`);
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
                    }
                },
                error: function(_error) {
                    $('button[type=submit]').html(`<i class="fas fa-check mr-2"></i> Daftar`);
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
        },
        onModulesLoaded: function() {
            $('#alamat').restrictLength($('#maxlength'));
        }
    });
    // Callendar Event
    $('#tl-container input#tl').datepicker({
        clearBtn: true,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: 'dd/mm/yyyy',
        todayHighlight: true,
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

    $("input[name='photo_pic']").change(function() {
        readURL(this, $('img.photo_pic'));
    });
    $("input[name='photo_ktp']").change(function() {
        readURL(this, $('img.photo_ktp'));
    });
});