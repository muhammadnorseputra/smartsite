<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="shortcut icon" href="<?= base_url('assets/images/logo.png'); ?>">
		<!-- Custome -->
		<link rel="stylesheet" href="<?= base_url('assets/css/f_login.css') ?>">
		<title>Portal | Reset Password</title>
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
								<?php echo '<img src="data:image/jpeg;base64,' . base64_encode($mf_beranda->site_logo) . '" width="45"/>'; ?>
							</div>
							<h3 class="font-weight-bold mb-5 mt-5 text-center text-md-left">Reset Password</h3> 
							<?php if($data['token'] != date('Ymd')): ?>
							<div class="alert alert-warning" role="alert">
							  Link ini telah kadaluarsa <a href="#" class="alert-link">:)</a>. <br>silahkan kembali ke halaman reset password.
							</div>
							<?php else: ?>
							<?= form_open(base_url('frontend/v1/users/reset_password_now'), ['autocomplete' => 'off', 'id' => 'f_login', 'class' => 'toggle-disabled'], ['id' => encrypt_url($data['nohp'])]); ?>
							<div class="form-group">
								<label class="mb-2" for="password">Password Baru</label>
								<input type="password"  class="form-control mb-2" name="password" id="password" placeholder="Password Baru" required="required">
							</div>
							<button type="submit" class="btn btn-primary btn-block small">Simpan</button>
							<?= form_close(); ?>
							<?php endif; ?>
							
							<div class="d-flex justify-content-between">
								<div><a href="<?= base_url('frontend/v1/users/lupa_password') ?>" class="btn btn-link my-3"><i class="fas fa-arrow-left mr-2"></i> Reset Password</a></div>
								<div><a href="<?= base_url('frontend/v1/users/login'); ?>" class="btn btn-link my-3">Log in <i class="fas fa-arrow-right ml-2"></i></a></div>
							</div>
							
						</div>
					</div>
					<div class="col-7 d-none d-sm-block d-md-block d-xl-block" id="content"></div>
				</div>
			</div>
		</section>
		<script src="<?= base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
		<script src="<?= base_url('assets/plugins/bootstrap-4/js/bootstrap.min.js') ?>"></script>
	</body>
</html>