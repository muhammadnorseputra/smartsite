    $(document).ready(function() {
        $.validate({
        form: '#form_indentity',
        lang: 'en',
        modules: 'security, html5, file',
        showErrorDialogs: true,
        onError: function($form) {
            alert('File tidak sesuai ketentuan, cek lagi !');
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
                contentType: false,
                cache: false,
                dataType: 'json',
                beforeSend: function() {
                    $('button[type=submit]').prop('disabled', true).html('Processing...');
                    $.blockUI({ message: '<h2> Processing ...</h2>', css: { backgroundColor: '#000', color: '#fff'} });
                },
                success: function(response) {
                    $('button[type=submit]').prop('disabled', true).html(`Processing...`);
                    $.blockUI({ message: '<h2> Uploading Indentity ...</h2>', css: { backgroundColor: '#000', color: '#fff'} });
                    if (response.valid == true) {
                        $form.get(0).reset();
                        setTimeout(() => {
                        $('button[type=submit]').prop('disabled', false).html(`<i class="fas fa-mail-bulk"></i> Simpan & Lanjutkan Login`);
                        $.blockUI({ message: '<h2> Success ...</h2>',
                                    timeout: 2500, 
                                    onUnblock: function(){ window.location.replace(response.redirect); $.unblockUI(); },
                                    css: { backgroundColor: '#000', color: '#fff'} });
                        }, 2500);
                    } else {
                        $.unblockUI();
                        $('button[type=submit]').prop('disabled', false).html(`<i class="fas fa-mail-bulk"></i> Simpan & Lanjutkan Login`);
                    }
                },
                error: function(err) {
                    $('button[type=submit]').prop('disabled', false).html(`<i class="fas fa-mail-bulk"></i> Simpan & Lanjutkan Login`);
                    alert('Terjadi kesalahan dalam pengiriman data');
                    console.log(err);
                    $.unblockUI();
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