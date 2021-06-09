<style>
	.no-close .ui-dialog-titlebar-close {
		display: none;
	}
</style>
<script>
	// TODO Tampilkan list
	list();

	// ? Fungsi show list
	function list() {
		$.getJSON('<?= site_url("backend/module/c_agenda/list_agenda") ?>', function(result) {
			$("#MyAgenda").html(result);
		});
	}

	$("#FormSearchAgendaByTgl").on('change', function(e) {
		e.preventDefault();
		let fr = $(this);
		let tglM = $("[name='stgl_mulai']").val();
		let tglS = $("[name='stgl_selesai']").val();
		$.getJSON(fr.attr('action'), {
			tgl_m: tglM,
			tgl_s: tglS
		}, function(result) {
			$("#MyAgenda").html(result);
		});
	});

	$("#FormSearchAgenda").on('submit', function(e) {
		e.preventDefault();
		let fr = $(this);
		let val = $("[name='search']").val();
		$.getJSON(fr.attr('action'), {
			katakunci: val
		}, function(result) {
			$("#MyAgenda").html(result);
		});
	});

	$("#FormAddAgenda").on('submit', function(e) {
		e.preventDefault();
		let form = $(this);
		let ContainerMsg = $("#message");
		$.ajax({
			url: form.attr('action'),
			method: 'POST',
			data: form.serialize(),
			dataType: 'json',
			delay: 3000,
			beforeSend: function() {
				$.Mprog.starts(3, '#addagenda .modal-footer', true);
			},
			success: function(result) {
				ContainerMsg.fadeIn();
				ContainerMsg.html(`<span class="pull-left col-${result.response.data.colmsg}"><em class="material-icons font-16 m-r-5 pull-left">${result.response.data.iconmsg}</em> ${result.response.data.message}</span>`);
				setTimeout(() => {
					ContainerMsg.fadeOut();
				}, 4500);
				if (result.response.data.colmsg != 'red') {
					setTimeout(() => {
						form[0].reset();
						list();
						$("#addagenda").modal('hide');
						$.Mprog.starts(3, '#addagenda .modal-footer', false).end(true);
						showNotification('bg-' + result.response.data.colmsg, result.response.data.message, 'bottom', 'right', 'animated fadeIn', 'animated fadeOut');
					}, 3000);
				} else {
					$.Mprog.starts(3, '#addagenda .modal-footer', false).end(true);
				}
			}
		});
	});

	function hapus(id) {
		var $dialog = $('<div></div>')
			.html("Apakah anda yankin, akan menghapus agenda terserbut?")
			.dialog({
				autoOpen: false,
				modal: true,
				width: 400,
				dialogClass: "no-close",
				title: 'Message!',
				buttons: [{
						text: "Ok",
						click: function() {
							$.getJSON('<?= site_url("backend/module/c_agenda/hapus") ?>', {
								id: id
							}, function(result) {
								$.dialog('Success Deleted');
								list();
							});
							$(this).dialog("close");
						}
					},
					{
						text: "Batal",
						click: function() {
							$(this).dialog("close");
						}
					},
				]
			});
		$dialog.dialog('open');
	}
</script>
