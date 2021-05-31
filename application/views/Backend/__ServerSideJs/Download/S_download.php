<style>
		.loading {
			background: url('<?= base_url('assets/images/loader/Preloader_7.gif'); ?>') center no-repeat !important
		}

		.no-close .ui-dialog-titlebar-close {
			display: none;
		}
</style>
<script>
listInternal();

function listInternal() {
	jQuery.getJSON(
		'<?= site_url('backend/module/c_download/list_internal'); ?>',
		function (result) {
			jQuery("#myDataInternal").html(result.data);
		}
	);
}

listEksternal();
function listEksternal() {
	jQuery.getJSON(
		'<?= site_url('backend/module/c_download/list_eksternal'); ?>',
		function (result) {
			jQuery("#myDataEksternal").html(result.data);
		}
	);
}


// $(document).on('click', "#btn-edit-download-eks", function(event) {
// 	event.preventDefault();
// 	let self  = $(this); 
// 	let $href = self.attr('href');
// 	// alert($href);
// 	var dialog = $('<div style="display:none" class="loading"></div>').appendTo('body');
// 	// open the dialog
// 	dialog.dialog({
// 			// add a close listener to prevent adding multiple divs to the document
// 			close: function(event, ui) {
// 					// remove div with all data and events
// 					dialog.remove();
// 			},
// 			modal: true,
// 			width: '800px',
// 			dialogClass: "no-close",
// 			title: 'Edit file download eksternal',
// 			position: { my: "center", at: "top", of: window },
// 			show: {
//         effect: "fade",
//         duration: 300
//       },
//       hide: {
//         effect: "fade",
//         duration: 300
//       },
// 			buttons: [
// 				{
// 					text: "Simpan",
// 					click: function() {
// 						$( this ).dialog( "close" );
// 					}	
// 				},
// 				{
// 					text: "Batal",
// 					click: function() {
// 							$( this ).dialog( "close" );
// 					}
// 				},
// 			]
// 	});
// 	// load remote content
// 	dialog.load(
// 			$href, 
// 			{}, // omit this param object to issue a GET request instead a POST request, otherwise you may provide post parameters within the object
// 			function (responseText, textStatus, XMLHttpRequest) {
// 					// remove the loading class
// 					dialog.removeClass('loading');
// 			}
// 	);
// 	//prevent the browser to follow the link
// 	return false;
// });

function hapus_eksternal_file(id,source) {
	$.confirm({
		title: 'Konfirmasi hapus!',
		content: '<i>' + source +'</i>',
		backgroundDismissAnimation: 'shake',
		closeAnimation: 'opacity',
		type: 'red',
		animationType: true,
		theme: 'material',
		icon: 'glyphicon glyphicon-trash',
		buttons: {
			delete: function () {
				$.getJSON('<?= site_url('backend/module/c_download/hapus_eks_link/'); ?>'+id, {sumber: source}, function(result) {
					showNotification(result.pesan.type, result.pesan.content, 'bottom', 'right', 'animated fadeIn', 'animated fadeOut');
					listEksternal();
				}).then(() => {
					NProgress.start();
					NProgress.inc(0.9);
				}).done(() => {
					NProgress.done();
				});
			},
			cancel: function () {}
		}
	});
		
}

//Hapus Data & File
function hapus(id,file,title) {
	$.confirm({
		title: 'Konfirmasi hapus!',
		content: '<b>' + title +'</b> <br> (file: '+ file +')',
		backgroundDismissAnimation: 'shake',
		closeAnimation: 'opacity',
		animation: 'none',
		animateFromElement: false,
		type: 'red',
		animationType: true,
		theme: 'material',
		icon: 'glyphicon glyphicon-trash',
		buttons: {
			delete: function () {
				$.ajax({
					url: '<?= site_url('backend/module/c_download/hapus/'); ?>'+id+'/'+file,
					method: 'POST',
					dataType: 'json',
					beforeSend: function () {
						NProgress.start();
						NProgress.inc(0.9);
					},
					success: function( result ) {
						if(result.pesan.stsText == true) {
							showNotification(result.pesan.type, result.pesan.content, 'bottom', 'right', 'animated fadeIn', 'animated fadeOut');
							listInternal();
						} else if (result.pesan.stsText == false) {
							showNotification(result.pesan.type, result.pesan.content, 'bottom', 'right', 'animated fadeIn', 'animated fadeOut');
						}
					},
						complete: function () {
							NProgress.done();
					}
				});
			},
			cancel: function () {}
		}
	});
}


