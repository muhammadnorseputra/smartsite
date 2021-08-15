<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="shortcut icon" href="<?= base_url('assets/images/logo.png'); ?>">
		<!-- Import -->
		<style>
			@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap');
			@import url('https://pro.fontawesome.com/releases/v5.10.0/css/all.css');
			@import url('<?= base_url('assets/plugins/bootstrap-4/css/bootstrap.min.css') ?>');
		</style>
		<title><?= $title ?></title>
	</head>
	<body>
		<?php $this->load->view('Frontend/v1/pages/f_daftar_status'); ?>
		<script src="<?= base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
		<script src="<?= base_url('assets/plugins/bootstrap-4/js/bootstrap.min.js') ?>"></script>
	</body>
</html>