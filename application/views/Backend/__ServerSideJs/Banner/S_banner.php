<script>

function reload() {
	list_jenisBanner();
	list_jenisBannerSelect();
	list_banner();
}

// function _cekFileType(target) {
// 	var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
// 	if ($.inArray($(target).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
// 			return fileExtension.join(', ');
// 	}
// }

function _cekFileSize(target) {
	var iSize = ($(target)[0].files[0].size / 1024); 
     if (iSize / 1024 > 1) 
     { 
        if (((iSize / 1024) / 1024) > 1) 
        { 
            iSize = (Math.round(((iSize / 1024) / 1024) * 100) / 100);
            var is_size =  iSize + " (Gb)"; 
        }
        else
        { 
            iSize = (Math.round((iSize / 1024) * 100) / 100)
            var is_size =  iSize + " (Mb)";
        } 
     } 
     else 
     {
        iSize = (Math.round(iSize * 100) / 100)
        var is_size =  iSize + " (Kb)";
     } 
		 return is_size;
	}  


var previewImg 	= function(event) {
	var output 		= document.getElementById('preview');
	output.src = URL.createObjectURL(event.target.files[0]);
	output.style.width = '100%';
	output.style.display = "block";
	$("#before").css("display","none");
}

	
// $('[name="gambar"]').on('change', function() {
// 	var img 		= document.getElementById('preview');
// 	var extension	= $('[name="gambar"]').val().replace(/^.*\./, '');
// 	// var size =$('[name="gambar"]')[0].files[0].size;
// 	$("#path").val("Dimension: " + img.naturalWidth + " x " + img.naturalHeight + " (px) | " + " FileSize: " + _cekFileSize('[name="gambar"]') + " | FileType: " + extension);
// });


list_banner();
function list_banner() {
	jQuery.getJSON(
		'<?= site_url("backend/module/c_banner/list_banner"); ?>',
		function (result) {
			jQuery("#list-banner").html(result);
		}
	).then(()=> {
		jQuery('#list-banner').waitMe({
			text: 'Mohon Tunggu...',
			effect: 'facebook',
			bg: 'rgba(244,244,244,0.8)'
		});
	}).done(() => {
		setTimeout(function () {
			jQuery('#list-banner').waitMe("hide");
		}, 1000);
	});
} 

list_jenisBanner();
function list_jenisBanner() {
	jQuery.getJSON(
		'<?= site_url("backend/module/c_banner/list_jenisbanner"); ?>',
		function (result) {
			jQuery("ul#jenis-banner").html(result);
		}
	).then(()=> {
				jQuery('ul#jenis-banner').waitMe({
					text: 'Mohon Tunggu...',
					effect: 'win8_linear',
					bg: 'rgba(244,244,244,0.8)'
				});
			}).done(() => {
				setTimeout(function () {
					jQuery('ul#jenis-banner').waitMe("hide");
				}, 1000);
			});
}  

list_jenisBannerSelect();
function list_jenisBannerSelect() {
	jQuery.getJSON(
		'<?= site_url("backend/module/c_banner/list_jenisbanner_select"); ?>',
		function (result) {
			jQuery("[name='idjns_banner']").html(result);
		}
	);
} 

jQuery("#FormBanner").on('submit', function(e){
e.preventDefault();
	let me = jQuery(this);
	jQuery.ajax({
		url: me.attr('action'),
		method: 'POST',
		cache: false,
		contentType: false,
		processData: false,
		data: new FormData(this),
		dataType: 'json',
		beforeSend: function() {
			$('body').css({cursor: 'wait'});
		},
		success: function(result)
		{
			
		$("#preview").css("display","none");
		$("#before").css("display","block");

		showNotification(result.pesan.colmsg, result.pesan.content, 'bottom', 'center', 'animated fadeInUp', 'animated fadeOutDown');	
			if(result.pesan.colmsg != 'bg-red'){
				list_banner();
				me[0].reset();
			} else {
				jQuery("#path").val(result.pesan.preview);
			}
		},
		complete: function() {
			$('body').css({cursor: 'default'});
		}
	});
});

