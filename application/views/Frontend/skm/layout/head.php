<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?= $title ?></title>
		<link rel="shortcut icon" href="<?= base_url('assets/images/logo.png'); ?>">
		<link rel="apple-touch-icon" href="<?= base_url('assets/images/logo.png'); ?>">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
		<link rel="stylesheet" href="<?= base_url('assets/css/ikm.css') ?>">

		<?php if($this->uri->segment(1) === 'survei'): ?>
			<link rel="stylesheet" href="<?= base_url('bower_components/jquery-form-validator/form-validator/theme-default.min.css') ?>">
		<?php endif; ?>
	</head>
	<body id="top">