<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="shortcut icon" href="<?= base_url('assets/images/logo.png'); ?>">
		<!-- Custome -->
		<link rel="stylesheet" href="<?= base_url('assets/css/f_login.css') ?>">
		<title>Portal | Lupa Password</title>
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
							<h3 class="font-weight-bold mb-3 mt-5 text-center text-md-left">Lupa Password</h3>
							<?php if($this->session->flashdata('notif') <> ''): ?>
								<div class="alert border alert-warning" role="alert">
								 <?= $this->session->flashdata('notif') ?>
								</div>
							<?php endif; ?>
							<div class="alert alert-default alert-dismissible border-0 rounded p-0 fade show text-secondary" role="alert">
							  <strong>Note!</strong> <br> Link <u>reset password</u> akan kami kirimkan pada email yang anda daftarkan.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button>
							</div>
							<?= form_open(base_url('frontend/v1/users/reset_password'), ['autocomplete' => 'off', 'id' => 'f_login', 'class' => 'toggle-disabled'], ['session_login' => encrypt_url('bkppd_balangan'.date('d'))]); ?>
							<div class="form-group">
								<label class="mb-2" for="email">Email</label>
								<input type="email"  class="form-control form-control-lg shadow-sm border-0 mb-2 rounded-0" name="email" id="email" placeholder="mail@website.com" required="required">
							</div>
							<button type="submit" class="btn btn-primary btn-lg shadow btn-block small rounded-0"><i class="fas fa-share mr-2"></i> Kirim</button>
							<?= form_close(); ?>
							
							
						</div>
					</div>
					<div class="col-7 d-none d-sm-block d-md-block d-xl-block" id="content">
						
							<div class="d-flex justify-content-end mt-md-2" id="navSimple">
								<div><a href="<?= base_url('beranda') ?>" class="btn btn-link text-white"><i class="fas fa-home"></i><br> Beranda</a></div>
								<div class="mx-3"><a href="<?= base_url('login_web'); ?>" class="btn btn-link text-white"><i class="fas fa-lock"></i> <br> Log in </a></div>
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
	</body>
</html>