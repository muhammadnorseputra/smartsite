<section class="mt-5 pt-3">
	<div class="container border-top border-light pt-3">
		<div class="d-flex justify-content-start align-items-center">
			<div class="mr-md-3 pr-md-3"><span class="font-weight-bold display-4">Kotak Saran</span> <br>
			<p class="font-weight-bold">Silahkan masukan saran anda terkait layanan yang kami berikan diwebsite ini maupun ditempat kerja.</p>
		</div>
	</div>
</div>
</section>
<section class="my-md-3">
<div class="container">
	<div class="row">
		<div class="col-md-6 mt-4">
			<?php if($this->session->flashdata('captcha_salah') <> ''): ?>
			<div class="alert alert-danger" role="alert">
			  <p class="mb-0"><?= $this->session->flashdata('captcha_salah') ?></p>
			</div>
			<?php else: ?>
			<div class="alert alert-warning" role="alert">
			  <p class="mb-0">Bagian yang bertanda (<span class="text-danger">*</span>) wajib diisi.</p>
			</div>
			<?php endif; ?>
			<div class="card bg-white border-light">
				<div class="card-body">
					<?= form_open(base_url('frontend/v1/halaman/simpan_saran')); ?>
					<div class="form-group">
						<label for="nama_lengkap">Nama <span class="text-danger">*</span></label>
						<input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap" placeholder="Masukan nama kamu" value="<?php echo set_value('nama_lengkap'); ?>">
						<?php echo form_error('nama_lengkap'); ?>
					</div>
					<div class="form-group">
						<label for="email">Email <span class="text-info">(Opsional)</span></label>
						<input type="email" name="email" class="form-control" id="email" placeholder="Masukan email address" value="<?php echo set_value('email'); ?>">
						<small id="email" class="form-text text-muted pl-1">
						apabila nantinya kami memberikan balasan kepada saran yang kamu berikan silahkan masukan alamat email kamu, <u class="text-info">pilihan ini opsional/boleh tidak diisi</u>.
						</small>
					</div>
					<div class="form-group">
						<label for="isi">Isi Saran <span class="text-danger">*</span></label>
						<textarea name="isi_saran" placeholder="Isi saran kamu disini ..." class="form-control" id="isi" rows="3"><?php echo set_value('isi_saran'); ?></textarea>
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
					<div class="input-group">
						<input type="text" name="captcha" class="form-control" placeholder="Masukan hasil penjumlahan tersebut?" aria-describedby="button-addon2">
						<div class="input-group-append">
							<button class="btn btn-primary btn-sm" type="submit" id="button-addon2">Kirim Saran</button>
						</div>
						
					</div>
					<?php echo form_error('captcha'); ?>
					<?= form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
</section>