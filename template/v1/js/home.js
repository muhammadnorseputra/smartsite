function explore() {
	document.querySelector('section.content-home').scrollIntoView({
		behavior: 'smooth',
		block: "start"
	})
}

$(document).ready(function () {
	
	// get all berita
	var limit = 7;
	var start = 0;
	var action = "inactive";

	function lazzy_loader(limit) {
		var output = "";
		for (var count = 0; count < 1; count++) {
			output += `
                <div class="card border border-light shadow-sm">
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
	}

	lazzy_loader(limit);

	function load_data(limit, start) {
		$.ajax({
			url: _uri+'/frontend/v1/beranda/get_all_berita',
			method: "POST",
			data: {
				limit: limit,
				start: start,
			},
			cache: false,
			dataType: "json",
			success: function (data) {
				if (data.html == "") {
					$("#load_data_message").html(
						`<div class="card border-0 bg-white shadow-sm mb-5">
                            <div class="card-body text-danger text-center">
                            <img src="${_uri}/template/v1/img/humaaans-3.png" alt="croods" class="img-fluid rounded">
                                <h5 class="card-title">Yahhh! abis</h5>  
                                <p class="font-weight-light text-secondary"> Berita yang anda load mungkin telah berada di penghujung data.</p>
                            </div>
                        </div>`
					);
					action = "active";
				} else {
					$("#load_data").append(data.html);
					$("#load_data_message").html("");
					action = "inactive";
					$(".lazy").lazy({
						beforeLoad: function (element) {
							element.addClass('beforeLoaded');
						},
						afterLoad: function (element) {
							element.addClass('isLoaded').removeClass('lazy beforeLoaded');
						}
					});
					$(".rippler").rippler({
						effectClass: 'rippler-effect'
					});
					// Tooltips
					$('[data-toggle="tooltip"]').tooltip({
						delay: 400,
						offset: '0,10px',
					    padding: 8
					});
				}
			},
			error: function (xhr) {
				alert("Error dalam meload berita, created_by tidak ditemukan.");
			},
		});
	}

	if (action == "inactive") {
		action = "active";
		load_data(limit, start);
	}

	$(window).scroll(function () {
		if (
			$(window).scrollTop() + $(window).height() > $("#load_data").height() &&
			action == "inactive"
		) {
			lazzy_loader(limit);
			action = "active";
			start = start + limit;
			setTimeout(function () {
				load_data(limit, start);
			}, 300);
		}
	});

	$("button#caripost").on("click", function() {
		$("#mpostseacrh").modal('show');
		$("input[name='q']").focus();
	});

	$("#form_post_search").on("submit", function(e) {
		e.preventDefault();
		let _this = $(this);
		let _input = _this[0].q;
		let _container = $("#search-result");

		if(_input.value == '') {
			_container.html('<h3 class="mx-auto text-center text-secondary">Data Not Found</h3>');
		} 

		function lazzy() {
			_container.html('<div id="loader" class="mx-auto my-5"></div>');
		}

		if(_input.value.length > 3) {
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
				success: function (data) {
					_container.html(data);
				},
				error: function (xhr) {
					alert('error function');
				},
			});
		}
		// console.log(_this[0].action);
	});
});