<script>
	//PREVIEW UPLOAD GAMBAR
	let showImg = function(event) {
		var output = document.getElementById('preview');
		output.src = URL.createObjectURL(event.target.files[0]);
		output.style.width = '100%';
		output.style.display = "block";
		$("#before").css("display", "none");
	}

	$(document).on('click', '[data-toggle="lightbox"]', function(event) {
		event.preventDefault();
		$(this).ekkoLightbox({
			loadingMessage: 'Loading ...',
			alwaysShowClose: false,
			onShown: function() {
				$.Mprog.starts(3, '.ekko-lightbox .modal-body', true);
			},
			onContentLoaded: function() {
				$.Mprog.starts(3, '.ekko-lightbox .modal-body', false).end(true);
			}
		});
	});

	$(document).ready(function() {
		//FORM VALIDATION
		$('#FormVideo').validate({
			rules: {
				'judul': {
					required: true,
					minlength: 5,
					maxlength: 35
				},
				'publish': {
					required: true
				},
				'poster': {
					required: true,
					extension: "jpg|jpeg|png",
					accept: 'image/*'
				}
			},
			highlight: function(input) {
				$(input).parents('.form-line').addClass('error');
			},
			unhighlight: function(input) {
				$(input).parents('.form-line').removeClass('error');
			},
			errorPlacement: function(error, element) {
				$(element).parents('.form-group').append(error);
			},
			messages: {
				judul: {
					required: "Judul album wajib diisi",
					minlength: "Minimal {0} Karakter",
					maxlength: "Makasimal {0} Karakter"
				},
				poster: {
					required: "Gambar album belum dipilih",
					extension: "Format Hanya <code>jpg, jpeg, png</code>"
				},
				publish: {
					required: "Publish belum dipilih"
				}
			},
			onsubmit: true,
			focusCleanup: true
		});
	});

	$("#FormVideo").on('submit', function(e) {
		e.preventDefault();
		let form = $(this);
		$.ajax({
			url: form.attr('action'),
			method: 'POST',
			contentType: false,
			cache: false,
			processData: false,
			dataType: 'json',
			data: new FormData(this),
			beforeSend: function() {
				$.Mprog.starts(3, '#ModalAdd .modal-header', true);
			},
			success: function(result) {
				if ($('[name="poster"]').val() != '') {
					$("#imgView").html('<img src="' + result.pesan.file + '" class="img-responsive">');
					list();
				}
				// showNotification(result.pesan.colmsg, result.pesan.content, 'bottom', 'center', 'animated fadeIn', 'animated fadeOut');
				if (result.pesan.colmsg != 'bg-red') {
					form[0].reset();
				}
			},
			complete: function() {
				$.Mprog.starts(3, '#ModalAdd .modal-header', false).end(true);
			}
		});
	});

	list();

	function list() {
		$.getJSON('<?= site_url("backend/module/c_video/select_album") ?>',
			function(result) {
				$("#pilihalbum, #pilihalbum_utama").html(result);
			});
	}
	$("#pilihalbum").on('change', function() {
		let sel = $(this).val();
		if (sel != 0) {

			$.getJSON('<?= site_url("backend/module/c_video/select_curent_album/") ?>' + sel,
				function(result) {
					$("#imgPreview,#myAlbumVideo").html('<img src="' + result.responses[0].path + '" class="img-responsive">');
					$('[name="id_albumvideo"]').val(result.responses[0].id_album_video);
					$('[name="path_video"]').val(result.responses[0].path);
					$('[name="poster_video"]').val(result.responses[0].poster);
					if (result.responses[0].publish == 'Y') {
						var published = '<span class="col-green">On</span>';
					} else {
						var published = '<span class="col-red">Off</span>';
					}
					let table = /*html*/ `
				
				<table class="table table-condensed tabel-bordered">
					<thead>
					<tr>
						<th colspan="3" class="text-center">
							<div class="font-bold font-18">${result.responses[0].judul}</div>
							<button onclick="hapus()" class="btn btn-link btn-sm bg-white m-t-15 waves-effect waves-float waves-red"><em class="glyphicon glyphicon-trash m-r-5 col-red"></em> Hapus</button>
							<button onclick="edit()" class="btn btn-link btn-sm m-t-15 bg-white waves-effect waves-float"><em class="glyphicon glyphicon-pencil m-r-5 col-cyan"></em> Edit</button>	
						</th>
					</tr>
					</thead>
					<tr>
						<td width="90" class="font-bold">Deskripsi</td>
						<td width="10">:</td>
						<td>` + result.responses[0].keterangan + `</td>
					</tr>
					<tr>
						<td width="90" class="font-bold">Tgl. Buat</td>
						<td width="10">:</td>
						<td>` + result.responses[0].tgl_publish + `</td>
					</tr>
					<tr>
						<td width="90" class="font-bold">Publish</td>
						<td width="10">:</td>
						<td>` + published + `</td>
					</tr>
					<tr>
						<td width="90" class="font-bold">Upload By</td>
						<td width="10">:</td>
						<td>` + result.responses[0].upload_by + `</td>
					</tr>	
					<tfoot>
						<tr class="text-center">
							<td colspan="3">
													
							</td>
						</tr>
					</tfoot>				
				</table>
				`;
					$("#infoVideo").html(table);
					listVideo();
				}).then(() => {
				$('#album').waitMe({
					text: 'Menampilkan detail...',
					effect: 'rotation',
					bg: '#fff'
				});
			}).done(() => {
				setTimeout(() => {
					$('#album').waitMe("hide");
				}, 1000);
			});

		} else {
			$("#imgPreview,#myAlbumVideo").html(`<div class="p-t-80 p-b-80"><em class="glyphicon glyphicon-picture font-26"></em> <br> Gambar Album</div>`);
			$('[name="id_albumvideo"]').val('');
			$("#infoVideo").html('');
			$('#media-video').html(`
			<p class="text-center">
				<img class="img-rounded" width="35%" src="<?php echo base_url('assets/images/fitur/video-camera.png') ?>" alt="video-camera">
				<h4 class="text-center">Video Studio BKPPD</h4>
				<p class="text-mutted text-center">Pilih album untuk menampilkan beberapa video</p>
			</p>
			`);
		}

	});

	function hapus() {
		let id = $("[name='id_albumvideo']").val();
		let files = $("[name='poster_video']").val();

		let comf = confirm('Ada akan menghapus Album Beserta Video terkait?');
		if (comf == true) {
			$.post('<?= site_url("backend/module/c_video/hapus/") ?>', {
				id: id,
				file: files
			}, function(result) {
				showNotification(result.pesan.type, result.pesan.content, 'bottom', 'right', 'animated fadeIn', 'animated fadeOut');
				if (result.pesan.stsText == true) {
					$("#imgPreview").html(`<div class="p-t-60 p-b-60"><em class="glyphicon glyphicon-picture font-26"></em> <br> Poster</div>`);
					$("#infoVideo").html('');
					list();
				}
			}, 'json');
		}
	}

	function edit() {
		let id = $("[name='id_albumvideo']").val();
		$('#ModalEdit').modal('show');
		$.getJSON('<?= site_url("backend/module/c_video/select_curent_album/") ?>' + id, function(result) {
			$('#imgViewEdit').html('<img src="' + result.responses[0].path + '" class="img-responsive">');
			$('[name="judul_e"]').val(result.responses[0].judul);
			$('[name="keterangan_e"]').val(result.responses[0].keterangan);

			$('[name="id_albumvideo_e"]').val(result.responses[0].id_album_video);
			$('[name="path_video_e"]').val(result.responses[0].path);
			$('[name="poster_video_e"]').val(result.responses[0].poster);

			let check1 = $("#radio3");
			let check2 = $("#radio4");
			if (result.responses[0].publish == 'Y') {
				check1.prop('checked', true);
				check2.prop('checked', false);
			} else {
				check1.prop('checked', false);
				check2.prop('checked', true);
			}
		});
	}

	$(document).ready(() => {
		$('#FormUpdateVideo').validate({
			rules: {
				'judul_e': {
					required: true,
					minlength: 5,
					maxlength: 35
				},
				'publish_e': {
					required: true
				},
				'poster_e': {
					required: false,
					extension: "jpg|jpeg|png",
					accept: 'image/*'
				}
			},
			highlight: function(input) {
				$(input).parents('.form-line').addClass('error');
			},
			unhighlight: function(input) {
				$(input).parents('.form-line').removeClass('error');
			},
			errorPlacement: function(error, element) {
				$(element).parents('.form-group').append(error);
			},
			messages: {
				judul_e: {
					required: "Judul album wajib diisi",
					minlength: "Minimal {0} Karakter",
					maxlength: "Makasimal {0} Karakter"
				},
				poster_e: {
					extension: "Format Hanya <code>jpg, jpeg, png</code>"
				},
				publish_e: {
					required: "Publish belum dipilih"
				}
			}
		});
	});

	$("#FormUpdateVideo").on('submit', function(e) {
		e.preventDefault();
		let form = $(this);
		$.ajax({
			url: form.attr('action'),
			method: 'POST',
			contentType: false,
			cache: false,
			processData: false,
			dataType: 'json',
			data: new FormData(this),
			beforeSend: function() {
				$.Mprog.starts(3, '#ModalEditYoutube .modal-header', true);
			},
			success: function(result) {
				showNotification(result.pesan.colmsg, result.pesan.content, 'bottom', 'right', 'animated fadeIn', 'animated fadeOut');
				if (result.pesan.colmsg != 'bg-red') {
					$('#ModalEdit').modal('hide');
					list();
					$("#imgPreview").html(`<div class="p-t-60 p-b-60"><em class="glyphicon glyphicon-picture font-26"></em> <br> Poster</div>`);
					$('[name="id_albumvideo"]').val('');
					$("#infoVideo").html('');
					$('#media-video').html('');
				}

			},
			complete: function() {
				$.Mprog.starts(3, '#ModalEditYoutube .modal-header', false).end(true);
			}
		});
	});

	function listVideo() {
		let id = $("[name='id_albumvideo']").val();
		$.getJSON('<?= site_url("backend/module/c_video/list_video") ?>', {
			idalbum: id
		}, function(result) {
			$('#media-video').html(result);
		}).then(() => {
			$('#media-video').hide();
			$.Mprog.starts(3, '#list-album-video', true);
		}).done(() => {
			setTimeout(() => {
				$('#media-video').show();
				$.Mprog.starts(3, '#list-album-video', false).end(true);
			}, 1000);
		});
	}

	$("#FormVideoYoutube").on('submit', function(e) {
		e.preventDefault();
		let form = $(this);
		$.ajax({
			url: form.attr('action'),
			method: 'POST',
			contentType: false,
			cache: false,
			processData: false,
			dataType: 'json',
			data: new FormData(this),
			beforeSend: function() {
				$.Mprog.starts(3, '.mporgress', true);
			},
			success: function(result) {
				showNotification(result.pesan.colmsg, result.pesan.content, 'bottom', 'center', 'none', 'animated fadeOut');
				if (result.pesan.colmsg != 'bg-red') {
					form[0].reset();
					$('#msg').html(`<div class="alert ${result.pesan.colmsg} alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
																	${result.pesan.content}
															</div>`);
					$('#myVideoPoster').html('<img src="' + result.pesan.file + '" class="img-responsive">');
				}

			},
			complete: function() {
				$.Mprog.starts(3, '.mporgress', false).end(true);
			}
		});
	});


	$("#FormVideoLocal").on('submit', function(e) {
		e.preventDefault();
		let form = $(this);
		$.ajax({
			url: form.attr('action'),
			method: 'POST',
			contentType: false,
			cache: false,
			processData: false,
			dataType: 'json',
			data: new FormData(this),
			beforeSend: function() {
				$.Mprog.starts(3, '.mprogress', true);
			},
			success: function(result) {
				showNotification(result.pesan.colmsg, result.pesan.content, 'bottom', 'center', 'animated fadeIn', 'animated fadeOut');
				if (result.pesan.colmsg != 'bg-red') {
					form[0].reset();
					$('#msg').html(`<div class="alert ${result.pesan.colmsg} alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
																	${result.pesan.content}
															</div>`);
				}

			},
			complete: function() {
				$.Mprog.starts(3, '.mprogress', false).end(true);
			}
		});
	});


	function hapusvideo(id, files, jenis) {
		// let comf = confirm('Apakah ada yakin akan menghapus Video tersebut?');
		// if (comf == true) {
		// 	$.post('<?= site_url("backend/module/c_video/hapusvideo/") ?>' + id + '/' + files + '/' + jenis, function (result) {
		// 	showNotification(result.pesan.type, result.pesan.content, 'bottom', 'right', 'animated fadeIn', 'animated fadeOut');
		// 		if (result.pesan.stsText == true) {
		// 			listVideo();
		// 		}
		// 	}, 'json');
		// }

		$.confirm({
			title: 'Apakah ada yakin akan menghapus Video tersebut?',
			content: files,
			typeAnimated: true,
			buttons: {
				Ok: {
					text: 'Ok',
					btnClass: 'btn-red',
					action: function() {
						$.post('<?= base_url("backend/module/c_video/hapusvideo/") ?>' + id + '/' + files + '/' + jenis, function(result) {
							showNotification(result.pesan.type, result.pesan.content, 'bottom', 'center', 'animated fadeIn', 'animated fadeOut');
							if (result.pesan.stsText == true) {
								listVideo();
							}
						}, 'json');
					}
				},
				Batal: function() {}
			}

		});
	}

	function testVideo() {
		let Url = $("[name='link_youtube']").val();
		$.Mprog.starts(3, '#ModalTest .modal-header', true);
		$("#ModalTest").modal('show');
		if (Url == '') {
			isloaded();
			$("#testVideo").html('<div class="text-center col-grey"><i class="material-icons font-30">link</i><br> Url Tidak Ditemukan</div>');
		} else {
			$("#testVideo").html(`<iframe width="100%" height="330" src="https://www.youtube.com/embed/${Url}" onload="isloaded()" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`);
		}
	}

	function isloaded() {
		$.Mprog.starts(3, '#ModalTest .modal-header', false).end(true);
	}

	function pidahvideo(id, idalbum) {
		$("#pilihalbum_utama").val(idalbum);
		$("[name='videoid']").val(id);
		$("#ModalPindah").modal('show');
	}

	$("#FormPindahVideo").on('submit', function(e) {
		e.preventDefault();

		let pilihalbum = $("#pilihalbum_utama").val();
		let videoid = $("[name='videoid']").val();

		$.getJSON($(this).attr('action'), {
			id: videoid,
			albumid: pilihalbum
		}, function(result) {
			showNotification(result[0].type, result[0].content, 'bottom', 'right', 'animated fadeIn', 'animated fadeOut');
			$("#ModalPindah").modal('hide');
			listVideo();
		});
	});


	function editvideo(id, jenis) {
		$('.edit_youtubevideo').hide();
		if (jenis === 'youtube') {
			$("#ModalEditYoutube").modal('show');
			$.getJSON('<?= site_url("backend/module/c_video/edit_youtubevideo/") ?>' + id, function(result) {
				$("#imagesView").html(`<img src="${result[0].path}" class="img-responsive">`);

				$("[name='videoidYoutube']").val(id);
				$("[name='imgBeforeYoutube']").val(result[0].poster);

				$("[name='judul_videoyoutube']").val(result[0].judul);
				$("[name='keterangan_videoyoutube']").val(result[0].keterangan);
				$("[name='url_videoyoutube']").val(result[0].link_youtube);
				$("#previewVideoYoutube").html(`<iframe width="100%" height="300" src="https://www.youtube.com/embed/${result[0].link_youtube}" frameborder="1" allow="accelerometer; autoplay; encrypted-media; gyroscope;" allowfullscreen></iframe>`);

				if (result[0].update_by == '') {
					$("#infoEditYoutube").html('').hide();
				} else {
					$("#infoEditYoutube").html(`Last Update: @${result[0].update_by} | ${result[0].update_at}`).show();
				}

				//<iframe width="873" height="448" src="https://www.youtube.com/embed/D5KRv5GBHYQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

				//PUBLISH
				let check1 = $("#radio5");
				let check2 = $("#radio6");
				if (result[0].publish == 'Y') {
					check1.prop('checked', true);
					check2.prop('checked', false);
				} else {
					check1.prop('checked', false);
					check2.prop('checked', true);
				}

				//VIDEO PILIHAN
				let check3 = $("#radio7");
				let check4 = $("#radio8");
				if (result[0].pilihan == 'Y') {
					check3.prop('checked', true);
					check4.prop('checked', false);
				} else {
					check3.prop('checked', false);
					check4.prop('checked', true);
				}
				$('.edit_youtubevideo').show();
			}).then(() => {
				$('.edit_youtubevideo').waitMe({
					text: 'Mohon Tunggu...',
					effect: 'rotation',
					bg: '#fff'
				});
			}).done(() => {
				$('.edit_youtubevideo').waitMe("hide");
			});
		} else {
			$("#ModalEditLocal").modal('show');
			$.getJSON('<?= site_url("backend/module/c_video/edit_localvideo/") ?>' + id, function(result) {
				$("#previewVideoLocal").html(`
			<video controls="controls" class="video-responsive" width="100%" height="280" style="background:#000;">
				<source src="${result[0].path}" type="video/mp4">
			</video>
			`);
				$("[name='videoidLocal']").val(id);
				$("[name='judul_videolocal']").val(result[0].judul);
				$("[name='keterangan_videolocal']").val(result[0].keterangan);
				$("[name='fileBeforeLocal']").val(result[0].file_video);

				if (result[0].update_by == '') {
					$("#infoEditLocal").html('').hide();
				} else {
					$("#infoEditLocal").html(`Last Update: @${result[0].update_by} | ${result[0].update_at}`).show();
				}

				//PUBLISH
				let check1 = $("#radio9");
				let check2 = $("#radio10");
				if (result[0].publish == 'Y') {
					check1.prop('checked', true);
					check2.prop('checked', false);
				} else {
					check1.prop('checked', false);
					check2.prop('checked', true);
				}

				//VIDEO PILIHAN
				let check3 = $("#radio11");
				let check4 = $("#radio12");
				if (result[0].pilihan == 'Y') {
					check3.prop('checked', true);
					check4.prop('checked', false);
				} else {
					check3.prop('checked', false);
					check4.prop('checked', true);
				}
			});
		}
	}

	$("#FormEditVideoYoutube").on('submit', function(e) {
		e.preventDefault();
		let form = $(this);
		$.ajax({
			url: form.attr('action'),
			method: 'POST',
			contentType: false,
			cache: false,
			processData: false,
			dataType: 'json',
			data: new FormData(this),
			beforeSend: function() {
				$.Mprog.starts(3, '#ModalEditYoutube .modal-header', true);
			},
			success: function(result) {
				$("#message").fadeIn();
				$("#message").html(`<span class="pull-left col-${result.data.colmsg}"> 
														<em class="material-icons pull-left m-r-5 font-20">${result.data.iconmsg}</em>
														${result.data.message} 
													</span>`);
				$("#previewVideoYoutube").html(`<iframe width="100%" height="300" src="https://www.youtube.com/embed/${result.data.id_youtube_url}" frameborder="1" allow="accelerometer; autoplay; encrypted-media; gyroscope;" allowfullscreen></iframe>`);

				setTimeout(() => {
					$("#message").fadeOut();
				}, 6000);
				if (result.data.colmsg != 'red') {
					$("#imagesView").html(`<img src="${result.data.file}" class="img-responsive">`);
					listVideo();
				} else {
					$("[name='poster_videoyoutube']").val('');
				}

			},
			complete: function() {
				$.Mprog.starts(3, '#ModalEditYoutube .modal-header', false).end(true);
			}
		});
	});

	$("#FormEditVideoLocal").on('submit', function(e) {
		e.preventDefault();
		let form = $(this);
		$.ajax({
			url: form.attr('action'),
			method: 'POST',
			contentType: false,
			cache: false,
			processData: false,
			dataType: 'json',
			data: new FormData(this),
			beforeSend: function() {
				NProgress.start();
				NProgress.inc(0.4);
			},
			success: function(result) {
				$("#message-local").fadeIn();
				$("#message-local").html(`<span class="pull-left col-${result.data.colmsg}"> 
														<em class="material-icons pull-left m-r-5 font-20">${result.data.iconmsg}</em>
														${result.data.message} 
													</span>`);
				setTimeout(() => {
					$("#message-local").fadeOut();
				}, 6000);
				if (result.data.colmsg != 'red') {
					$("#previewVideoLocal").html(`
				<video controls="controls" class="video-responsive" width="100%" height="280" style="background:#000;">
					<source src="${result.data.file}" type="video/mp4">
				</video>
				`);
					listVideo();
					NProgress.inc(0.8);
					$("[name='file_videolocal']").val('');
				}

			},
			complete: function() {
				NProgress.done();
			}
		});
	});

	// $("[name='file_video_local']").on("", function() {
	// 	let me = $(this);
	// 	if(me.val() == ''){
	// 		$("#previewVideoLocal").html('Not Selected Video');	
	// 	} else {
	// 		$("#previewVideoLocal").html(`<video controls="controls" class="video-responsive" width="100%" height="280" style="background:#000;">
	// 					<source src="${me.val()}" type="video/mp4">
	// 				</video>`);
	// 	}
	// });

	// function testVideoLocal() {
	// 	let value = $("[name='file_video_local']");
	// 	// alert(value.val());
	// 	if(value.val() == ""){
	// 		$("#previewVideoLocal").html('Not Selected Video');
	// 	} else {
	// 		$("#previewVideoLocal").html(`<video controls="controls" class="video-responsive" width="100%" height="280" style="background:#000;">
	//  					<source src="${value.val()}" type="video/mp4">
	//  				</video>`);
	// 	}
	// }
</script>
