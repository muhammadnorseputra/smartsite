<style>
.no-close .ui-dialog-titlebar-close {
	display: none;
}
.ui-dialog {
	z-index:999999;
}
</style>
<script>
$(function(){
	/*DATATABLE PERATURAN*/
		let dataTable = $('#tbl-halaman').DataTable({
			processing: true,
			serverSide: true,
			order: [
				[0, 'desc']
			],
			responsive: false,
			ajax: {
				url: '<?= base_url("backend/module/c_halaman/list_halaman_datatable") ?>',
				type: 'POST'
				/*data: function (s) {
					s.judul = jQuery("[name='search']").val()
				}*/
			},
			columnDefs: [
				{
					"targets": [0],
					"className": "dt-left",
					"orderable": true,
					"width": "65%"
				},
				{
					"targets": [1],
					"className": "dt-center",
					"orderable": false,
					"width": "5%"
				},
				{
					"targets": [2],
					"className": "dt-center",
					"orderable": false,
					"width": "100%"
				},
				{
					"targets": [3],
					"className": "dt-center",
					"orderable": false,
					"width": "15%"
				}
			],
			language: {
				search: "Pencarian: ",
				processing: "Mohon Tunggu, Processing...",
				paginate: {
					previous: "Sebelumnya",
					next: "Selanjutnya"
				},
				emptyTable: "No matching records found, please filter this data"
			}
		});

	/*// TEXT AREA EDITOR
	CKEDITOR.replace('content_halaman' ,{
				filebrowserImageBrowseUrl : '<?php echo base_url('assets/kcfinder/browse.php');?>',
				filebrowserUploadUrl: '<?php echo base_url('assets/kcfinder/upload.php');?>',
				height: 300,
				removePlugins: 'resize',
				skin : 'bootstrapck'
	});*/
	
	var clipboard = new ClipboardJS('a.copy-token');
	clipboard.on('success', function (e) {
		/*$.alert('Copied: ' + e.text + ' (success)');*/
		showNotification('bg-black', 'Coppied: ' + e.text, 'bottom', 'center', 'none', 'none');  
		e.clearSelection();
	});
	jQuery("[data-toggle='tooltip']").tooltip();
});

list();
function list() {
	jQuery.getJSON(
		'<?= site_url("backend/module/c_halaman/list_halaman"); ?>',
		function (result) {
			jQuery("#MyHalaman").html(result.response);
		}
	);
}

/*jQuery("#FormEditHalaman").on('submit', function(e){
	e.preventDefault();
	let form = jQuery(this);
	let formdata = new FormData(this);
	jQuery.ajax({
		url: form.attr('action'),
		method: 'POST',
		dataType: 'json',
		contentType: false,
		cache: false,
		processData: false,
		data:formdata,
		beforeSend: function () {
			jQuery.Mprog.starts(3, '#edit-halaman .modal-footer', true);
		},
		success: function(result) {
			jQuery("#message").fadeIn();
			jQuery("#message").html(result.message);
			setTimeout(() => {	
					jQuery("#message").fadeOut();
			}, 3000);
			list();
			jQuery.Mprog.starts(3, '#edit-halaman .modal-footer', false).end(true);
			form[0].reset();
		}
	});	

});

function hover(id) {
		jQuery("#button-option-"+id).show('fast');
}
function leave(id){
	jQuery("#button-option-"+id).hide('fast');
}*/

jQuery('#FormSearchHalaman').on('submit', function(e){
	e.preventDefault();
	let form = jQuery(this);
	let kata = jQuery("[name='search_halaman']").val();
	if(kata != '')
	{
		jQuery.post(form.attr('action'), {katakunci: kata}, function(result){
			jQuery("#MyHalaman").html(result.response);
		}, 'json');
	} else {
		list();
	}
});

