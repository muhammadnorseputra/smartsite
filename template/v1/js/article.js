$(function() {
    // get all berita
    var limit = 6;
    var start = 1;
    var action = "inactive";
    let $url = $host ? _uriSegment[2] : _uriSegment[1];

    if ($url == 'beranda') {

        function load_data_message() {

            $("#load_data_message").html(
                `
                <div class="p-3 bg-white rounded-bottom border-left border-top-0 border-bottom border-right">
                    <p class="font-weight-light text-muted text-center"><i class="fas fa-check-circle mr-2 text-success"></i> Postingan sudah ditampilkan semua</p>
                </div>
                `
            );

        }

        function lazzy_loader(limit) {
            var output = "";
            for (var count = 0; count < 1; count++) {
            output += `<div class="d-flex justify-content-center align-items-center bg-white rounded-bottom border-left border-top-0 border-bottom border-right">
                        <img src="${_uri}/assets/images/loader/simple-pre-loader/loader-icons-set-2-32x64x128/64x64/Preloader_2.gif">
                    </div>`;
            }
            $("#load_data_message").html(output);
        }

        lazzy_loader(limit);

        function load_data(limit, start) {
            $.ajax({
                url: _uri + '/frontend/v1/beranda/get_all_berita',
                method: "POST",
                headers: {'X-Requested-With': 'XMLHttpRequest'},
                data: {
                    limit: limit,
                    start: start,
                    type: urlParams.get('type'),
                    sort: urlParams.get('sort')
                },
                cache: true,
                dataType: "json",
                success: function(data) {
                    if (data.html == "") {
                        load_data_message();
                        $("button#load_more").hide();
                        action = "active";
                    } else {
                        if (data.count < limit) {
                            $("button#load_more").hide();
                            load_data_message();
                        } else {
                            $("#load_data_message").html("");
                        }
                        $("#load_data").append(data.html);
                        action = "inactive";

                        $(".lazy").lazy({
                            effect: 'fadeIn',
                            effectTime: 250,
                            threshold: 0,
                            enableThrottle: true,
                            combined: true,
                            delay: 1000,
                            throttle: 550,
                            afterLoad: function(element) {
                                element.removeClass('blured');
                            },
                            beforeLoad: function(element) {
                                element.addClass('blured');
                            },
                            onFinishedAll: function() {
                                if( !this.config("autoDestroy") )
                                    this.destroy();
                            },
                            // called whenever an element could not be handled
                            onError: function(element) {
                                var imageSrc = element.data('src');
                                element.attr('src', `${_uri}/assets/images/noimage.gif`)
                            }
                        });
                        // Tooltips
                        $('[data-toggle="tooltip"]').tooltip({
                            delay: 250,
                            offset: '0, 12px',
                            padding: 15
                        });
                    }
                },
                error: function(xhr) {
                    alert("Error dalam meload berita, created_by tidak ditemukan.");
                },
            });
        }

        if (action == "inactive") {
            action = "active";
            setTimeout(() => {
                load_data(limit, start);
            }, 3000);
        }

        $(window).scroll(function() {
             if (
                 $(window).scrollTop() + $(window).height() > $("#load_data").height() &&
                 action == "inactive"
             ) {
                 lazzy_loader(limit);
                 action = "active";
                 start = start + limit;
                 setTimeout(() => {
                    load_data(limit, start);
                 }, 3000);
             }
         });

        /*$("button#load_more").on("click", function(e) {
            e.preventDefault();
                if ($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == "inactive") {
                    action = "active";
                    start = start + limit;
                    lazzy_loader(limit);
                    load_data(limit, start);
                }
            });*/
    } else {
        console.log('Semua berita tidak ditampilkan, karna bukan halaman beranda');
    }
});