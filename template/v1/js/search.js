$(function() {
    $("button.post-search").on("click", function() {
        $("#mpostseacrh").modal('show');
        $("input[name='q']").focus();
    });

    $("a.post-search").on("click", function() {
        $("#mpostseacrh").modal('show');
        $("input[name='q']").focus();
    });

    $("a#mobileMenuNav").on("click", function() {
        $("#mobileMenu").modal('show')
    });

    $('#mpostseacrh').on('hidden.bs.modal', function(e) {
        $("input[name='q']").val('');
        $("#form_post_search").submit();
    });

    $("#form_post_search").on("submit", function(e) {
        e.preventDefault();
        let _this = $(this);
        let _input = _this[0].q;
        let _container = $("#search-result");

        if (_input.value == '') {
            _container.html(`
                <div class="py-3 text-center">
                        <h6>Silahkan masukan katakunci !</h6>
                        <p class="text-muted small">
                            Silahkan masukan keywords pencarian, dengan memasukan judul atau label
                        </p>
                    </div>
            `);
        }

        function message(x, y) {
            notif({
                msg: `<i class='fas fa-info-circle mr-2'></i> ${x}`,
                type: y,
                position: "bottom",
                offset: -10
            });
        }

        function lazzy() {
            _container.html(`<div class="d-flex justify-content-center align-items-center"><img src="${_uri}/assets/images/loader/simple-pre-loader/loader-icons-set-2-32x64x128/64x64/Preloader_2.gif"></div>`);
        }

        if (_input.value.length > 3) {
            $.ajax({
                url: _this[0].action,
                method: "POST",
                data: {
                    q: _input.value
                },
                cache: false,
                dataType: "json",
                beforeSend: lazzy,
                timeout: 1000,
                success: function(res) {
                    _container.html(res.data);
                    if (res.count != '0') {
                        message(`${res.count} data ditemukan`, 'success');
                    }
                },
                error: function(xhr) {
                    message('error function', 'error');
                },
            });
        } else {
            message('Silahkan masukan min. 3 karakter.', 'warning');
        }
        // console.log(_this[0].action);
    });
})