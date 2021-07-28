$(function() {
    // get all berita
    var limit = 3;
    var start = 0;
    var action = "inactive";
    let $url = $host ? _uriSegment[2] : _uriSegment[1];

    if ($url == 'beranda') {

        function load_data_message() {

            $("#load_data_message").html(
                `<div class="card border-0 bg-transparent shadow-none mb-5">
                        <div class="card-body text-danger text-center">
                        <img src="${_uri}/template/v1/img/humaaans-3.png" alt="croods" class="img-fluid rounded">
                            <h5 class="card-title">Yahhh! abis</h5>  
                            <p class="font-weight-light text-secondary"> Berita telah berakhir.</p>
                        </div>
                    </div>`
            );

        }

        function lazzy_loader(limit) {
            var output = "";
            for (var count = 0; count < 1; count++) {
            /*    output += `
                <div class="card border-0 bg-white mb-3" style="border-radius:5px;">
                    <div class="card-header border-0 bg-white" style="border-radius:5px;">
                    <p>
                    <span class="content-placeholder rounded-circle float-left mr-3" style="width:40px; height: 40px;">&nbsp;</span>
                    <span class="content-placeholder rounded-lg float-left"
                    style ="width:40%; height: 40px; border-radius: 15px;"> &nbsp; </span>

                    <span class ="content-placeholder rounded-circle float-right mt-1 mr-3"
                    style ="width:40px; height: 40px;"> &nbsp; </span>
                    </p> 
                    </div> 
                    <div class ="card-body p-0 border-0">
                        <span class ="content-placeholder" style="width:100%; height: 320px; border-radius:15px;"> &nbsp; </span>
                    </div> 
                    <div class ="card-footer d-flex justify-content-bettwen p-3 bg-transparent border-0">
                        <span class="content-placeholder rounded w-100 mr-2 p-2"> &nbsp; </span>
                        <span class="content-placeholder rounded w-100 mr-2 p-2"> &nbsp; </span>
                        <span class="content-placeholder rounded w-100 mr-2 p-2"> &nbsp; </span>
                        <span class="content-placeholder rounded w-100 p-2"> &nbsp; </span>
                    </div> 
                </div>
            `;
            */
            output += `<div class="d-flex justify-content-center align-items-center my-5">
                            <div class="loader_small" style="width:50px;height:50px;"></div>
                        </div>`;
            }
            $("#load_data_message").html(output);
            $("button#load_more").html(`<div class="d-flex justify-content-center align-items-center">
        <div class="loader_small" style="width:20px; height: 20px;"></div>
      </div> `).prop('disabled', true);
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
                        $("button#load_more").html(`<i class="fas fa-newspaper mr-2"></i> Berita Sebelumnya`).prop('disabled', false);
                        action = "inactive";

                        $(".lazy").lazy({
                            beforeLoad: function(element) {
                                element.addClass('beforeLoaded');
                            },
                            afterLoad: function(element) {
                                element.addClass('isLoaded').removeClass('lazy beforeLoaded');
                            }
                        });
                        // Ripple
                        $(".rippler").rippler({
                            effectClass: 'rippler-effect'
                        });
                        // Tooltips
                        $('[data-toggle="tooltip"]').tooltip({
                            delay: 300,
                            offset: '0,10px',
                            padding: 10
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
                window.scrollBy(0,-250);
                lazzy_loader(limit);
                action = "active";
                start = start + limit;
                // setTimeout(function() {
                    load_data(limit, start);
                // }, 300);
            }
        })
    } else {
        console.log('Semua berita tidak ditampilkan, karna bukan halaman beranda');
    }
});