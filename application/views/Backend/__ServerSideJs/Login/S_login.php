<script type="text/javascript">
    var $root = location.protocol; //http: or https
    var $hostname = location.hostname //putra.com
    var $origin = location.origin; //http://sub.domain.com

    function focus() {
        return $("[name='username']").focus();
    }

    $('.loginBoxes,.login-footer,img').hide();

    Pace.on('done', function() {
        $('.loginBoxes, .login-footer, img').show();
        focus();
    });

    jQuery('#sign_in').validate({
        rules: {
            'username': {
                required: true
            },
            'password': {
                required: true
            },
            'validasi': {
                number: true,
                required: true
            }
        },
        highlight: function(input) {
            $(input).parents('.input-group .form-line').addClass('error');
        },
        unhighlight: function(input) {
            $(input).parents('.input-group .form-line').removeClass('error');
        },
        errorPlacement: function(error, element) {
            // $(element).parents('.input-group .form-line').append(error);
            showNotification('bg-greadient-redpurple', error[0].innerText, 'bottom', 'left', 'animated slideInDown', 'animated fadeOut');
        },
        messages: {
            username: {
                required: "Username masih kosong !"
            },
            password: {
                required: "Password masih kosong !"
            },
            validasi: {
                required: "Validasi belum diisi !",
                number: "Hanya boleh angka"
            }
        },
        onsubmit: true,
        focusCleanup: false
    });
    //Animasi Notifikasi
    $.fn.extend({
        animateCss: function(animationName) {
            var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
            jQuery(this).addClass('animated ' + animationName).one(animationEnd, function() {
                jQuery(this).removeClass('animated ' + animationName);
            });
        }
    });

    var audio = document.getElementById("BgmLogin");
    audio.volume = 0.2;

    function audioVolumeIn(q) {
        if (q.volume) {
            var InT = 0;
            var setVolume = 0.2; // Target volume level for new song
            var speed = 0.005; // Rate of increase
            q.volume = InT;
            var eAudio = setInterval(function() {
                InT += speed;
                q.volume = InT.toFixed(1);
                if (InT.toFixed(1) >= setVolume) {
                    clearInterval(eAudio);
                    //alert('clearInterval eAudio'+ InT.toFixed(1));
                };
            }, 50);
        };
    };

    audioVolumeOut(0.2);

    function audioVolumeOut(q) {
        if (q.volume) {
            var InT = 0.2;
            var setVolume = 0; // Target volume level for old song 
            var speed = 0.005; // Rate of volume decrease
            q.volume = InT;
            var fAudio = setInterval(function() {
                InT -= speed;
                q.volume = InT.toFixed(1);
                if (InT.toFixed(1) <= setVolume) {
                    clearInterval(fAudio);
                    //alert('clearInterval fAudio'+ InT.toFixed(1));
                };
            }, 50);
        };
    };


    $("#sign_in").on('submit', function(e) {
        e.preventDefault();
        var form = jQuery(this);
        var Username = jQuery("[name='username']").val();
        var Password = jQuery("[name='password']").val();
        var Valid = jQuery("[name='validasi']").val();
        var Validasi_hidden = jQuery("[name='validasi_hidden']").val();

        if (Username == '') {
            $("[name='username']").focus();
        } else if (Password == '') {
            $("[name='password']").focus();
        } else if (Valid == '') {
            $("[name='validasi']").focus();
        } else if (Validasi_hidden != Valid) {
            $('.card').animateCss('shake');
            $("[name='validasi']").focus();
            $("button#login").html(`<em class="glyphicon glyphicon-send m-r-10"></em> MASUK`);
            $("[name='validasi']").val('').focus();
        } else {
            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: {
                    user: Username,
                    pass: Password
                },
                dataType: 'json',
                beforeSend: function() {
                    $('.loginBoxes,.login-footer').fadeOut('slow');
                    $("[type='button']#login").html('<img src="<?php echo site_url('assets/images/loader-ajax.gif'); ?>">');
                    $.blockUI({
                        message: '<center><img src="<?= base_url('bower_components/SVG-Loaders/svg-loaders/oval.svg'); ?>"></center>',
                        css: {
                            border: '',
                            width: '400px',
                            backgroundColor: 'trasparent',
                        },
                        overlayCSS: {
                            backgroundColor: '#E9EDFB',
                            opacity: 0.9
                        }
                    });
                },
                success: function(response) {
                    if (response.sts == 1) {
                        
                        showNotification('bg-teal', 'Login berhasil !!! Pengalihan halaman mohon tunggu.', 'top', 'center', 'none', 'none');

                        // setTimeout(function(){ 
                        //     window.location.replace('backend/c_admin?module='+response.home+'&?user=' + response.user_access[0].user_access);
                        //     jQuery.Mprog.starts(3, 'body', false).end(true);
                        // }, 3000);
                        $.unblockUI({
                            onUnblock: function() {
                                window.location.replace($origin + '/backend/c_admin?module=' + response.home + '&?user=' + response.user_access[0].user_access);
                                // showNotification('bg-greadient-greenlightgreen', 'Login berhasil !!! Pengalihan halaman mohon tunggu.', 'top', 'center', 'none', 'animated bounceOutUp');
                            }
                        });


                    } else if (response.sts == 0) {

                    $('.loginBoxes,.login-footer,img').fadeIn('fast');
                        focus();
                        $('.card').animateCss('shake');
                        showNotification('bg-greadient-redpurple', '<b><b>Sorry!</b> Username & Password Salah</b>', 'top', 'center', 'animated fadeIn', 'animated fadeOut');
                        $("button#login").html(`<em class="glyphicon glyphicon-send m-r-10"></em> MASUK`);
                        $("input[type='password'],input[type='text']").val('');
                        // jQuery.Mprog.starts(3, 'body', false).end(true);
                        $.unblockUI();
                    }
                },
                error: function() {
                    $('.card').animateCss('shake');
                    $("button#login").html(`<em class="glyphicon glyphicon-send m-r-10"></em> MASUK`);
                    acak_angka();
                    $('#msg').html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                        '<b>505</b> Internal Server Mengalami Masalah' +
                        '</div>');
                }
            });

        }

    });

    // SHOW AND HIDE PASSWORD
    $(".toggle-password").click(function() {
        $(".icon").toggleClass("glyphicon-eye-close");
        var input = $(jQuery(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

    // FUNGSI VALIDASI PENJUMLAHAN ANGKA
    acak_angka();

    function acak_angka() {
        var rand_pertama = Math.floor(Math.random() * 20) + 1;
        var rand_kedua = Math.floor(Math.random() * 30) + 1;

        jQuery("#angak_pertama").html("<b>" + rand_pertama + "</b>");
        jQuery("#angak_kedua").html("<b>" + rand_kedua + "</b>");

        var hasil = parseInt(rand_pertama) + parseInt(rand_kedua);
        jQuery("[name='validasi_hidden']").val(hasil);
    }

    function repeat() {
        acak_angka();
    }
</script>
