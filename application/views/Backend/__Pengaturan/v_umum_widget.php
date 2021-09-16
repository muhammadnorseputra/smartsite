<div class="row">
	<div class="col-md-8 col-md-offset-2">

		<div class="alert alert-message alert-message-info" role="alert">
			<i class="material-icons">info</i>
			<p>Pilih <b>ON</b> apabila widget ditampilkan, dan <b>OFF</b> apabila di sembunyikan
			</p>
		</div>
		<button id="btn-add-widget" class="btn btn-sm btn-link waves-effect waves-float m-b-10">
			<i class="glyphicon glyphicon-plus m-r-5"></i> Buat widget baru</button>
		<table class="table table-condensed table-striped table-bordered">
			<thead>
				<tr>
					<th>Title</th>
					<th width="150"></th>
					<th width="60"></th>
					<th width="60"></th>
				</tr>
			</thead>

			<body>

				<?php
				foreach ($fromdata as $data) :
				?>
					<tr>
						<td>
							<h5><?= strtoupper($data->title) ?></h5>
							<?php
							if ($data->content == '') {
							?>
								<span class="col-grey">No Content</span>
							<?php } ?>
						</td>
						<td>
							<?= form_open('backend/c_pengaturan/doUpdateWidget', array("id" => "switchId")) ?>
							<div class="switch" onchange="updateWidget(<?= $data->id_widget ?>,'<?= strtoupper($data->title) ?>')">
								<?php $check = ($data->show == 'Y' ? 'checked' : ''); ?>
								<label>OFF <input type="checkbox" data-title="" name="show<?= $data->id_widget ?>" <?= $check ?>><span class="lever switch-col-teal"></span> ON</label>
							</div>
							<?= form_close() ?>
						</td>
						<td>
							<button class="btn btn-sm btn-primary waves-effect" onclick="editWidget(<?= $data->id_widget ?>)">Edit</button>
						</td>
						<td>
							<button class="btn btn-sm btn-danger waves-effect" onclick="hapusWidget(<?= $data->id_widget ?>)">Hapus</button>
						</td>
					</tr>


				<?php endforeach; ?>
			</body>

		</table>
	</div>
</div>


<script>
	var btn_add_widget = $("button#btn-add-widget").on('click', function() {
		window.open("<?= base_url('backend/c_pengaturan/doAddWidget') ?>", '_blank', 'width=500,height=600,left=180,top=50, scrollbars=no, resizable=no, fullscreen=yes,menubar=no,status=no,titlebar=no,toolbar=no', true);
	});

	function updateWidget(id, title) {
		event.preventDefault();
		var $form = $("form#switchId");
		var $this = $("[name='show" + id + "']");

		if ($this.is(':checked')) {
			var values = 'Y';
		} else {
			var values = 'N';
		}

		$.post($form.attr('action'), {
			show: values,
			id: id,
			title: title
		}, function(response) {
			showNotification(response.classes, response.message, 'bottom', 'center', 'none', 'animated bounceOutDown');
		}, 'json');

		/*alert($id);*/
	}

	function hapusWidget(id) {
		$.confirm('Apa anda yakin akan menghapus widget tersebut?', 'Hapus!', function() {
			$.post('<?= base_url("backend/c_pengaturan/doHapusWidget") ?>', {
				id: id
			}, function(response) {
				$.showPreloader(response.msg);

				setTimeout(function() {
					$.hidePreloader(); /*// hide the indicator*/
					$("#tabs").tabs("load", 2);
				}, 2000);
			}, 'json');
		});
	}

	function editWidget(id) {
		$.showIndicator();
		setTimeout(function() {
			$.hideIndicator(); /*// hide the indicator*/
			window.open("<?= base_url('backend/c_pengaturan/editWidget/') ?>" + id, '_blank', 'width=500,height=600,left=420,top=50, scrollbars=no, resizable=no, fullscreen=yes,menubar=no,status=no,titlebar=no,toolbar=no', true);
		}, 1000);
	}

	function loadTabsWidget() {
		$("#tabs").tabs("load", 2);
	}
</script>
