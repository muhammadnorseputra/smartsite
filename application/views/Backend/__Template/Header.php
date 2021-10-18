<?= doctype('html5'); ?>
<html>

<head>
	<meta charset="UTF-8">
	<?= meta('X-UA-Compatible', 'IE=Edge; charset=utf-8', 'equiv'); ?>
	<?= meta('viewport', 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'); ?>
	<title><?= $titlebar; ?></title>
	<!-- Favicon-->
	<?= link_tag('assets/images/favicon2.png', 'shortcut icon', 'image/x-icon'); ?>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/icon.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/hint.css'); ?>">

	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/node-waves/waves.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/animate-css/animate.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/nprogress/nprogress.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/mprogres/css/mprogress.min.css'); ?>">

	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/sweetalert/sweetalert.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/jquery-confirm/jquery-confirm.min.css'); ?>">

	<!-- Link Tags Dinamic-->
	<?php
    foreach ($autoload_css as $css) :
        echo link_tag($css);
    endforeach;
    ?>

	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/style.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/themes/all-themes.css'); ?>">
	<script src="<?= site_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
	<script src="<?= base_url('files/tinymce/tinymce.min.js'); ?>"></script>
	<script src="<?= base_url('assets/plugins/jquery-ui/jquery-ui.js'); ?>"></script>
	<script data-pace-options='{ "ajax": false }' src="<?= site_url('assets/plugins/pace/pace.min.js'); ?>"></script>
	<link href="<?= site_url('assets/plugins/pace/themes/green/pace-theme-flash.css'); ?>" rel="stylesheet" />
	<link href="<?= site_url('assets/plugins/select2/css/select2-materialize.css'); ?>" rel="stylesheet" />

</head>

<body class="theme-<?= $this->madmin->aktifskin('t_skin', 'Y'); ?>">

	<!-- Page Loader -->
	<div class="page-loader-wrapper">
		<div class="loader">
			<div class="preloader pl-size-md">
				<div class="spinner-layer pl-<?= $this->madmin->aktifskin('t_skin', 'Y'); ?>">
					<div class="circle-clipper left">
						<div class="circle"></div>
					</div>
					<div class="circle-clipper right">
						<div class="circle"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- #END# Page Loader -->
	<!-- Overlay For Sidebars -->
	<div class="overlay"></div>
	<!-- #END# Overlay For Sidebars -->
	<!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
