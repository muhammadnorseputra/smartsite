<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Login</title>
		<meta name="robots" content="noindex, nofollow, noarchive">
		<meta name="googlebot" content="noindex, nofollow, noarchive">
		<meta name="googlebot-news" content="noindex, nofollow, noarchive" />
		<meta name="keywords" content="Login - BKPPD Balangan">
		<meta name="description" content="Silahkan isikan kredensial anda untuk masuk ke-sistem userportal bkppd balangan sebagai tamu/konstributor/editor dengan memberikan konten dan fitur yang lebih banyak">
						
		<link rel="shortcut icon" href="<?= base_url('assets/images/logo.png'); ?>">
		<!-- Custome -->
		<link rel="stylesheet" href="<?= base_url('assets/css/f_login.css') ?>">
		<link rel="stylesheet" href="<?= base_url('bower_components/jquery-form-validator/form-validator/theme-default.min.css') ?>">
	</head>
	<body class="overflow-hidden">
		<div id="content2">
		  <div class="content_inner"></div>
		</div>
		<nav class="mb-5">
			<div class="d-flex justify-content-center border-bottom bg-white fixed-top">
							<div>
								<a href="<?= base_url('beranda') ?>" class="btn text-secondary btn-link">
									<i class="fas fa-home"></i> <br> Beranda
								</a>
							</div>
							<div class="mx-2">
								<a href="<?= base_url('daftar'); ?>" class="btn text-secondary btn-link">
									<i class="fas fa-user"></i> <br> Register</a>
							</div>
							<div class="text-center">
								<a href="<?= base_url('userguide') ?>" class="btn btn-link text-secondary">
									<i class="fas fa-book"></i> <br> User Guide
								</a>
							</div>
						</div>
		</nav>
		<section class="login">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xs-12 col-md-4 offset-md-1 mt-3" id="sidebar">
						<div class="px-3 px-md-5 py-2">
							<div class="logo text-center text-md-left">
								<?php echo '<img src="data:image/jpeg;base64,' . base64_encode($mf_beranda->site_logo) . '" width="210"/>'; ?>
							</div>
							<?php  
								if(isset($_GET['msg']) == 'sukses'):
							?>
							<div class="alert alert-default alert-dismissible border rounded bg-success text-white small" role="alert">
							  <strong class="text-warning">Sukses</strong> <br> Akun kamu sudah terdaftar.
							</div>
							<?php
								endif;
							?>
							<h3 class="font-weight-bold mb-3 mt-3 text-center text-md-left">Log In</h3> 
							<?php if($this->session->flashdata('notif') <> ''): ?>
								<div class="alert border alert-light" role="alert">
								 <?= $this->session->flashdata('notif') ?>
								</div>
							<?php endif; ?>
							<?php  
								$urlRef = isset($_GET['urlRef']) ? $_GET['urlRef'] : ''; 
								if(!$this->session->csrf_token) {
									$this->session->csrf_token = hash('sha1', time());
								}
							?>
							<?= form_open(base_url('frontend/v1/users/cek_akun'), ['autocomplete' => 'off', 'id' => 'f_login', 'class' => 'toggle-disabled'], ['session_login' => encrypt_url('bkppd_balangan'.date('d')), 'urlRef' => $urlRef, 'xtoken' => $this->session->csrf_token]); ?>
							<div class="form-group">
								<label class="mb-2" for="email">Email</label>
								<input type="email" data-sanitize="trim,lower" class="form-control form-control-lg mb-2" name="email" id="email" placeholder="mail@website.com" required="required">
							</div>
							<div class="form-group my-4">
								<label class="mb-2 d-block" for="password">
									Password
								</label>
								<input type="password" autocomplete="off" class="form-control form-control-lg" name="password" id="password-field" placeholder="Password"  required="required">
								<span toggle="#password-field" class="fas fa-fw fa-eye field-icon toggle-password"></span>
							</div>
							
								<?php
								$this->session->set_userdata('captcha', array(mt_rand(0,9), mt_rand(1, 9)));
								?>
								<?php
								$val_1 = $this->session->userdata('captcha')[0];
								$val_2 = $this->session->userdata('captcha')[1];
								?>
								<p class="mb-2">
									Berapa hasil penjumlahan dari <strong><?= $val_1 ?> + <?= $val_2 ?></strong> ?
								</p>
								<span id="check-capcha"></span>
								<div class="row">
									<div class="form-group col-4">
										<div class="input-group mb-2">
											<div class="input-group-prepend">
												<div class="input-group-text rounded-0"><i class="fas fa-key"></i></div>
											</div>
											<input class="form-control shadow-sm rounded-0" name="captcha" data-validation="spamcheck"
											data-validation-error-msg-container="#check-capcha"
											data-validation-captcha="<?= ($val_1 + $val_2) ?>"/>
										</div>
									</div>
								</div>
							<button type="submit" class="btn btn-success btn-block shadow-lg btn-lg mb-4"><i class="fas fa-lock mr-2"></i> Log In</button>
							<?= form_close(); ?>
							<a href="<?= base_url('lupa_password') ?>" class="text-primary">Saya lupa password?</a>
							<br>
							<a href="<?= base_url('kebijakan-privacy-policy') ?>" class="text-danger">Kebijakan Privacy & Policy</a>
						</div>
					</div>
					<div class="col-7 d-none d-sm-block d-md-block border-left d-xl-block bg-light">
						<div class="text-center h-100 d-flex justify-content-center align-items-center">
								<div>
									<img class="img-fluid w-75" src="<?= base_url('assets/images/bg/example-1.svg') ?>" alt="Registered Userportal - BKPPD BALANGAN">
									<div class="my-3">
										<h3 class="text-success mb-3">Masukan Kredensial Akun Yang Terdaftar</h3>
										<p class="text-muted">
											Silahkan masukan Email & Password yang telah kamu daftarkan sebelumnya.
										</p>
									</div>
								</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<script src="<?= base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
		<script src="<?= base_url('assets/plugins/bootstrap-4/js/bootstrap.min.js') ?>"></script>
		<script src="<?= base_url('template/v1/plugin/popmodal/popModal.min.js') ?>"></script>
		<script src="<?php echo base_url('bower_components/jquery-form-validator/form-validator/jquery.form-validator.min.js'); ?>"></script>
		<script src="<?= base_url('assets/js/f_login.js') ?>"></script>
	</body>
</html>