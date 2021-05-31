<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to System Auth</title>
	<script src="<?= base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #eee;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
		text-align: center;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #eee;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: center;
		font-size: 11px;
		border-top: 1px solid #eee;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px auto;
		border: 1px solid #eee;
		box-shadow: 0 0 8px #D0D0D0;
		width: 100%;
		background-color: #fff;
	}
	table {
		border: 1px solid #ccc;
		border-collapse: collapse;
		width: 50%;
		padding:0px;
		margin:0 auto;
	}
	table tr td{
		border:1px solid #ccc;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Welcome to System Auth!</h1>

	<div id="body">
		<h3>Please Wait...</h3>
		<p>Anda mencoba akses ke system kami, gunakan dengan bijak.</p>
		<div id="loader"></div>
		<table>
			<tr>
				<td>Sytem Operasi</td>
				<td><?= $os ?></td>
			</tr>
			<tr>
				<td>Browser</td>
				<td><?= $browser ?></td>
			</tr>
			<tr>
				<td>Ip Address</td>
				<td><?= $ip ?></td>
			</tr>
			<tr>
				<td>Date</td>
				<td><?= $date ?></td>
			</tr>
		</table>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. </p>
</div>
<script>
	$(document).ready(function() {
		var table = $('table').hide();
		var loader = $("#loader");

		loader.html(`<center><img src="assets/images/loader/search.gif"></center>`);
		setInterval(() => {
			loader.hide();
			table.fadeIn();
			$("h3").html('Redirecting, mohon unggu ...').css({
				color: "red"
			});
			setTimeout(() => {
				window.location.replace('<?= site_url("login-system") ?>');
			}, 3000);
		}, 4000);
	});
</script>
</body>
</html>