function edit_halaman(id){
	$.getJSON('<?= site_url("backend/module/c_halaman/edithalaman/") ?>'+ id, function (result) {
			$("[name='idhalaman']").val(id);
			$("button[type='button']").val(result[0].token_halaman);
			$("[name='inputfile']").val('');
			$("[name='title']").val(result[0].title);
			if(result[0].filename == '') {
				$(".btn-view-file, .btn-preview-file, .btn-hapus-file").hide();
				$(".label-file").html("Tambahkan File");
			} else {
				$(".btn-view-file").html('<i class="material-icons pull-left m-r-5">insert_drive_file</i>'+result[0].filename).show();
				$('.btn-preview-file, .btn-hapus-file').show();
				$(".label-file").html("Ubah File");
			}
			/*jQuery("[name='content_halaman']").append().html(result[0].content);
			CKEDITOR.instances.editor.setData(result[0].content);*/
			
			preview_file_halaman(id);
			$("#edit-halaman").modal('show');
			let check1 = $("#radio1");
			let check2 = $("#radio2");
			if (result[0].publish == 'Y') {
				check1.prop('checked', true);
				check2.prop('checked', false);
			} else {
				check1.prop('checked', false);
				check2.prop('checked', true);
			}
		});
}

$(document).on('show.bs.modal', '#ModalDetail', function () {
	var zIndex = 1040 + (10 * $('.detail-peg:visible').length);
	$(this).css('z-index', zIndex);
	setTimeout(function() {
			$('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
	}, 0);
});

function preview_file_halaman(id){
	jQuery.get('<?= site_url("backend/module/c_halaman/preview/") ?>'+ id, function(result){
		jQuery("#preview_file_halaman").attr('src', '<?= site_url("backend/module/c_halaman/preview/") ?>'+id);
	}, 'html');
}

$('.btn-preview-file').on('click', function(e) {
	e.preventDefault();
	let id = $("[name='idhalaman']").val();
	$("#preview_file").modal('show');
	$("#preview_file_halaman").attr('src', '<?= site_url("backend/module/c_halaman/preview/") ?>'+id);
});

$('.btn-hapus-file').on('click', function(e) {
	e.preventDefault();
	let id = $("[name='idhalaman']").val();
	var $dialog = $('<div></div>')
								.html("Apakah anda yakin akan menghapus lampiran?")
								.dialog({
										autoOpen: false,
										modal: true,
										width: 450,
										dialogClass: "no-close",
										title: 'Message!',
										classes: {
											"ui-dialog": "highlight"
										},
										buttons: [
										{
											text: "Ok",
											click: function() {
												$.post('<?= site_url("backend/module/c_halaman/hapus_lampiran/") ?>' + id, function(result) {
													/*$.alert(result[0]);*/
													showNotification('bg-black', result[0] , 'top', 'center', 'none', 'animated fadeOutUp');
													if(result[1] != 'fail') {
														$("#edit-halaman").modal('hide');
														window.location.reload();
													}
												}, 'json');
												$( this ).dialog( "close" );
											}	
										},
										{
											text: "Batal",
											click: function() {
													$( this ).dialog( "close" );
											}
										},
									]
								});
	$dialog.dialog('open');
});



function copytoken(token) {
	$.confirm({
		title: 'Token',
		animation: 'scale',
		closeAnimation: 'none',
		animationSpeed: 600,
		backgroundDismiss: false,
		animateFromElement: false,
		content: 'url:<?= site_url("backend/module/c_halaman/copytoken/") ?>' + token,
		buttons: {
			batal: function(){
            /*shorthand method to define a button
            the button key will be used as button name*/
			},
		}
	});
}

function delete_data(id) {
	/*let comf = confirm('Apakah ada yakin akan menghapus Halaman tersebut?');
	if (comf == true) {
		jQuery.post('<?= site_url("backend/module/c_halaman/delete/") ?>'+ id, function (result) {
			list();
			showNotification(result.type, result.content, 'bottom', 'center', 'animated fadeIn', 'animated fadeOut');
		}, 'json');
	}*/
	$.confirm({
		title: 'Konfirmasi hapus!',
		content: 'Apakah ada yakin akan menghapus Halaman tersebut?',
		animation: 'none',
		backgroundDismissAnimation: 'shake',
		closeAnimation: 'opacity',
		animationType: true,
		buttons: {
				delete: function () {
					$.post('<?= site_url("backend/module/c_halaman/delete/") ?>'+ id, function (result) {
						list();
						showNotification(result.type, result.content, 'bottom', 'center', 'none', 'none');
					}, 'json');
				},
				cancel: function () {}
		}
	});
}

</script>