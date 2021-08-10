<script>

$(function() {
		// DATATABLE PERATURAN
		let dataTable = $('#tbl-peraturan').DataTable({
			processing: true,
			serverSide: true,
			order: [
				[1, 'asc']
			],
			deferRender: true,
			keys: false,
			autoWidth: false,
			select: false,
			searching: true,
			lengthChange: true,
			responsive: true,
			ajax: {
				url: '<?= base_url("backend/module/c_peraturan/ajax_list_peraturan") ?>',
				type: 'POST'
				// data: function (s) {
				// 	s.judul = jQuery("[name='search']").val()
				// }
			},
			columnDefs: [
				{
					"targets": [0],
					"className": "dt-center",
					"orderable": false,
					"width": "5%"
				},
				{
					"targets": [1],
					"className": "dt-left",
					"orderable": true,
					"width": "40%"
				},
				{
					"targets": [2],
					"className": "dt-left",
					"orderable": false,
					"width": "20%"
				},
				{
					"targets": [3],
					"className": "dt-center",
					"orderable": false,
					"width": "10%"
				},
				{
					"targets": [4],
					"className": "dt-center",
					"orderable": false,
					"width": "5%"
				},
				{
					"targets": [5],
					"className": "dt-center",
					"orderable": false,
					"width": "25%"
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
		
		// TABS TABLE PERATURAN
		$("table").on('click', '#button-del', function() {
			let id = $(this).attr('data-id');
			let file = $(this).attr('data-file');
			let title = $(this).attr('data-judul');
			$.confirm({
					title: 'Konfirmasi hapus!',
					content: '<b>'+title+'</b><br>(File: '+file.slice(34).toLowerCase()+')',
					backgroundDismissAnimation: 'shake',
					closeAnimation: 'opacity',
					type: 'red',
					animationType: true,
					animateFromElement: false,
					theme: 'material',
					buttons: {
							delete: {
								btnClass: 'btn-danger',
								action: function () {
									$.getJSON('<?= base_url("backend/module/c_peraturan/hapusperaturan/") ?>' + file, {id: id}, function(result) {
										dataTable.ajax.reload();
										$.dialog(result.content);
									});
								} 
							},
							cancel: function () {}
					}
			});
		});

		$("table").on('click', '#button-view', function(e) {
			e.preventDefault();
			let $url = $(this).attr('href');
			let $jdl = $(this).attr('data-title');
			$.confirm({
					title: $jdl,    
					closeIcon: true,
					icon: 'glyphicon glyphicon-book',
					// content: '<iframe src="'+ $url +'" width="100%" height="400" border="1"></iframe>',
					content: '<object type="application/pdf" data="' + $url + '?#zoom=0&scrollbar=0&toolbar=0&navpanes=0" width="100%" height="450"></object>',
					columnClass: 'col-md-12',
					theme: 'supervan',
					animation: 'opacity',
					closeAnimation: 'none',
					animateFromElement: false,
					animationSpeed: 800,
					buttons: {
						OK: {
							isHidden: true
						}
					}
			});
		});

    // SELECT LABEL
    let select_jenis_peraturan = $("[name='fid_jenis_peraturan']").select2({
    	placeholder: {
    		id: '-1',
    		text: '-- Pilih Jenis Peraturan --'
    	},
    	width: '100%',
    	allowClear: true,
    	ajax: {
    		url: '<?= base_url("backend/module/c_peraturan/ajax_select_jenisperaturan") ?>',
    		type: 'POST',
    		dataType: 'json',
    		delay: 250,
    		data: function (params) {
    			return {
    				searchParm: params.term
    			};
    		},
    		processResults: function (response) {
    			return {
    				results: response.items
    			};
    		}
    	}
    });

    // INPUT TAHUN 
    let dateYear = $("[name='tahun']").datepicker({
    	format: " yyyy",
    	autoclose: true,
    	viewMode: "years",
    	minViewMode: "years",
    	orientation: 'auto top',
    	container: '#bs_datepicker_component_container'
    });

    // FORM VALIDASI INPUT PERATURAN
    let validasiForm = $('#formTambahPeraturan').validate({
    focusCleanup: true,
    onsubmit: true,
    rules: {
    	'judul': {
    		required: true,
				minlength: 5
    	},
    	'fid_jenis_peraturan': {
    		required: true
    	},
    	'tahun': {
    		required: true
    	},
    	'file': {
    		required: true,
				extension: "pdf|doc"
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
		},
		messages: {
			file: {
				extension: "Only Upload PDF OR DOC File Allowed"
			}
		}
    });

		// AKSI VALID DATA 
		$('#formTambahPeraturan').on('submit', function(event) {
			event.preventDefault();
			var form = $(this);
			var formData = new FormData(this);
    	$.ajax({
    		url: form.attr('action'),
    		type: form.attr('method'),
        data: formData,
				dataType: 'json',
				processData: false,
				contentType: false,
    		success: function (response) {
					dataTable.ajax.reload();
					$(".container-msg").html(`
						<div class="alert alert-${response.errorStatus} alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><em class="material-icons font-20">cancel</em></span></button>
								${response.content}
						</div>
						`).fadeIn();
					if(response.errorStatus == 'success') {
						form[0].reset();
						$("[name='fid_jenis_peraturan']").val(0).trigger('change');
					}
    		}
    	});
		});

		$('#ModalAddPeraturan').on('hidden.bs.modal', function (e) {
			$('#formTambahPeraturan')[0].reset();
			$("[name='fid_jenis_peraturan']").val(0).trigger('change');
			$(".container-msg").fadeOut();
			validasiForm.resetForm();
		});

		// TABS TABLE JENIS PERATURAN
		$("#formTambahJenisPeraturan").on('submit', function(e) {
			e.preventDefault();
			var _frm = $(this);
			$.post(_frm.attr('action'), _frm.serialize(), function(result) {
				$.dialog(result.message);
				_frm[0].reset();
				dataTableJenis.ajax.reload();
			}, 'json');
		});
		
		$("table").on('click', '#button-hapus', function() {
			let id = $(this).attr('data-id-hapus');
			let name = $(this).attr('data-title'); 
			$.confirm({
				title: 'Konfirmasi hapus!',
				content: name,
				backgroundDismissAnimation: 'shake',
				closeAnimation: 'opacity',
				type: 'red',
				theme: 'material',
				animationType: true,
				buttons: {
						delete: function () {
								
								$.getJSON('<?= base_url("backend/module/c_peraturan/hapusjnsperaturan") ?>', {id: id, title: name}, function(result) {
									dataTableJenis.ajax.reload();
									$.dialog(result.content);
								}, 'json');
						},
						cancel: function () {}
				}
			});
		});

		$("table").on('click', '#button-edit', function(e) {
			e.preventDefault();
			let titletext = $(this).attr('data-title');
			let id = $(this).attr('data-id-edit');
			swal({
					title: "Renamed",
					text: "Masukan Nama Jenis Peraturan Yang Baru:",
					type: "input",
					showCancelButton: true,
					closeOnConfirm: false,
					// animation: "slide-from-top",
					inputValue: titletext,
					// inputPlaceholder: "Rename " + titletext.toLowerCase()
			}, function (inputValue) {
					if (inputValue === false) return false;
					if (inputValue === "") {
							swal.showInputError("Nama jenis peraturan belum disini."); return false
					}
					$.post('<?= base_url("backend/module/c_peraturan/aksiupdate_jns_peraturan/") ?>'+ id, {txt: inputValue}, function(result) {
					swal(result.msg.title, "Renamed: " + inputValue, result.msg.type);
					dataTableJenis.ajax.reload();
				}, 'json');
			});
		});

		// DATATABLE NAMA JENIS PERATURAN
		let dataTableJenis = $('#tbl-jenis-peraturan').DataTable({
			processing: true,
			serverSide: true,
			order: [
				[1, 'asc']
			],
			deferRender: true,
			keys: false,
			autoWidth: false,
			select: false,
			searching: true,
			lengthChange: true,
			responsive: true,
			ajax: {
				url: '<?= base_url("backend/module/c_peraturan/ajax_list_jns_peraturan") ?>',
				type: 'POST'
			},
			columnDefs: [
				{
					"targets": [0],
					"className": "dt-center",
					"orderable": false,
					"width": "5%"
				},
				{
					"targets": [1],
					"className": "dt-left",
					"orderable": true,
					"width": "40%"
				},
				{
					"targets": [2],
					"className": "dt-left",
					"orderable": false,
					"width": "20%"
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
		
});


</script>