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
					<div class="col-4 offset-1" id="sidebar">
						<div class="px-5 pt-4">
							<div class="logo">
								<?php echo '<img src="data:image/jpeg;base64,' . base64_encode($mf_beranda->site_logo) . '" width="45"/>'; ?>
							</div>
							<h3 class="font-weight-bold mb-5 mt-5">Log In</h3> <?= $this->session->userdata('nama_panggilan') ?>
							<?= form_open(base_url('frontend/v1/users/cek_akun'), ['autocomplete' => 'off', 'id' => 'f_login'], ['session_login' => encrypt_url('bkppd_balangan'.date('d'))]); ?>
							<div class="form-group">
								<label class="mb-2" for="email">Email</label>
								<input type="email" data-sanitize="trim,lower" class="form-control mb-2" name="email" id="email" placeholder="mail@website.com" required="required">
							</div>
							<div class="form-group">
								<label class="mb-2" for="password">Password</label>
								<input type="password" class="form-control mb-2" name="password" id="pwd" placeholder="Password"  required="required">
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
									<div class="form-group col-6">
										<div class="input-group mb-2">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="fas fa-key"></i></div>
											</div>
											<input class="form-control" name="captcha" data-validation="spamcheck"
											data-validation-captcha="<?= ($val_1 + $val_2) ?>"/>
										</div>
									</div>
								</div>
							<button type="submit" class="btn btn-primary btn-block small"><i class="fas fa-lock mr-2"></i> Log In</button>
							<?= form_close(); ?>
							<div class="d-flex justify-content-between">
								<div><a href="<?= base_url() ?>" class="btn btn-link my-3"><i class="fas fa-arrow-left mr-2"></i> Beranda</a></div>
								<div><a href="<?= base_url('frontend/v1/daftar'); ?>" class="btn btn-link my-3">Kontribusi <i class="fas fa-arrow-right ml-2"></i></a></div>
							</div>
							
						</div>
					</div>
					<div class="col-7" id="content"></div>
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