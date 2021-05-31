<!DOCTYPE html>
<html>

<head>
	<title>TEMPLATE HASIL VERIFIKASI ONLINE PESERTA CPNS</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?= base_url('assets/plugins/jquery-mobile/jquery.mobile-1.4.5.min.css'); ?>" />
	<script src="<?= base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
	<script src="<?= base_url('assets/plugins/jquery-mobile/jquery.mobile-1.4.5.min.js'); ?>"></script>
</head>

<body>

	<div data-role="page">

		<div data-role="header" data-position="fixed">
			<h1>HASIL VERIFIKASI</h1>
		</div><!-- /header -->

		<div role="main" class="ui-content">
			<img src="<?= base_url('assets/images/format_file/Excel-Basic-to-Intermediate.jpg'); ?>" width="100%"
				alt="excel template">
			<h3>Download Template Excel Hasil Verifikasi Online Peserta CPNS</h3>
			<b>Catatan:</b>

      <ol data-role="listview">
        <li>Jangan merubah kolom maupun baris</li>
        <li>Format tanggal contoh: (yyyy-mm-dd)</li>
      </ol>
      <br>
			<div class="ui-grid-solo">
				<div class="ui-block-a">
					<a class="ui-btn ui-shadow" href="<?= base_url('files/template/cpns_hasilverifikasi.xlsx'); ?>" data-ajax="false" id="btnDownload" title="Download" type="button">Download Template File</a>
        </div>

			</div>

		</div><!-- /content -->

		<div data-role="footer" data-position="fixed">
			<div data-role="navbar">
				<ul>
				<li><a href="#" id="btnBatal" data-theme="a" data-icon="power">Keluar</a></li>
                <li><a href="<?= base_url('cpns/informasi/uploadDataHasilVerifikasi'); ?>" data-theme="a" data-transition="slide" data-icon="navigation">Upload</a></li>
                <li><a href="<?= base_url('cpns/informasi/DownloadDataHasilVerifikasi'); ?>" data-theme="a" data-icon="cloud" data-transition="slide" class="ui-btn-active">Download Template</a></li>
				</ul>
			</div><!-- /navbar -->
		</div><!-- /footer -->
	</div><!-- /page -->

	<script src="<?= base_url('assets/plugins/jquery-download/jquery.fileDownload.js'); ?>"></script>
	<script>
		$(document).ready(function() {

			$(document).on("click", "#btnDownload", function () {
				$.fileDownload($(this).attr('href'), {
					successCallback: function (url) {
						alert('You just got a file download dialog or ribbon for this URL :' + url);
						window.close();
					},
					failCallback: function (html, url) {

						alert('Your file download just failed for this URL:' + url + '\r\n');
					}
				});
				return false; //this is critical to stop the click event which will trigger a normal file download!
			});

			$(document).on('click', "#btnBatal", function (event) {
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

		});
	</script>

</body>
</html>