//PILIHAN SOURCE DENGAN SELECT
jQuery("#pilihSource").on("change", function () {
	let val = jQuery(this).val();
	if (val == 2) {
		jQuery("#f_link").css('display', 'block');
		jQuery("#f_file").css('display', 'none');
		jQuery("[name='file']").val('');
	} else if (val == 1) {
		jQuery("#f_file").css('display', 'block');
		jQuery("#f_link").css('display', 'none');
		jQuery("[name='link_file']").val('');
	} else {
		jQuery("#f_file").css('display', 'none');
		jQuery("#f_link").css('display', 'none');
	}
});

//PILIHAN SOURCE DENGAN RADIO BUTTON
// jQuery("[name='sts']").on("change", function () {
// 	let check2 = jQuery("#radio_01");
// 	let check3 = jQuery("#radio_02");

// 	if (check2[0].checked) {
// 		jQuery("#f_link").css('display', 'block');
// 		jQuery("#f_file").css('display', 'none');
// 		jQuery("[name='file']").val('');
// 	} else if (check3[0].checked) {
// 		jQuery("#f_file").css('display', 'block');
// 		jQuery("#f_link").css('display', 'none');
// 		jQuery("[name='link_file']").val('');
// 	}
// });
jQuery(function () {
	jQuery('#FormDownload').validate({
		rules: {
			'file': {
				required: true
			},
			'link_file': {
				required: true
			},
			'publish': {
				required: true
			},
			'judul': {
				required: true
			}
		},
		highlight: function (input) {
			jQuery(input).parents('.form-line').addClass('error');
		},
		unhighlight: function (input) {
			jQuery(input).parents('.form-line').removeClass('error');
		},
		errorPlacement: function (error, element) {
			jQuery(element).parents('.form-group').append(error);
		}
	});
	jQuery("#FormDownload").on('submit', function (event) {

		event.preventDefault();
		let form = jQuery(this);
		if ($("[name='file']").val() != '') {
			if ($("[name='file']").val() == '') {

				// showNotification('bg-red', '<em class="material-icons pull-left m-r-10">warning</em> Nama File tidak boleh kosong.', 'bottom', 'right', 'animated bounceInUp', 'animated fadeOutDown');
				$.dialog('<em class="material-icons pull-left m-r-10">warning</em> Nama File tidak boleh kosong.');
				form[0].file.focus();

			} else if ((form[0].publish[0].checked == false) && (form[0].publish[1].checked == false)) {

				// showNotification('bg-red', '<em class="material-icons pull-left m-r-10">warning</em> Publish belum dipilih', 'bottom', 'right', 'animated bounceInUp', 'animated fadeOutDown');
				$.dialog('<em class="material-icons pull-left m-r-10">warning</em> Publish belum dipilih');

			} else {
				$.ajax({
					url: form.attr('action'),
					method: 'POST',
					contentType: false,
					cache: false,
					processData: false,
					dataType: 'json',
					data: new FormData(this),
					beforeSend: function () {
						NProgress.start();
						NProgress.inc(0.9);
					},
					success: function (result) {
						if (result.responses.type == 'success') {
							showNotification('bg-teal', result.responses.pesan, 'bottom', 'right', 'animated fadeIn', 'animated fadeOut');
							// $.dialog(result.responses.pesan);
							form[0].reset();
							jQuery("#ModalAdd").modal('hide');
							jQuery("#f_file").css('display', 'none');
							jQuery("#f_link").css('display', 'none');
							listInternal();
						} else {
							showNotification('bg-red', result.responses.pesan.error, 'bottom', 'right', 'animated fadeIn', 'animated fadeOut');
							// $.dialog(result.responses.pesan.error);
						}
					},
					complete: function () {
						NProgress.done();
					}
				});
			}
		} else {
			if (jQuery("[name='judul']").val() == '') {
				// showNotification('bg-red', '<em class="material-icons pull-left m-r-10 font-20">warning</em> Judul tidak boleh kosong', 'bottom', 'right', 'animated bounceInUp', 'animated fadeOutDown');
				form[0].file.focus();
				$.dialog('<em class="material-icons pull-left m-r-10 font-20">warning</em> Judul tidak boleh kosong');
			} else if ((form[0].publish[0].checked == false) && (form[0].publish[1].checked == false)) {
				// showNotification('bg-red', '<em class="material-icons pull-left m-r-10 font-20">warning</em> Publish belum dipilih', 'bottom', 'right', 'animated bounceInUp', 'animated fadeOutDown');
				$.dialog('<em class="material-icons pull-left m-r-10 font-20">warning</em> Publish belum dipilih');
			} else {
				jQuery.post(
					'<?= site_url('backend/module/c_download/addByLinK'); ?>', {
						judul: jQuery("[name='judul']").val(),
						publish: jQuery("[name='publish']").val(),
						link: jQuery("[name='link_file']").val(),
						keterangan: jQuery("[name='keterangan']").val()
					},
					function (result) {
						if (result.responses.type == 'success') {
							showNotification('bg-teal', result.responses.pesan, 'bottom', 'right', 'animated fadeIn', 'animated fadeOut');
							form[0].reset();
							jQuery("#f_file").css('display', 'none');
							jQuery("#f_link").css('display', 'none');
							jQuery("#ModalAdd").modal('hide');
							listEksternal();
						} else {
							showNotification('bg-red', result.responses.pesan.error, 'bottom', 'right', 'animated fadeIn', 'animated fadeOut');
						}
					}, 'json'
				).then(() => {
					NProgress.start();
					NProgress.inc(0.9);
				}).done(() => {
					NProgress.done();
				});
			}
		}

	});

});

    /* Get into full screen */
    function GoInFullscreen(element) {
    	if (element.requestFullscreen)
    		element.requestFullscreen();
    	else if (element.mozRequestFullScreen)
    		element.mozRequestFullScreen();
    	else if (element.webkitRequestFullscreen)
    		element.webkitRequestFullscreen();
    	else if (element.msRequestFullscreen)
    		element.msRequestFullscreen();
    }

    /* Get out of full screen */
    function GoOutFullscreen() {
    	if (document.exitFullscreen)
    		document.exitFullscreen();
    	else if (document.mozCancelFullScreen)
    		document.mozCancelFullScreen();
    	else if (document.webkitExitFullscreen)
    		document.webkitExitFullscreen();
    	else if (document.msExitFullscreen)
    		document.msExitFullscreen();
    }

    /* Is currently in full screen or not */
    function IsFullScreenCurrently() {
    	var full_screen_element = document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement || null;

    	// If no element is in full-screen
    	if (full_screen_element === null)
    		return false;
    	else
    		return true;
    }

    $("#btn-fullscreen").on('click', function () {
    	if (IsFullScreenCurrently())
    		GoOutFullscreen();
    	else
    		GoInFullscreen($("object#view-file").get(0));
    });

    $(document).on('fullscreenchange webkitfullscreenchange mozfullscreenchange MSFullscreenChange', function () {
    	if (IsFullScreenCurrently()) {
    		$("#element span").text('Full Screen Mode Enabled');
    		$("#btn-fullscreen").html('<em class="material-icons">fullscreen_exit</em>');
    	} else {
    		$("#element span").text('Full Screen Mode Disabled');
    		$("#btn-fullscreen").html('<em class="material-icons">fullscreen</em>');
    	}
    });
</script>