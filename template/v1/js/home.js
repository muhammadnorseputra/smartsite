function explore() {
    document.querySelector('section.content-home').scrollIntoView({
        behavior: 'smooth',
        block: "start"
    })
}

$(document).ready(function() {

    // get all berita
    var limit = 3;
    var start = 0;
    var action = "inactive";
    console.log(_uriSegment);
    let $url = $host ? _uriSegment[2] : _uriSegment[3];

    if ($url == 'beranda') {
        function lazzy_loader(limit) {
            var output = "";
            for (var count = 0; count < 1; count++) {
                output += `
                <div class="card border border-light shadow-sm mb-3">
                    <div class="card-header border-0 bg-white">
                    <p>
                    <span class="content-placeholder rounded-circle float-left mr-3" style="width:50px; height: 50px;">&nbsp;</span>

                    <span class="content-placeholder rounded-lg float-left"
                    style ="width:50%; height: 50px;"> &nbsp; </span>

                    <span class ="content-placeholder rounded-circle float-right mt-1 mr-3"
                    style ="width:40px; height: 40px;"> &nbsp; </span>
                    </p> 
                    </div> 
                    <div class = "card-body p-0">
                    <span class ="content-placeholder rounded-0" style = "width:100%; height: 300px;"> &nbsp; </span>
                    <span class="content-placeholder rounded-lg my-2 mx-4"
                    style ="width:90%; height: 30px;"> &nbsp; </span>
                    <span class="content-placeholder rounded-lg my-2 mx-4"
                    style ="width:90%; height: 50px;"> &nbsp; </span>
                    </div> 
                    <div class ="card-footer text-muted p-3 bg-transparent" >
                     <span class ="content-placeholder rounded-circle mr-2"
                    style ="width:45px; height: 45px;"> &nbsp; </span>
                    <span class ="content-placeholder rounded-circle mr-2"
                    style ="width:45px; height: 45px;"> &nbsp; </span>
                    <span class ="content-placeholder rounded-circle mr-2"
                    style ="width:45px; height: 45px;"> &nbsp; </span>
                    <span class ="content-placeholder rounded-circle"
                    style ="width:45px; height: 45px;"> &nbsp; </span>

                    <span class ="content-placeholder rounded-circle float-right"
                    style ="width:45px; height: 45px;"> &nbsp; </span>
                    </div> 
                </div>
            `;
            }
            $("#load_data_message").html(output);
            $("button#load_more").text('Loading...').prop('disabled', true);
        }

        lazzy_loader(limit);

        function load_data(limit, start) {
            $.ajax({
                url: _uri + '/frontend/v1/beranda/get_all_berita',
                method: "POST",
                data: {
                    limit: limit,
                    start: start,
                },
                cache: false,
                dataType: "json",
                success: function(data) {
                    if (data.html == "") {
                        $("#load_data_message").html(
                            `<div class="card border-0 bg-transparent shadow-none mb-5">
                                <div class="card-body text-danger text-center">
                                <img src="${_uri}/template/v1/img/humaaans-3.png" alt="croods" class="img-fluid rounded">
                                    <h5 class="card-title">Yahhh! abis</h5>  
                                    <p class="font-weight-light text-secondary"> Berita yang anda load mungkin telah berakhir.</p>
                                </div>
                            </div>`
                        );
                        $("button#load_more").hide();
                        action = "active";
                    } else {
                        $("#load_data").append(data.html);
                        $("#load_data_message").html("");
                        $("button#load_more").html(`<i class="fas fa-newspaper mr-2"></i> Load more berita`).prop('disabled', false);
                        action = "inactive";
                        $(".lazy").lazy({
                            beforeLoad: function(element) {
                                element.addClass('beforeLoaded');
                            },
                            afterLoad: function(element) {
                                element.addClass('isLoaded').removeClass('lazy beforeLoaded');
                            }
                        });
                        $(".rippler").rippler({
                            effectClass: 'rippler-effect'
                        });
                        // Tooltips
                        $('[data-toggle="tooltip"]').tooltip({
                            delay: 300,
                            offset: '0,10px',
                            padding: 8
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
            load_data(limit, start);
        }

        // $(window).scroll(function() {
        //     if (
        //         $(window).scrollTop() + $(window).height() > $("#load_data").height() &&
        //         action == "inactive"
        //     ) {
        //         lazzy_loader(limit);
        //         action = "active";
        //         start = start + limit;
        //         setTimeout(function() {
        //             load_data(limit, start);
        //         }, 300);
        //     }
        // });
        $("button#load_more").on("click", function(e) {
            e.preventDefault();
            if (action == "inactive") {
                lazzy_loader(limit);
                action = "active";
                start = start + limit;
                setTimeout(function() {
                    load_data(limit, start);
                }, 300);
            }
        })
    } else {
        console.log('Semua berita tidak ditampilkan, karna bukan halaman beranda');
    }

    $("button#caripost").on("click", function() {
        $("#mpostseacrh").modal('show');
        $("input[name='q']").focus();
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
            _container.html('<h5 class="mx-auto text-center text-secondary">Kata kunci belum kamu masukan?</h5>');
        }

        function lazzy() {
            _container.html('<div id="loader" class="mx-auto my-5"></div>');
        }

        if (_input.value.length > 3) {
            $.ajax({
                url: _this[0].action,
                method: "POST",
                data: {
                    q: _input.value
                },
                cache: false,
                dataType: "html",
                beforeSend: lazzy,
                timeout: 1000,
                success: function(data) {
                    _container.html(data);
                },
                error: function(xhr) {
                    alert('error function');
                },
            });
        }
        // console.log(_this[0].action);
    });
});