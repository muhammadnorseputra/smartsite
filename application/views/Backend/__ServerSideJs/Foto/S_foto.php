
<script>
	// ################################ START GALERI FOTO ################################ 
$(document).on('show.bs.modal', '#ModalDetail', function () {
	var zIndex = 1040 + (10 * $('.detail-peg:visible').length);
	$(this).css('z-index', zIndex);
	setTimeout(function() {
			$('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
	}, 0);
});
	
$(document).on('click', '[data-toggle="lightbox"]', function(event) {
		event.preventDefault();
		$(this).ekkoLightbox();
});

$(function () {
		
		$('#FormGaleri').validate({
			rules: {
				'judul_galeri': {
					required: true,
					minlength: 5
				},
				'publish_galeri': {
					required: true
				},
				'foto': {
					required: true,
					extension: "jpg|jpeg|png",
					accept: 'image/*'
				}
			},
			highlight: function (input) {
				$(input).parents('.form-line').addClass('error');
			},
			unhighlight: function (input) {
				$(input).parents('.form-line').removeClass('error');
			},
			errorPlacement: function (error, element) {
				$(element).parents('.form-group').append(error);
			},
			messages: {
				judul_galeri: {
					required: "Judul galeri wajib diisi",
					minlength: "Minimal {0} Karakter"
				},
				foto: {
					required: "Gambar galeri belum dipilih",
					extension: "Format Hanya <code>jpg, jpeg, png</code>"
				},
				publish_galeri: {
					required: "Publish belum dipilih"
				}
			},
		});
	});
	
	$("#FormGaleri").on('submit', function (e) {
	e.preventDefault();
	let me = $(this);

		$.ajax({
			url: me.attr('action'),
			method: 'POST',
			contentType: false,
			cache: false,
			processData: false,
			dataType: 'json',
			beforeSend: function () {
				$.Mprog.starts(3, '.FormGaleri', true);
			},
			data: new FormData(this),
			success: function (result) {
				showNotification(result.pesan.stsText, result.pesan.content, 'bottom', 'center', '', '');
				if(result.pesan.stsCode == 200){
					me[0].reset();
					list_galeri();
					$("#img-galeri").html('<img src="' + result.pesan.file + '" class="img-responsive">');
				}
			},
			complete: function () {
				$.Mprog.starts(3, '.FormGaleri', false).end(true);
			}
		});
});

list_galeri();
function list_galeri() {
	$.getJSON('<?= site_url("backend/module/c_foto/list_galeri") ?>',
		{ 
			idalbum: $("[name='idalbum']").val()
		},
		function (result) {
			$("div#myGaleri").html(result);
		}).then(()=> {
				$('#myGaleriLoading').waitMe({
					text: 'Mohon Tunggu...',
					effect: 'rotation',
					bg: 'rgba(255,255,255,0.99)'
				});
			}).done(() => {
				setTimeout(function () {
					$('#myGaleriLoading').waitMe("hide");
				}, 1000);
			});
};


$(function () {
		
		$('#FormGaleriDepan').validate({
			rules: {
				'judul_galeri': {
					required: true,
					minlength: 5
				},
				'publish_galeri': {
					required: true
				},
				'foto': {
					required: true,
					extension: "jpg|jpeg|png",
					accept: 'image/*'
				}
			},
			highlight: function (input) {
				$(input).parents('.form-line').addClass('error');
			},
			unhighlight: function (input) {
				$(input).parents('.form-line').removeClass('error');
			},
			errorPlacement: function (error, element) {
				$(element).parents('.form-group').append(error);
			},
			messages: {
				judul_galeri: {
					required: "Judul galeri wajib diisi",
					minlength: "Minimal {0} Karakter"
				},
				foto: {
					required: "Gambar galeri belum dipilih",
					extension: "Format Hanya <code>jpg, jpeg, png</code>"
				},
				publish_galeri: {
					required: "Publish belum dipilih"
				}
			},
		});
	});
	
	$("#FormGaleriDepan").on('submit', function (e) {
	e.preventDefault();
	let me = $(this);
		let albumid = $("[name='idalbum']").val();
		$.ajax({
			url: me.attr('action'),
			method: 'POST',
			contentType: false,
			cache: false,
			processData: false,
			dataType: 'json',
			beforeSend: function () {
				$.Mprog.starts(3, '#ModalDetail .modal-header', true);
			},
			data: new FormData(this),
			success: function (result) {
				$.alert({
					title: false,
					type: result.pesan.type,
					content: result.pesan.content,
					animation: 'none',
					buttons: {
						ok: function () {
							this.isClosed();
						}
					}
				});
				if(result.pesan.type == 'green'){
				$(".img-galeri").html('<img src="' + result.pesan.file + '" class="img-responsive">');
				me[0].reset();
				list_galeri();
				list_galeri_depan(albumid);
				list_album();
				listGaleriByUser('');
				}
			},
			complete: function () {
				$.Mprog.starts(3, '#ModalDetail .modal-header', false).end(true);
			}
		});
});


function list_galeri_depan(albumid, judul) {
	$.getJSON('<?= site_url("backend/module/c_foto/list_galeri_depan") ?>', { idalbum: albumid},
		function (result) {
			$("[name='idalbum']").val(albumid);
			$("[name='editalbumid']").val(albumid);
			$("span#AlbumFoto").html(judul);
			$("#ModalDetail").modal('show');		
			$("#_MyGaleri").html(result);
			editAlbumDepan(albumid);
		}).then(()=> {
				$('#_MyGaleri').waitMe({
					text: 'Mohon Tunggu...',
					effect: 'progressBar',
					bg: 'rgba(255,255,255,0.99)'
				});
			}).done(() => {
				setTimeout(function () {
					$('#_MyGaleri').waitMe("hide");
				}, 1000);
			});
	}

	function pindahAlbum(id_foto, id, title, gambar) {
		$.confirm({
		title: 'Pindah Album',
		theme: 'material',
    content: 'url:<?= base_url("backend/module/c_foto/pindahalbum/") ?>' + id,
    contentLoaded: function(data, status, xhr){
			// data is already set in content
			this.setContent(data);
			this.setContentAppend('<hr><img src="'+ gambar +'"><hr>' + title);
		},
		animation: 'bottom',
		closeAnimation: 'bottom',
		animateFromElement: false,
		animationSpeed: 200,
		buttons: {
        save: {
						text: 'Simpan',
						btnClass: 'btn-success',
            action: function () {
								$.post('<?= base_url("backend/module/c_foto/updatepindah/") ?>', 
								{myalbum: $("[name='nm_pindahfoto']").val(), myfoto: id_foto}, 
								function(responses) {
									// $.alert(responses.msg);
									list_galeri_depan(id);
									listGaleriByUser('');
									list_album();
								}, 'json');
            }
        },
        cancel: {
						text: 'Batal',
						btnClass: 'btn-danger',
            action: function () {
								this.isClosed();
            }
        }
    }
		});
	}


listGaleriByUser('');
function listGaleriByUser(search) {
	$.post('<?= site_url("backend/module/c_foto/listGaleriByUser/") ?>'+ search, 
		function (result) {
			$("#historyGaleriByUser").html(result);
		}, 'json').then(()=> {
				$('#historyGaleriByUser').waitMe({
					text: 'Mohon Tunggu...',
					effect: 'win8',
					bg: 'rgba(255,255,255,0.99)'
				});
			}).done(() => {
				setTimeout(function () {
					$('#historyGaleriByUser').waitMe("hide");
				}, 1000);
			});
};

function editAlbumDepan(albumid)
{
	$.getJSON('<?= site_url("backend/module/c_foto/edit_album_depan/") ?>'+ albumid,
		function (result) {
			$("[name='judul_album']").val(result[0].judul);
			$("[name='keterangan_album']").val(result[0].keterangan);
			$("[name='gbralbumbefore']").val(result[0].gambar);
			let check1 = $("#radio_05_g");
			let check2 = $("#radio_06_g");
			if (result[0].publish == 'Y') {
				check1.prop('checked', true);
				check2.prop('checked', false);
			} else {
				check1.prop('checked', false);
				check2.prop('checked', true);
			}
			$("#img-edit-album").html('<img src="' + result[0].path + '" class="img-responsive">');
		});
}

$("#FormAlbumDepan").on('submit', function(e) {
	e.preventDefault();
	let form = $(this);
	$.ajax({
		url: form.attr('action'),
		method: 'POST',
		dataType: 'json',
		contentType: false,
		cache: false,
		processData: false,
		data:new FormData(this),
		success: function(result) {
			// $("#msg").fadeIn();
			// $("#msg").html(`
			// <div class="alert ${result.pesan.bg}" role="alert">
			// 		${result.pesan.content}
			// </div>			
			// `);
			// setTimeout(() => {	
			// 	$("#msg").fadeOut();
			// }, 3000);

			$.dialog(result.pesan.content);
			
			if(result.pesan.sts == true) {
				list_album();		
				$("#img-edit-album").html('<img src="' + result.pesan.file + '" class="img-responsive">');
				$("span#AlbumFoto").text(result.pesan.judul);
			}
		}
	});
});
// .then(() => {
// 	$("#historyGaleriByUser").html(`<div class="text-center m-t-15 p-t-15 m-b-15" id="waitHistory">
// 																		<img src="../assets/images/loader/search.gif" class="image-circle">
// 																		<div class="m-t-10">Searching <b>` + search + `</b></div>
// 							</div>`);
// }).done(() => {
// 	setTimeout(function () {
// 			$("#waitHistory").fadeOut();
// 	}, 1000);
// })

// ################################ END GALERI FOTO ################################ 

// ################################ START ALBUM ################################ 


var previewImg 	= function(event) {
		var output 		= document.getElementById('preview');
		output.src = URL.createObjectURL(event.target.files[0]);
		output.style.width = '100%';
		output.style.display = "block";
		$("#before").css("display","none");
	}


$(function () {
	$('#FormAlbum').validate({
		rules: {
			'judul': {
				required: true,
				minlength: 5
			},
			'publish': {
				required: true
			},
			'gbr_album': {
				required: true,
				extension: "jpg|jpeg|png",
				accept: 'image/*'
			}
		},
		highlight: function (input) {
			$(input).parents('.form-line').addClass('error');
		},
		unhighlight: function (input) {
			$(input).parents('.form-line').removeClass('error');
		},
		errorPlacement: function (error, element) {
			$(element).parents('.form-group').append(error);
		},
		messages: {
			judul: {
				required: "Judul album wajib diisi",
				minlength: $.validator.format("Minimal {0} Karakter")
			},
			gbr_album: {
				required: "Gambar album belum dipilih",
				extension: "Format Hanya <code>jpg, jpeg, png</code>"
			},
			publish: {
				required: "Publish belum dipilih"
			}
		},
		onsubmit: true
	});
	
	$("form#FormAlbum").on('submit', function (e) {
		e.preventDefault();

		let form = $(this);
		if (($("[name='judul']").val() == '')) {
			showNotification('bg-red', 'Judul Tidak Boleh Kosong', 'bottom', 'left', 'animated fadeIn', 'animated fadeOut');
		} else if ((form[0].publish[0].checked == false) && (form[0].publish[1].checked == false)) {
			showNotification('bg-red', 'Publish belum dipilih', 'bottom', 'left', 'animated fadeIn', 'animated fadeOut');
		} else {

			$.ajax({
				url: form.attr('action'),
				method: 'POST',
				contentType: false,
				cache: false,
				processData: false,
				dataType: 'json',
				beforeSend: function () {
					NProgress.start();
					NProgress.inc(0.9);
					$('#album').waitMe({
						text: 'Mohon Tunggu...',
						effect: 'rotation',
						bg: 'rgba(255,255,255,0.99)'
					});
				},
				data: new FormData(this),
				success: function (result) {
					if (result.pesan.stsText == true) {
						// $("#ShowPhoto").html('<img src="' + result.pesan.file + '" class="img-responsive">');
						$("#preview").css("display","block");
						$("#before").css("display","none");	
						showNotification('bg-teal', result.pesan.content, 'bottom', 'left', 'animated fadeIn', 'animated fadeOut');
						// form[0].reset();
						list();
						$('#album').waitMe("hide");	
					} else {
						$("#preview").css("display","block").attr('src', result.pesan.file);
						showNotification('bg-pink', result.pesan.error, 'bottom', 'left', 'animated fadeIn', 'animated fadeOut');
						$('#album').waitMe("hide");	
					}
				},
				complete: function () {
					NProgress.done();
					$("form#FormAlbum").attr('action', '<?= site_url("backend/module/c_foto/addphoto") ?>');
				}
			});
		}
	});

});

list();

function list() {
	$.getJSON('<?= site_url("backend/module/c_foto/select_album") ?>',
		function (result) {
			$("#pilihalbum").html(result).selectpicker('refresh');
		});
};

function hapusAlbum() {
	let id = $("[name='idalbum']").val();
	let files = $("#fileName").val();
	let me = $("#FormAlbum");

	$.confirm({
			title: false,
			content: 'Anda yakin akan menghapus album tersebut ?',
			backgroundDismissAnimation: 'shake',
			closeAnimation: 'opacity',
			buttons: {
					delete: function () {
							$.post('<?= site_url("backend/module/c_foto/hapus/") ?>' + id + '/' + files, function(result) {
								list();
								$("form#FormAlbum").attr('action', '<?= site_url("backend/module/c_foto/addphoto") ?>');
								me[0].reset();
								$.alert(result.pesan.content);
								$("#preview").css("display","none");
								$("#before").css("display","block");
							}, 'json');
					},
					cancel: function () {}
			}
	});

}


$("#pilihalbum").on('change', function () {
	let sel = $(this).val();
	list_galeri();
	if (sel != 0) {
		$("#AddGaleri").css('display', 'block');
		$('.FormGaleri').collapse('show');

		$.getJSON('<?= site_url("backend/module/c_foto/select_curent_album/") ?>' + sel,
			function (result) {		
				$(".alert-message").css('display','none');
				$("form#FormAlbum").attr('action', '<?= site_url("backend/module/c_foto/updatealbum/") ?>' + sel);
				$("[name='gbrlama']").val(result[0].gambar);
				$("[name='idalbum']").val(result[0].id_album_foto);
				$("[name='idalbumadd']").val(result[0].id_album_foto);
				$("#fileName").val(result[0].gambar);
				
				$("#preview").css("display","block");
				$("#before").css("display","none");
				$("#preview").attr('src', '<?= site_url() ?>files/file_album/' + result[0].gambar);

				$("[name='judul']").val(result[0].judul);
				$("[name='keterangan']").val(result[0].keterangan);
				let check1 = $("#radio_01");
				let check2 = $("#radio_02");
				if (result[0].publish == 'Y') {
					check1.prop('checked', true);
					check2.prop('checked', false);
				} else {
					check1.prop('checked', false);
					check2.prop('checked', true);
				}

				$("button#hapus").css('display', 'block');
			}).then(()=> {
				$('#album').waitMe({
					text: 'Mohon Tunggu...',
					effect: 'rotation',
					bg: 'rgba(255,255,255,0.99)'
				});
			}).done(() => {
				setTimeout(function () {
					$('#album').waitMe("hide");
				}, 1000);
			});

	} else {

		$('.FormGaleri').collapse('hide');
		$("form#FormAlbum").attr('action', '<?= site_url("backend/module/c_foto/addphoto") ?>');
		
		// $("[name='idalbum']").val('');
		let me = $("#FormAlbum");
		me[0].reset();
		$("button#hapus").css('display', 'none');
		$(".alert-message").css('display','block');

		$("#preview").css("display","none");
		$("#before").css("display","block");
		$("#AddGaleri").css('display', 'none');

	}

});

list_album();
function list_album() {
	$.getJSON('<?= site_url("backend/module/c_foto/list_album") ?>', (result) => {
		$("#myAlbum").html(result);
	});
}

function editfoto(id) {
	$.getJSON('<?= site_url("backend/module/c_foto/edit_galeri/") ?>'+id, function(result) {
		$('#ModalEditGaleri').modal('show');
		$('#data-galeri').html(`
			<img class="img-responsive thumbnail img-galeri" src="${result.responses.data[0].path}">
		`);
		$('[name="judul_e"]').val(result.responses.data[0].judul);
		$('[name="keterangan_e"]').val(result.responses.data[0].keterangan);
		$('[name="file_e"]').val(result.responses.data[0].gambar);
		$('[name="idgaleri_e"]').val(result.responses.data[0].id_foto);
		let check1 = $("#radio_05_g");
		let check2 = $("#radio_06_g");
		if (result.responses.data[0].publish == 'Y') {
			check1.prop('checked', true);
			check2.prop('checked', false);
		} else {
			check1.prop('checked', false);
			check2.prop('checked', true);
		}		
	});
}

$("form#FormUpdateGaleri").on('submit', function(e) {
	e.preventDefault();
	let form = $(this);
	$.ajax({
		url: form.attr('action'),
		method: 'POST',
		dataType: 'json',
		contentType: false,
		cache: false,
		processData: false,
		data:new FormData(this),
		success: function(result) {
			if(result.response.sts == true) {
				list_galeri();
				$('#ModalEditGaleri').modal('hide');
				showNotification(result.response.bg, result.response.content, 'bottom', 'right', 'animated fadeIn', 'animated fadeOut');	
			} else if(result.response.sts == false) {
				$("#response").fadeIn();
				$("#response").html(`
				<div class="alert ${result.response.bg} alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
						${result.response.content}
				</div>			
				`);
				setTimeout(() => {	
					$("#response").fadeOut();
				}, 6000);
			}
		}
	});
});

function hapusGaleri() {
	let id = $('[name="idgaleri_e"]').val();
	let file = $('[name="file_e"]').val();
	let namaFile = file.slice(14,file.length);
	$.confirm({
			title: 'Confirm Deleted!',
			content: namaFile,
			backgroundDismissAnimation: 'shake',
			closeAnimation: 'opacity',
			columnClass: 'medium',
			buttons: {
					delete: function () {
							$.getJSON('<?= site_url("backend/module/c_foto/hapus_galeri/") ?>'+id+'/'+file, function(result) {
								if(result.pesan.stsText == true) {
									list_galeri();
									$('#ModalEditGaleri').modal('hide');
								}
								$.alert(result.pesan.content);
							});
					},
					cancel: function () {
							
					}
			}
	});

} 

function hapusGaleriDepan(id, idalbum, judul, file) {
	function ajax_delete () {
		$.getJSON('<?= site_url("backend/module/c_foto/hapus_galeri_depan/") ?>'+id+'/'+judul+'/'+file, function(result) {
			if(result.pesan.stsText == true) {
				list_galeri_depan(idalbum);
				listGaleriByUser('');
				list_album();
			}
			$.dialog(result.pesan.content);
		});
	}
	$.confirm({
			title: 'Confirm Deleted!',
			content: judul,
			backgroundDismissAnimation: 'shake',
			animation: 'none',
			closeAnimation: 'fade',
			animateFromElemet: false,
    		typeAnimated: true,
			buttons: {
					specialKey: {
							isHidden: true,
							keys: ['space'],
							action: function(){
								ajax_delete();
							}
					},
					delete: function () {
						ajax_delete();
					},
					cancel: function () {
						this.isClosed();
					}
			}
	}).then(()=> {
		$('#_MyGaleri').waitMe({
			text: 'Mohon Tunggu...',
			effect: 'progressBar',
			bg: 'rgba(255,255,255,0.99)'
		});
	}).done(() => {
		setTimeout(function () {
			$('#_MyGaleri').waitMe("hide");
		}, 1000);
	});

} 
// ################################ END ALBUM ################################
</script>