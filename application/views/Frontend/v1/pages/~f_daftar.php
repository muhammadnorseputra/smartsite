<section class="bg-light mt-5 rellax">
	<div class="container">
		<div class="row">
			<div class="col-md-12 py-5 text-dark text-center">
				<h1>#Formulir Pendaftaran</h1>
				<p class="font-weight-nomal">Silahkan masukan data dengan lengkap pada bagian yang tersedia di bawah
					ini.</p>
			</div>
		</div>
	</div>
</section>

<section class="mb-5 mt--5">
	<div class="container">
		<div class="row">
			<div class="col-md-10 offset-md-1">
				<div class="card shadow-lg p-5 border-0">
					<?= form_open_multipart(base_url('frontend/v1/daftar/send'), ['id' => 'form_daftar', 'class' => 'toggle-disabled']); ?>
					<input type="hidden" name="session_register" value="<?php echo encrypt_url('bkppd_balangan'.date('d')) ?>">
					<div class="card-body">
						
						<div class="form-group">
							<div class="row">
							    <div class="col">
							    <label for="nama_lengkap">Nama Lengkap </label>	
							    <input name="nama_lengkap" 
							    	id="nama_lengkap" 
							    	type="text" 
							    	class="form-control" 
							    	placeholder="Nama Lengkap"
							    	data-validation="alphanumeric"
							    	data-validation-allowing=". '"
									data-sanitize="capitalize"
									value="<?= set_value('nama_lengkap') ?>" 
							    	required="required">
							    </div>
							    <div class="col">
							    <label for="nama_pangilan">Nama Panggilan <small>(only a-z characters, no space!)</small></label>	
							      <input name="nama_pangilan" 
							      	id="nama_pangilan" 
							      	type="text" 
							      	class="form-control" 
							      	placeholder="Nama panggilan kamu" 
							    	data-validation="custom,length"
							    	data-sanitize="trim lower strip"
							    	data-validation-length="min5"
							    	data-validation-regexp="^([a-z]+)$"
									value="<?= set_value('nama_pangilan') ?>" 
							      	required="required">
							    </div>
							</div>
						</div>
						<div class="form-group">
							<div class="form-group">
							    <label for="alamat">Alamat 
							    	<small>History (<span id="maxlength">150</span> characters left)</small>
							    </label>
							    <textarea name="alamat" 
									placeholder="Alamat sekarang ..." 
									class="form-control" 
									id="alamat" 
							    	data-validation="length"
							    	data-validation-length="min5"
									rows="3" 
									required="required"></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col">
									<textarea name="pekerjaan"
									class="form-control" 
									id="pekerjaan" 
							    	data-validation="length"
							    	data-validation-length="min5"
									rows="3" 
									required="required"></textarea>
									<span class="help-block font-weight-light">Deskripsikan pekerjaan anda</span>
								</div>
								<div class="col">
									<label for="pendidikan">Pendidikan Terkahir</label>
									<select class="custom-select" name="pendidikan" id="pendidikan" required="required">
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
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col">
									<label for="nohp">No. HP</label>
									<input name="nohp" 
										type="text" 
										id="nohp" 
										class="form-control" 
										aria-describedby="nohpHelpBlock"
										data-validation-help="Masukan nohp / wa tanpa mengunakan +62.&nbsp; Contoh: 08215181****"
										data-validation="number length"
										data-validation-length="11-12" 
										required="required">
								</div>
								<div class="col">
									<div id="tl-container">	
										<label for="tl">Tanggal Lahir</label>
										<input name="tanggal_lahir" 
										id="tl" 
										type="text" 
										class="form-control" 
										placeholder="Tanggal lahir"
										data-validation="date"
										data-validation-format="dd/mm/yyyy"
										required="required">
									</div>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header">
								<h5 class="card-title">Informasi Akun Masuk</h5>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col">
									
								    <label for="email">Email</label>
									<div class="input-group mb-2">
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
								    <div class="col">
								    <label for="password">Password</label>	
									<div class="input-group mb-2">
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
								</div>
							</div>
						</div>
						<div class="card mt-3">
							<div class="card-header">
								<h5 class="card-title">Informasi Verifikasi</h5>
							</div>
							<div class="card-body">
								<div class="form-group">
									<div class="row">
										<div class="col">
											<img src="<?= base_url('assets/images/no-profile-picture.jpg'); ?>" alt="pic" width="160" height="160" class="rounded-circle d-block mx-auto border border-info p-1 mb-3 photo_pic">
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
										<div class="col">
											<img src="<?= base_url('assets/images/noimage.gif'); ?>" alt="pic" width="260" height="160" class="photo_ktp d-block mx-auto border border-info p-1 mb-3">
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
							</div>
							<div class="card-footer bg-white">
								<?php 
								$this->session->set_userdata('captcha', array(mt_rand(0,9), mt_rand(1, 9)));
								?>
								<p>
									<?php 
									 $val_1 = $this->session->userdata('captcha')[0];
									 $val_2 = $this->session->userdata('captcha')[1];
									?>
									Berapa hasil penjumlahan dari <b><?= $val_1 ?> + <?= $val_2 ?></b> ?
									(security question)
									<div class="row">
									<div class="form-group col-4">
									<div class="input-group mb-2">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="fas fa-key"></i></div>
									</div>
									<input class="form-control" name="captcha" data-validation="spamcheck"
										data-validation-captcha="<?= ($val_1 + $val_2) ?>"/>
									</div>
									</div>
									</div>
								</p>
							</div>
						</div>
					</div>
					<div class="card-footer mx-auto d-block text-right p-4 bg-white">
						<button class="btn btn-primary px-5" type="submit">Submit</button>
						<button class="btn btn-danger px-5" type="reset">Reset</button>
					</div>

					<?= form_close(); ?>	
				</div>
			</div>
		</div>
	</div>
</section>
