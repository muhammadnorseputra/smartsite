<!DOCTYPE html>
<html>

<head>
	<title>TEMPLATE JADWAL TES PESERTA CPNS</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?= base_url('assets/plugins/jquery-mobile/jquery.mobile-1.4.5.min.css'); ?>" />
	<script src="<?= base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
	<script src="<?= base_url('assets/plugins/jquery-mobile/jquery.mobile-1.4.5.min.js'); ?>"></script>
	<script src="<?= base_url('assets/plugins/jquery-download/jquery.fileDownload.js'); ?>"></script>
</head>

<body>

	<div data-role="page">

		<div data-role="header" data-position="fixed">
			<h1>JADWAL TES</h1>
		</div><!-- /header -->

		<div role="main" class="ui-content">
			<img src="<?= base_url('assets/images/format_file/Excel-Basic-to-Intermediate.jpg'); ?>" width="100%"
				alt="excel template">
			<h3>Download Template Excel Jadwal Tes Peserta CPNS</h3>
			<b>Catatan:</b>

      <ol data-role="listview">
        <li>Jangan merubah kolom maupun baris</li>
        <li>Format tanggal contoh: (yyyy-mm-dd)</li>
      </ol>
      <br>
			<div class="ui-grid-solo">
				<div class="ui-block-a"><a class="fileDownloadCustomRichExperience ui-btn ui-shadow"
						href="<?= base_url('files/template/cpns_jadwaltes.xlsx'); ?>" type="button">Download Template File</a>
        </div>

			</div>

		</div><!-- /content -->

		<div data-role="footer" data-position="fixed">
			<div data-role="navbar">
				<ul>
					<li><a href="#" id="btnBatal" data-theme="a" data-icon="power">Keluar</a></li>
				</ul>
			</div><!-- /navbar -->
		</div><!-- /footer -->
	</div><!-- /page -->




	<script>
		$(function () {
			$(document).on("click", "a.fileDownloadCustomRichExperience", function () {
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

			$("#btnBatal").unbind().bind('click', function (event) {
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
