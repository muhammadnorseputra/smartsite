<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="shortcut icon" href="<?= base_url('assets/images/logo.png'); ?>">
	<!-- Custome -->
	<link rel="stylesheet" href="<?= base_url('assets/css/f_login.css') ?>">
	<link rel="stylesheet" href="<?= base_url('bower_components/jssocials/dist/jssocials.css') ?>">

    <title><?= $title ?></title>
  </head>
  <body>
    <div class="container my-5">
    	<div class="row">
    		<div class="col-12 col-md-8 offset-md-2">
    			<blockquote class="blockquote text-left border-left pl-4 pl-md-5">
    			<p><i class="fas fa-info-circle fa-3x"></i></p>
    			  <p class="my-3 font-weight-bold" style="line-height: 1.5em;">Mohon maaf untuk saat ini suvey kami tutup sementara, <br> tunggu informasi selanjutnya dari kami.</p>
    			  
    			<div class="d-flex justify-content-start align-items-center">
    			  <div class="mr-4 border-right pr-4">
    			  	<a class="btn btn-outline-primary" href="<?php echo base_url() ?>"><i class="fas fa-home mr-2"></i> Beranda</a> 
    			  </div>
    			  <div id="share" class="small"></div>
    			</div>
    			<footer class="blockquote-footer my-4"><?php echo longdate_indo(date('Y-m-d')) ?> <cite title="Source Title">, Bkppd Team</cite></footer>
    			</blockquote>
    		</div>
    	</div>
    </div>

    <!-- Optional JavaScript -->
    <script src="<?= base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/bootstrap-4/js/bootstrap.min.js') ?>"></script>
	<script src="<?= base_url('bower_components/jssocials/dist/jssocials.min.js') ?>"></script>
	<script>
		$("#share").jsSocials({
		shareIn: "popup",
  		  shares: [{share: "twitter", label: "Twitter"}, 
  		  			{share: "facebook", label: "Facebook"}, 
  		  			{share: "whatsapp", label: "Whatsapp"}]
		});
	</script>
  </body>
</html>