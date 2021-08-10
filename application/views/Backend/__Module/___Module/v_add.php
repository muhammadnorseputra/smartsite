<div class="row clearfix">
	<div class="col-md-8">

		<div class="card card-border">
			<div class="header">
				<h2 class="card-title">Form Tambah Module</h2>
				<div class="clearfix"></div>
			</div>
			<div class="body">
				<?= form_open('module/c_module/add', array('id' => 'FormModule')); ?>
				<div class="row clearfix">

					<div class="row clearfix">
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-5 form-control-label">
							<label for="aktif" class="control-label">Meta</label>
						</div>
						<div class="col-lg-8 col-md-4 col-sm-4 col-xs-7">
							<div class="switch m-t-5">
								<label>Front End <input name="meta" type="hidden" checked value="frontend"> <input name="meta" type="checkbox" value="backend"><span class="lever"></span>Back End</label>
							</div>

						</div>
					</div>
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-5 form-control-label">
						<label for="nama_module">Nama Module</label>
					</div>
					<div class="col-lg-8 col-md-4 col-sm-4 col-xs-7">

						<div id="message"></div>
						<div class="form-group">
							<div class="form-line">
								<input type="text" id="nama_module" name="nama_module" class="form-control" placeholder="Masukan nama module">
							</div>
							<div class="alert alert-message" role="alert">
								<span class="col-red font-12 font-bold">*</span> masukan dengan huruf kecil semua.
							</div>
						</div>
					</div>
				</div>


				<div class="row clearfix">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-5 form-control-label">
						<label for="aktif" class="control-label">Aktif</label>
					</div>
					<div class="col-lg-8 col-md-4 col-sm-4 col-xs-7">
						<div class="switch m-t-5">
							<label>Tidak <input name="aktif" type="hidden" checked value="N"> <input name="aktif" type="checkbox" value="Y"><span class="lever"></span>Ya</label>
						</div>

					</div>
				</div>
				<div class="m-t-15">
					<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
						<button type="submit" id="c_module_simpan" class="btn btn-sm btn-primary waves-effect waves-white m-t-10">Simpan</button>
						<button type="button" id="c_module_batal" class="btn btn-sm btn-danger waves-effect waves-white m-t-10">Batal</button>
					</div>

				</div>
				<?= form_close(); ?>

			</div>
		</div>

	</div>
</div>
<style>
	.no-close .ui-dialog-titlebar-close {
		display: none;
	}
</style>
<script>
	$("#FormModule").unbind().bind('submit', function(e) {
		e.preventDefault();
		let dialog = $("#dialog").dialog({
			autoOpen: false,
			modal: true
		});

		let form = $(this);
		$.post(form.attr('action'), form.serialize(), function(result) {
			form[0].reset();

			var $dialog = $('<div></div>')
				.html(result.content)
				.dialog({
					autoOpen: false,
					modal: true,
					width: 400,
					dialogClass: "no-close",
					closeText: "hide",
					title: 'Message!',
					buttons: [{
						text: "Ok",
						icon: "glyphicon glyphicon-done",
						click: function() {
							if (result.type == 'error') {
								$(this).dialog("close");
							} else {
								$("button#c_module_batal").click();
								$(this).dialog("close");
							}
						}
					}]
				});
			$dialog.dialog('open');
		}, 'json');
	});
</script>
