    $(document).ready(function() {
        $.validate({
        form: '#form_indentity',
        lang: 'en',
        modules: 'security, html5, file',
        showErrorDialogs: true,
        onError: function($form) {
            alert('Form Error!');
        },
        onSuccess: function($form) {
            var _action = $form.attr('action');
            var _method = $form.attr('method');
            var _data = new FormData($form.get(0));
            // var _data = $form.serialize();
            $.ajax({
                url: _action,
                method: _method,
                data: _data,
                processData: false,
                // contentType: false,
                cache: false,
                dataType: 'json',
                beforeSend: function() {
                    $('button[type=submit]').prop('disabled', true).html('Processing...');
                },
                success: function(response) {
                    alert(response.msg);
                    $('button[type=submit]').prop('disabled', true).html(`Processing...`);
                    if (response.valid == true) {
                        $form.get(0).reset();
                        setTimeout(() => {
                        $('button[type=submit]').prop('disabled', false).html(`<i class="fas fa-mail-bulk"></i> Simpan & Lanjutkan Login`);
                        window.location.replace(response.redirect);
                        }, 2500);
                    } else {
                        $('button[type=submit]').prop('disabled', false).html(`<i class="fas fa-mail-bulk"></i> Simpan & Lanjutkan Login`);
                    }
                },
                error: function(err) {
                    $('button[type=submit]').prop('disabled', false).html(`<i class="fas fa-mail-bulk"></i> Simpan & Lanjutkan Login`);
                    alert('Terjadi kesalahan dalam pengiriman data');
                    console.log(err.responseText);
                }
            });
            return false; // Will stop the submission of the form
        }
    });
    });
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
    $("input[name='photo_pic']").change(function() {
         readURL(this, $('img.photo_pic'));
    });
    $("input[name='photo_ktp']").change(function() {
        readURL(this, $('img.photo_ktp'));
    });