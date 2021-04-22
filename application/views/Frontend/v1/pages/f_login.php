<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="shortcut icon" href="<?= base_url('assets/images/logo.png'); ?>">
		<!-- Custome -->
		<link rel="stylesheet" href="<?= base_url('assets/css/f_login.css') ?>">
		<title>Portal | Log In</title>
	</head>
	<body>
		<div id="content2">
		  <div class="content_inner"></div>
		</div>
		<section class="login">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xs-12 col-md-4 offset-md-1" id="sidebar">
						<div class="px-2 px-md-5 pt-4">
							<div class="logo text-center text-md-left">
								<?php echo '<img src="data:image/jpeg;base64,' . base64_encode($mf_beranda->site_logo) . '" width="210"/>'; ?>
							</div>
							<h3 class="font-weight-bold mb-3 mt-5 text-center text-md-left">Log In</h3> 
							<?php if($this->session->flashdata('notif') <> ''): ?>
								<div class="alert border alert-light" role="alert">
								 <?= $this->session->flashdata('notif') ?>
								</div>
							<?php endif; ?>
							<?= form_open(base_url('frontend/v1/users/cek_akun'), ['autocomplete' => 'off', 'id' => 'f_login', 'class' => 'toggle-disabled'], ['session_login' => encrypt_url('bkppd_balangan'.date('d'))]); ?>
							<div class="form-group">
								<label class="mb-2" for="email">Email</label>
								<input type="email" data-sanitize="trim,lower" class="form-control form-control-lg mb-2 shadow-sm rounded-0" name="email" id="email" placeholder="mail@website.com" required="required">
							</div>
							<div class="form-group my-4">
								<label class="mb-2 d-block" for="password">
									Password  <a href="<?= base_url('lupa_password') ?>" class="small float-right">(Lupa sandi?)</a>
								</label>
								<input type="password" autocomplete="off" class="form-control form-control-lg mb-2 shadow-sm  rounded-0" name="password" id="password-field" placeholder="Password"  required="required">
								<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
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
								<div class="row">
									<div class="form-group col-8">
										<div class="input-group mb-2">
											<div class="input-group-prepend">
												<div class="input-group-text rounded-0"><i class="fas fa-key"></i></div>
											</div>
											<input class="form-control shadow-sm rounded-0" name="captcha" data-validation="spamcheck"
											data-validation-captcha="<?= ($val_1 + $val_2) ?>"/>
										</div>
									</div>
								</div>
							<button type="submit" class="btn btn-success btn-block shadow-lg btn-lg rounded-0 mb-4"><i class="fas fa-lock mr-2"></i> Log In</button>
							<?= form_close(); ?>
						</div>
					</div>
					<div class="col-7 d-none d-sm-block d-md-block d-xl-block" id="content">
						<div class="d-flex justify-content-end mt-md-2" id="navSimple">
							<div>
								<a href="<?= base_url('beranda') ?>" class="btn text-white btn-link">
									<i class="fas fa-home"></i> <br> Beranda
								</a>
							</div>
							<div class="mx-2">
								<a href="<?= base_url('daftar'); ?>" class="btn text-white btn-link">
									<i class="fas fa-user"></i> <br> Kontribusi/Mendaftar</a>
							</div>
							<div class="text-center">
								<a href="<?= base_url('userguide') ?>" class="btn btn-link text-white">
									<i class="fas fa-book"></i> <br> User Guide
								</a>
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