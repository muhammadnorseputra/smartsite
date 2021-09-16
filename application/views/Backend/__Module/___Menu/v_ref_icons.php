<!DOCTYPE html>
<html>

<head>
	<title>Material Icons</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?= base_url('assets/plugins/jquery-mobile/jquery.mobile-1.4.5.min.css'); ?>" />
	<link rel="stylesheet" href="<?= base_url('assets/plugins/font-awesome/css/font-awesome.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/icon.css'); ?>">
	<script src="<?= base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
	<script src="<?= base_url('assets/plugins/jquery-mobile/jquery.mobile-1.4.5.min.js'); ?>"></script>
</head>

<body>

	<div data-role="page" id="demo-page">


		<div data-role="header" data-position="fixed">
			<h1>ICONS</h1>
		</div><!-- /header -->

		<div role="main" class="ui-content">
			<?php
			if ($this->session->flashdata('message') != '') {
				echo '<p>' . $this->session->flashdata('message') . '</p>';
			}
			?>
			<ul id="list-icons" data-role="listview">
				<?php foreach ($geticon->result() as $i) : ?>
					<li data-icon="edit">
						<a href="#" onclick="openedit(<?= $i->id_icon; ?>, '<?= $i->nama_icon; ?>')" data-rel="popup">
							<i class='material-icons ui-li-icon'><?= $i->nama_icon; ?></i>
							<p><?= $i->nama_icon; ?></p>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>

		</div><!-- /content -->

		<div data-role="footer" data-position="fixed" data-fullscreen="true">
			<!-- <a href="#" id="btnBatal" class="ui-btn ui-corner-all ui-btn-inline ui-mini footer-button-left ui-btn-icon-left ui-icon-power">Quit</a>
    <a href="#add-form" class="ui-btn ui-corner-all ui-btn-inline ui-mini footer-button-right ui-btn-icon-right ui-icon-plus">Add</a> -->

			<div data-role="navbar">
				<ul>
					<li><a href="#" id="btnBatal" data-icon="power">Keluar</a></li>
					<li><a href="#add-form" data-icon="plus">Tambah Icon</a></li>
				</ul>
			</div><!-- /navbar -->
		</div><!-- /footer -->

		<div data-role="panel" data-position="right" data-display="reveal" data-position-fixed="true" data-display="overlay" data-theme="a" id="add-form">
			<?= form_open('backend/module/c_menu/proses_add_icon', array('id' => 'FormIcon')); ?>
			<h2>Tambah Icon</h2>
			<label for="name_icons">Nama icons:</label>
			<div class="ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset ui-input-has-clear">
				<input type="text" data-enhanced="true" data-clear-btn="true" name="namaicon" id="name_icons" placeholder="Masukan nama icon disini ...">
				<a href="#" class="ui-input-clear ui-btn ui-icon-delete ui-btn-icon-notext ui-corner-all ui-input-clear-hidden" title="Clear text">Clear text</a>
			</div>
			<div class="ui-grid-a">
				<div class="ui-block-a"><a href="#" data-rel="close" class="ui-btn ui-shadow ui-corner-all ui-btn-b ui-mini">Cancel</a></div>
				<div class="ui-block-b"><button type="submit" class="ui-btn ui-shadow ui-corner-all ui-btn-a ui-mini">Save</button></div>
			</div>
			<?= form_close(); ?>

		</div><!-- /panel -->

		<div data-role="popup" id="popupEdit" data-overlay-theme="a" data-theme="b" class="ui-corner-all">
			<!-- <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a> -->
			<?= form_open(base_url('backend/module/c_menu/proses_update_icon'), array('id' => 'FormUpdateIcon')); ?>
			<input type="hidden" name="id">
			<div style="padding:10px 20px;">
				<h3>Edit / Hapus</h3>
				<label for="un" class="ui-hidden-accessible">Nama icon:</label>
				<input type="text" name="namaicon" id="un" data-theme="a">
				<button type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-check">Update</button>
				<button type="button" id="btnHapus" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-delete">Hapus</button>
			</div>
			<?= form_close(); ?>
		</div>
	</div><!-- /page -->
	<script>
		var daftaricons = $("ul#list-icons").listview({
			inset: true,
			autodividers: true,
			filter: true,
			dividerTheme: "b",
			splitTheme: "b"
		});

		$(document).on("swipeleft swiperight", "#demo-page", function(e) {
			if ($(".ui-page-active").jqmData("panel") !== "open") {
				if (e.type === "swipeleft") {
					$("#add-form").panel("open");
				}
			}
		});

		function refreshList() {
			/*$( "ul#list-icons" ).listview( "refresh" );*/
			location.reload();
		}

		$("#btnBatal").unbind().bind('click', function(event) {
			event.preventDefault();
			$.mobile.loading("show", {
				text: '',
				textVisible: false
			});
			setTimeout(() => {
				$.mobile.loading("hide");
				window.close();
			}, 1000);
		});

		function openedit(id, title) {
			$("#popupEdit").popup("open", {
				positionTo: 'window',
				transition: 'pop'
			});
			$("#FormUpdateIcon h3").html(`<i class="material-icons">${title}</i>`);
			$("#FormUpdateIcon [name='namaicon']").val(title);
			$("#FormUpdateIcon [name='id']").val(id);
			/*alert('oe');*/
		}

		$("form#FormUpdateIcon button#btnHapus").unbind().bind('click', function(event) {
			var id = $('[name="id"]').val();
			$.post('<?= base_url('backend/module/c_menu/proses_hapus_icon '); ?>', {
					id: id
				},
				function(response) {
					$.mobile.loading("show", {
						textonly: true,
						textVisible: true,
						text: response
					});

					setTimeout(() => {
						$.mobile.loading("hide");
						refreshList();
					}, 1000);
				}, 'json');
		});

		$("form#FormIcon").on('submit', function name(params) {
			params.preventDefault();
			var Url = $(this).attr('action');
			var Data = $(this).serialize();

			$.post(Url, Data, function(response) {

				$.mobile.loading("show", {
					textonly: true,
					textVisible: true,
					html: response.msg
				});

				setTimeout(() => {
					if (response.type == 'success') {
						refreshList();
						$.mobile.loading("hide");
					} else {
						$.mobile.loading("hide");
					}
				}, 1000);
			}, 'json');
		});

		$("form#FormUpdateIcon").on('submit', function(event) {
			event.preventDefault();
			var Url = $(this).attr('action');
			var Data = $(this).serialize();

			$.post(Url, Data, function(response) {

				setTimeout(() => {
					$.mobile.loading("show", {
						textonly: true,
						textVisible: true,
						text: response
					});

				}, 800);
			}, 'json').fail((statusText) => {
				$.mobile.loading("show", {
					textonly: statusText,
					textVisible: true
				});
			}).then(() => {
				$.mobile.loading("show", {
					text: 'Update Proses ...',
					textVisible: true
				});
			}).done(() => {
				setTimeout(() => {
					$.mobile.loading("hide");
					refreshList();
				}, 1500);
			});
		});
	</script>
</body>

</html>