jQuery("#FormAddJenisBanner").on('submit', function(e) {
  e.preventDefault();

  let form = jQuery(this);
  let ControlerMsg = jQuery("#message");
  let posisi = jQuery("[name='posisi']").val();
  let jenis = jQuery("[name='jenis']").val();
  if(posisi == '') {
    ControlerMsg.html(`<div class="alert alert-warning"><em class="material-icons font-18 pull-left m-r-10">error_outline</em> Posisi Banner Kosong</div>`);
  } else if (jenis == 0){
    ControlerMsg.html(`<div class="alert alert-warning"><em class="material-icons font-18 pull-left m-r-10">error_outline</em> Pilih Jenis Banner</div>`);
  } else {
    jQuery.post(form.attr('action'), form.serialize(), function(result) {
        let json = JSON.parse(result);
        ControlerMsg.show();
        setTimeout(() => {
          ControlerMsg.hide();  
        }, 8000);
        ControlerMsg.html(`<div class="${json.message_bg}">${json.message}</div>`);
        reload();
        form[0].reset();
    }).then(() => {
			$('body').css({cursor: 'wait'});
		}).done(() => {
			$('body').css({cursor: 'default'});
		});
  }
});

function edit_banner(id){
	jQuery.getJSON('<?= site_url("backend/module/c_banner/edit_banner/") ?>'+ id, function (result) {
		jQuery("#MyGambar").html(`<img class="img-responsive img-galeri" src="${result[0].path}">`);
		jQuery("[name='idbanner_e']").val(result[0].id_banner);
		jQuery("[name='judul_e']").val(result[0].judul);
		jQuery("[name='url_e']").val(result[0].url);
		jQuery("[name='idjns_banner']").val(result[0].fid_jns_banner);
		jQuery("[name='file_before']").val(result[0].gambar);
		jQuery("#path_e").val(result[0].path);
		let check1 = jQuery("#radio_04_i");
		let check2 = jQuery("#radio_03_i");
		if (result[0].publish == 'Y') {
			check1.prop('checked', true);
			check2.prop('checked', false);
		} else {
			check1.prop('checked', false);
			check2.prop('checked', true);
		}
		jQuery("#editBanner").modal('show');
	});
}

jQuery("#FormUpdateBanner").on('submit', function(e) {
	e.preventDefault();
	let form = jQuery(this);
	jQuery.ajax({
		url: form.attr('action'),
		method: 'POST',
		dataType: 'json',
		contentType: false,
		cache: false,
		processData: false,
		data:new FormData(this),
		beforeSend: function () {
			$.Mprog.starts(3, '#editBanner .modal-footer', true);
			$('body').css({cursor: 'wait'});
		},
		success: function(result) {
			if(result.response.sts == true) {
				$('body').css({cursor: 'wait'});
				
					showNotification(result.response.bg, result.response.content, 'bottom', 'center', 'animated fadeInUp', 'animated fadeOutDown');
					list_banner();
					form[0].reset();
					$('#editBanner').modal('hide');
					$.Mprog.starts(3, '#editBanner .modal-footer', false).end(true);
					$('body').css({cursor: 'default'});
				
			} else if(result.response.sts == false) {
				$("#response").fadeIn();
				$("#response").html(`
				<div class="alert ${result.response.bg} alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">Ã—</span></button>
						${result.response.content}
				</div>			
				`);
					$("#response").fadeOut();
				
				$.Mprog.starts(3, '#editBanner .modal-footer', false).end(true);
			}
		}
	});
});

function hapus_jenisbanner(id) {
	let comf = confirm('Apakah ada yakin akan menghapus data tersebut?');
	if (comf == true) {
		$.getJSON('<?= site_url("backend/module/c_banner/hapus_jenisbanner") ?>', {
			id: id
		}, function (result) {
      $.alert('Hapus berhasil');
			reload();
		});
	}
}

function hapus_banner(id, files, title) {
	$.confirm({
			title: 'Deleted Banner',
			content: title,
			backgroundDismissAnimation: 'shake',
			closeAnimation: 'opacity',
			buttons: {
					delete: function () {
							
							$.getJSON('<?= site_url("backend/module/c_banner/hapus_banner/") ?>'+ id +'/'+ files, function(result) {
								list_banner();
								$.alert(result.pesan.content);
							});
					},
					cancel: function () {
							
					}
			}
	});

}
</script>