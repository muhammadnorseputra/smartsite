<section>
<div class="container">
	<div class="row my-4">
		<div class="col-md-7 bg-white p-md-5 rounded">
			<div class="mr-md-3 pr-md-3">
				<div>
                        <span class="separator-text text-uppercase font-weight-bold text-dark"><i class="fas fa-box text-dark mr-2"></i>Kotak Saran</span>
                </div>
					<p class="text-muted">Silahkan masukan saran anda terkait layanan atau maupun fitur yang kami berikan di website.</p>
				</div>
			<?php if($this->session->flashdata('captcha_salah') <> ''): ?>
			<div class="alert alert-danger" role="alert">
				<p class="mb-0"><?= $this->session->flashdata('captcha_salah') ?></p>
			</div>
			<?php endif; ?>
			<div class="card border-0">
				<div class="card-body px-0">
					<?= form_open(base_url('kirim_saran')); ?>
					<div class="form-group">
						<label for="nama_lengkap">Nama <span class="text-danger">*</span></label>
						<input type="text" name="nama_lengkap" class="rounded-0 shadow-sm form-control-lg form-control <?= !form_error('nama_lengkap') ? 'is-valid' : 'is-invalid'  ?>" id="nama_lengkap" placeholder="Masukan nama kamu" value="<?php echo set_value('nama_lengkap'); ?>">
						<?php echo form_error('nama_lengkap'); ?>
					</div>
					<div class="form-group">
						<label for="category">Ketegori Saran <span class="text-danger">*</span></label>
						<select class="rounded-0 shadow-sm form-control-lg form-control" name="category" id="category">
							<option value="">-- Pilih Kategori --</option>
							<option value="si-tpp">Layanan SI-TPP</option>
							<option value="si-atun">Layanan SI-Atun</option>
							<option value="si-petruk">Layanan SI-Petruk</option>
							<option value="si-piansatu">Layanan SI-PianSatu</option>
							<option value="epensiun">Layanan ePensiun (SIMPUN)</option>
							<option value="coaching-skp">Layanan Coaching Clinic SKP</option>
							<option value="email_verify">Verifikasi Email</option>
							<option value="update">Update Tampilan (UI&UX)</option>
							<option value="fitur">Fitur Website</option>
							<option value="layanan">Layanan Website</option>
							<option value="peforma">Peforma</option>
							<option value="bug">Error / BUG</option>
							<option value="lainnya">Lainnya</option>
						</select>
						<?php echo form_error('category'); ?>
					</div>
					<div class="form-group">
						<label for="email">Email <span class="text-info">(Opsional)</span></label>
						<input type="email" name="email" class="rounded-0 shadow-sm form-control-lg form-control <?= !form_error('email') ? 'is-valid' : 'is-valid'  ?>" id="email" placeholder="Masukan email address" value="<?php echo set_value('email'); ?>">
						<small id="email" class="form-text text-muted pl-1">
						apabila nantinya kami memberikan balasan kepada saran yang kamu berikan silahkan masukan alamat email kamu, <u class="text-info">pilihan ini opsional/boleh tidak diisi</u>.
						</small>
					</div>
					<div class="form-group">
						<label for="isi">Isi Saran <span class="text-danger">*</span></label>
						<textarea name="isi_saran" placeholder="Isi saran kamu disini ..." class="rounded-0 shadow-sm form-control-lg form-control <?= !form_error('isi_saran') ? 'is-valid' : 'is-invalid'  ?>" id="isi" rows="3"><?php echo set_value('isi_saran'); ?></textarea>
						<?php echo form_error('isi_saran'); ?>
					</div>
					<div class="form-group">
						<?php
							$this->session->set_userdata('captcha', array(mt_rand(0,9), mt_rand(1, 9)));
						?>
						<?php
						$val_1 = $this->session->userdata('captcha')[0];
						$val_2 = $this->session->userdata('captcha')[1];
						?>
						<p class="mb-2">
							Penjumlahan <span class="text-danger">*</span> <h3><?= $val_1 ?> + <?= $val_2 ?></h3>
						</p>
					</div>
					<div class="input-group col-md-7 pl-0">
						<input type="text" name="captcha" class="rounded-0 shadow-sm form-control-lg form-control <?= !form_error('captcha') ? 'is-valid' : 'is-invalid'  ?>" placeholder="Masukan hasil?" aria-describedby="button-addon2">
						<div class="input-group-append">
							<button class="btn btn-primary btn-sm" type="submit" id="button-addon2">Kirim Saran</button>
						</div>
						
					</div>
					<?php echo form_error('captcha'); ?>
					<?= form_close(); ?>
				</div>
			</div>
		</div>
		<div class="col-md-5 d-none bg-primary rounded shadow d-md-block d-lg-block d-xl-block">
			<div class=" d-flex justify-content-center align-items-center h-100">
			<img src="<?= base_url('assets/images/bg/Gak Pusying.235aa0ce.png') ?>" alt="saran-buat-website-bkppd-nih-bagai-mana-ya" class="img-fluid">
			</div>
		</div>
	</div>
</div>
</section>