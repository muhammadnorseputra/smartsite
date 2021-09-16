<div class="card card-shadow m-t-25">
	<div class="header">
		<h2 class="card-title">Form Tambah Menu</h2>
		<div class="clearfix"></div>
	</div>
	<div class="body">
		<?= form_open('module/c_menu/add', array('id' => 'FormMenu')); ?>
		<div class="row clearfix">
			<div class="col-lg-6">

				<label for="nama_menu">Nama Menu</label>
				<div class="form-group">
					<div class="form-line">
						<input type="text" id="nama_menu" name="nama_menu" class="form-control" placeholder="Masukan nama menu.">
					</div>
				</div>
				<label for="link">Link</label>
				<div class="input-group">
					<span class="input-group-addon">
						<i class="material-icons">link</i>
					</span>
					<div class="form-line">
						<input type="text" class="form-control" id="linkmenu" name="linkmenu" placeholder="Link menu / submenu">
					</div>
					<span class="input-group-addon">
						<input type="checkbox" id="md_checkbox_sub" class="filled-in chk-col-red">
						<label for="md_checkbox_sub">Submenu</label>
					</span>
				</div>
				<div class="row">
					<div class="col-md-6">

						<label>Status Menu</label>
						<div class="form-group">
							<input name="sts" value="FRONTEND" type="radio" id="radio_sts30" class="with-gap radio-col-cyan" />
							<label for="radio_sts30">FRONTEND</label>
							<input name="sts" value="BACKEND" type="radio" id="radio_sts31" class="with-gap radio-col-pink" />
							<label for="radio_sts31">BACKEND</label>
						</div>
					</div>

					<div class="col-md-6">
						<label>Aktif</label>
						<div class="form-group">
							<div class="switch">
								<label>DISABLED <input name="aktif" type="hidden" value="N"> <input name="aktif" type="checkbox" checked value="Y"> <span class="lever"></span> ENABLE</label>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label for="order">Urutan Menu</label>
						<div class="card card-border">
							<div class="body">
								<div class="row">
									<div class="col-sm-12 m-t-5">
										<!--<div class="form-line">
						  <input type="number" class="form-control" id="order" min="0" max="10" value="1" name="ordermenu">
						</div>-->
										<div class="input-group spinner" data-trigger="spinner">
											<div class="form-line">
												<input type="text" name="ordermenu" class="form-control text-center" value="1" data-rule="month" data-min="1" data-max="12">
											</div>
											<span class="input-group-addon">
												<a href="javascript:;" class="spin-up" data-spin="up"><i class="glyphicon glyphicon-chevron-up"></i></a>
												<a href="javascript:;" class="spin-down" data-spin="down"><i class="glyphicon glyphicon-chevron-down"></i></a>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
					<div class="col-md-6">
						<label for="color">Background menu</label>
						<div class="card card-border">
							<div class="body">
								<div class="input-group colorpicker colorpicker-element">
									<div class="form-line">
										<input type="text" name="color" class="form-control" id="color" value="#eee">
									</div>
									<span class="input-group-addon">
										<i style="background-color: rgb(11, 185, 202);"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 border-l border-1 border-col-grey">
				<label for="label">Pilih Label</label>
				<div class="form-group">
					<div class="form-line">
						<select name="label" id="label" class="form-control">
							<option value="0">-- Pilih Label --</option>
							<?php foreach ($get_label as $label) : ?>
								<option value="<?= $label->id_label ?>"><?= strtoupper($label->nama_label) ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>

				<label for="icons">Pilih Icons</label>
				<div class="input-group">
					<div class="form-line">
						<select name="icons" id="icons" class="form-control"></select>
					</div>
					<span class="input-group-addon">
						<button type="button" id="btn-icons" class="btn btn-sm btn-link btn-circle waves-effect waves-float">
							<i class="material-icons">insert_emoticon</i>
						</button>
					</span>
				</div>

				<label for="module">Pilih Module</label>
				<div class="form-group">
					<div class="form-line">
						<select name="module" id="module" class="form-control">
							<option value="0">-- Pilih Module --</option>
							<?php foreach ($get_module as $mod) : ?>
								<option value="<?= $mod->id_module ?>">(<?= $mod->id_module ?>) <?= $mod->nama_module ?> </option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>

				<label for="module">User Menu</label>
				<div class="form-group">
					<div class="form-line">
						<select name="user_menu" id="user_menu" class="form-control">
							<option value="0">-- Pilih User Menu --</option>
							<option value="Y">Tampilan Untuk User (Y)</option>
							<option value="N">Hanya Admin</option>
						</select>
					</div>
				</div>


			</div>
		</div>

	</div>

	<div class="card-footer">
		<div class="row">
			<div class="col-md-6">
				<button type="button" class="btn btn-block btn-batal btn-danger waves-effect m-r-5">Batal</button>
			</div>
			<div class="col-md-6">
				<button type="submit" class="btn btn-block btn-primary waves-effect">Simpan</button>
			</div>
		</div>


	</div>
	<?= form_close(); ?>
</div>

<script>
	var btn_ref_icon = $("button#btn-icons").on('click', function() {
		window.open("<?= base_url('backend/module/c_menu/ref_icons'); ?>", '_blank', 'width=350,height=500,left=450,top=40, scrollbars=yes, resizable=no, fullscreen=yes,menubar=no,status=no,titlebar=no,toolbar=no', true);
	});

	$(document).on('submit', '#FormMenu', function(e) {
		e.preventDefault();
		let form = $(this);
		$.post(form.attr('action'), form.serialize(), function(result) {
			showNotification(result.jenis, result.content, 'bottom', 'center', 'animated fadeInUp', 'animated fadeOutDown');
			$("[name='nama_menu']").focus();
			if (result.jenis != 'bg-red') {
				form[0].reset();
				$("[name='user_menu'], [name='module'], [name='label'], [name='icons']").val(0).trigger('change');
			}
		}, 'json');
	});

	$(function() {
		$('.colorpicker').colorpicker();
		$(".spinner").spinner('delay', 800);

		function formatState(state) {
			if (!state.id) {
				return state.text;
			}
			var $state = jQuery(`<span><i class='material-icons'>${state.text.toLowerCase()}</i> ${state.id} </span>`);
			return $state;
		}

		var select_all = $("[name='user_menu'], [name='module'], [name='label']").select2();
		/*SELECT ICON*/
		var select_icon = $("select#icons").select2({
			placeholder: {
				id: '-1',
				text: '-- Pilih Icon --'
			},
			width: '100%',
			allowClear: true,
			ajax: {
				url: '<?= base_url("backend/module/c_menu/iconmenu") ?>',
				type: 'POST',
				dataType: 'json',
				delay: 250,
				data: function(par) {
					return {
						searchIcon: par.term
					};
				},
				processResults: function(response) {
					return {
						results: response.items
					};
				}
			},
			templateResult: formatState

		});


		jQuery("#md_checkbox_sub").on("change", function() {
			let check1 = jQuery("#md_checkbox_sub");
			if (check1[0].checked) {
				jQuery("[name='linkmenu']").val('#').prop("readonly", true);
			} else {
				jQuery("[name='linkmenu']").val('').prop("readonly", false).focus();
			}
		});

		var btn_batal = $(document).on('click', 'button.btn-batal', function() {
			window.location.replace('<?= base_url('backend/module/c_menu?module=' . $this->madmin->getmodule('MENU UTAMA') . '&user=' . $this->session->userdata('user_access')) ?>');
			$("button#btn-add-menu").prop("disabled", false);
		});

	});
</script>
