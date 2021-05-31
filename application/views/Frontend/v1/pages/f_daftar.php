<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="shortcut icon" href="<?= base_url('assets/images/logo.png'); ?>">
		<!-- Custome -->
		<link rel="stylesheet" href="<?= base_url('assets/css/f_daftar.css') ?>">
		<title>Portal | Registered</title>
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
							<h3 class="font-weight-bold mb-5 mt-5 text-center text-md-left">Registered</h3> <?= $this->session->userdata('user_portal_log')['nama_panggilan'] ?>
							<?= form_open_multipart(base_url('frontend/v1/daftar/send'), ['id' => 'form_daftar', 'class' => 'toggle-disabled'], ['session_register' => encrypt_url('bkppd_balangan'.date('d'))]); ?>
							<div class="form-group my-5 text-center">
								<img src="<?= base_url('assets/images/no-profile-picture.jpg'); ?>" alt="pic" width="160" height="160" class="rounded-circle d-block border border-info p-1 mb-3 photo_pic mx-auto">
								<input name="photo_pic"
								type="file"
								data-validation="mime size"
								data-validation-allowing="jpg"
								data-validation-max-size="2M"
								required="required">
								
								<small id="customFile" class="form-text text-muted">
								Upload file photo.
								</small>
							</div>
							<div class="form-group">
								<label for="email" class="font-weight-bold">Nama Lengkap</label>
								<input name="nama_lengkap"
								id="nama_lengkap"
								type="text"
								class="form-control my-3"
								placeholder="Nama Lengkap"
								data-validation="alphanumeric"
								data-validation-allowing=". '"
								data-sanitize="capitalize"
								value="<?= set_value('nama_lengkap') ?>"
								required="required">
							</div>
							<div class="form-group mt-2">
								<label for="nama_pangilan" class="font-weight-bold">Nama Panggilan <br><span class="small text-secondary">(only a-z characters, no space!)</span></label>
								<input name="nama_pangilan"
								id="nama_pangilan"
								type="text"
								class="form-control my-3"
								placeholder="Nama panggilan kamu"
								data-validation="custom,length"
								data-sanitize="trim lower strip"
								data-validation-length="min5"
								data-validation-regexp="^([a-z]+)$"
								value="<?= set_value('nama_pangilan') ?>"
								required="required">
							</div>
							<div class="form-group">
								<div id="tl-container">
									<label for="tl" class="font-weight-bold">Tanggal Lahir</label>
									<input name="tanggal_lahir"
									id="tl"
									type="text"
									class="form-control my-3"
									placeholder="Tanggal lahir"
									data-validation="date"
									data-validation-format="dd/mm/yyyy"
									required="required">
								</div>
							</div>
							<div class="form-group">
								<label for="alamat" class="font-weight-bold">Alamat
									<br>
									<span class="small text-secondary">History (<span id="maxlength">150</span> characters left)</span>
								</label>
								<textarea name="alamat"
								placeholder="Alamat sekarang ..."
								class="form-control my-3"
								id="alamat"
								data-validation="length"
								data-validation-length="min5"
								rows="3"
								required="required"></textarea>
							</div>
							<div class="form-group">
								<label for="pekerjaan" class="font-weight-bold">Pekerjaan <br> <span class="small text-secondary">Deskripsikan pekerjaan anda</span></label>
								<textarea name="pekerjaan"
								class="form-control my-3"
								id="pekerjaan"
								data-validation="length"
								data-validation-length="min5"
								rows="3"
								required="required" placeholder="Pekerjaan..."></textarea>
							</div>
							<div class="form-group">
								<label for="pendidikan" class="font-weight-bold">Pendidikan Terkahir</label>
								<select class="custom-select my-3" name="pendidikan" id="pendidikan" required="required">
									<option value="" selected>-- Pilih Pendidikan --</option>
									<option value="SD">SD</option>
									<option value="SMP">SMP</option>
									<option value="SMA">SMA / SMK</option>
									<option value="D1">D-I</option>
									<option value="D2">D-II</option>
									<option value="D3">D-III</option>
									<option value="D4">D-IV</option>
									<option value="S1">S-I</option>
									<option value="S2">S-II</option>
									<option value="S3">S-III</option>
									<option value="TIDAK TAMAT SD">TIDAK TAMAT SD</option>
									<option value="BELUM SEKOLAH">BELUM SEKOLAH</option>
								</select>
							</div>
							<div class="form-group">
								<label for="nohp" class="font-weight-bold">No. HP</label>
								<input name="nohp"
								type="text"
								id="nohp"
								class="form-control my-3"
								aria-describedby="nohpHelpBlock"
								data-validation-help="Masukan nohp / wa tanpa mengunakan +62.&nbsp; Contoh: 08215181****"
								data-validation="number length"
								data-validation-length="11-12"
								required="required">
							</div>
							<div class="form-group border-top">
								<label for="email" class="font-weight-bold pt-3">Email</label>
								<div class="input-group my-3">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="fas fa-mail-bulk"></i></div>
									</div>
									<input name="email"
									id="email"
									type="email"
									class="form-control"
									data-validation="email,server"
									data-sanitize="trim lower"
									placeholder="mail@website.com"
									data-validation-url="<?= base_url('frontend/v1/daftar/check_email') ?>"
									data-validation-param-name="email"
									required="required">
								</div>
							</div>
							<div class="form-group">
								<label for="password" class="font-weight-bold">Password</label>
								<div class="input-group my-3">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="fas fa-lock" aria-hidden="true"></i></div>
									</div>
									<input name="password"
									id="password"
									type="password"
									class="form-control"
									placeholder="Password"
									data-validation="alphanumeric"
									data-validation-allowing="@_"
									required="required">
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col">
										<label class="font-weight-bold pb-3 pt-3 border-top">Upload KTP
											<br> <span class="small text-danger">dengan menupload file KTP, menyatakan bahwah anda bersetuju berkontribusi dengan kami serta tunduk dengan aturan yang telah ditetapkan.</span>
										</label>
										<img src="<?= base_url('assets/images/noimage.gif'); ?>" alt="pic" width="100%" class="photo_ktp d-block mx-auto border border-info p-1 mb-3">
										<input name="photo_ktp"
										type="file"
										data-validation="mime size"
										data-validation-allowing="jpg, png"
										data-validation-max-size="2M"
										required="required">
										<small id="customFile" class="form-text text-muted">
										Upload file KTP.
										</small>
									</div>
								</div>
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
							<button type="submit" class="btn btn-lg btn-success btn-block mb-5"><i class="fas fa-check mr-2"></i> Daftar</button>
							<?= form_close(); ?>
						</div>
					</div>
					<div class="col-7 d-none d-sm-block d-md-block d-xl-block" id="content">
						<div class="d-flex justify-content-end mt-md-2" id="navSimple">
							<div><a href="<?= base_url('beranda') ?>" class="btn btn-link text-white"><i class="fas fa-home"></i> <br> Beranda</a></div>
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
		<script src="<?= base_url('template/v1/plugin/popmodal/popModal.min.js') ?>"></script>
		<script src="<?= base_url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>"></script>
		<script src="<?= base_url('assets/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.id.min.js') ?>"></script>
		
		<script src="<?php echo base_url('bower_components/jquery-form-validator/form-validator/jquery.form-validator.min.js'); ?>"></script>
		<script src="<?php echo base_url('bower_components/jquery-mask-plugin/dist/jquery.mask.min.js'); ?>"></script>
		<script src="<?= base_url('assets/js/f_daftar.js') ?>"></script>
	</body>
</html>