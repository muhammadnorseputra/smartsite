$(document).ready(function() {
    $.validate({
        form: '#f-survei-non-asn',
        modules: 'toggleDisabled, date, security, html5, sanitize',
        disabledFormFilter: 'form.toggle-disabled',
        showErrorDialogs: true,
        reCaptchaSiteKey: '6LfiM08bAAAAAJkf5geIEBau6f9-kMOEzxkxw06_',
        reCaptchaTheme: 'light',
        onError: function($form) {
            alert('Formulir ' + $form.attr('id') + ' gagal, cek kembali kelengkapan survei!');
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
                    $('button[type=submit]').text('Proccessing ...');
                },
                dataType: 'json',
                success: function(response) {
                    if (response.valid == true) {
                        // window.location.replace("<?= base_url('frontend/v1/daftar/') ?>");
                        alert(response.msg);
                        $form.get(0).reset();
                        $('button[type=submit]').text('Submit');
                    }
                },
                error: function(_error) {
                    $('button[type=submit]').text('Submit');
                    alert('error');
                }
            });
            return false; // Will stop the submission of the form
        },
    });
});