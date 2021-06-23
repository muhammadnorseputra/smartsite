<section class="survei-non-asn">
	<div class="py-3 px-2 bg-secondary bg-gradient text-center">
		<h3 class="text-light">Formulir Survei IKM (NON ASN Balangan)</h3>
	</div>
	<?php  
	$hidden = ['token_' => encrypt_url('bkppd_balangan_'.date('dmY')), 'nomor' => $nomor];
	echo form_open(base_url('frontend/skm/skmProses'), ['id' => 'f-survei-non-asn'], $hidden);
	?>
	<div class="container">
		<div class="card my-3">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-center">
					<div>
						<h5 class="card-title fw-bold">I. Data Responden</h5>
						<h6 class="card-subtitle mb-2 text-muted">Sebelum memulai survei, silahkan isi data diri responden</h6>
					</div>
					<div>
						<h5 class="text-muted d-none d-md-block">F-<?= strtoupper($nomor) ?></h5>
					</div>
				</div>

				<hr>
				<div class="row mb-md-4 mb-3 gy-3">
					<div class="col-md-4">
						<label for="namalengkap" class="form-label fw-bold">Nama Lengkap</label>
						<input type="text" name="nama_lengkap" class="form-control form-control-lg" id="namalengkap" placeholder="Nama Lengkap" data-validation="required">
						<div class="invalid-feedback">
					        Silahkan masukan Nama Lengkap kamu.
					      </div>
					</div>
					<div class="col-md-4">
						<label for="jk" class="form-label fw-bold">Jenis Kelamin</label>
						<select name="jns_kelamin" class="form-select form-select-lg" id="jk" aria-label=".form-select-lg" data-validation="required">
							<option value="" selected>Pilih Jenis Kelamin</option>
							<option value="L">Laki - Laki (L)</option>
							<option value="P">Perempuan (P)</option>
						</select>
					</div>
					<div class="col-md-4">
						<label for="umur" class="form-label fw-bold">Umur</label>
						<input type="text" data-validation="number" data-validation-allowing="range[1;100]" name="umur" class="form-control form-control-lg" id="umur" placeholder="Umur" data-validation="required">
					</div>
				</div>
				<div class="row mb-4 gy-3">
					<div class="col-md-4">
						<label for="jenis-layanan" class="form-label fw-bold">Jenis Layanan</label>
						<select name="jns_layanan" class="form-select form-select-lg" id="jenis-layanan" aria-label=".form-select-lg" data-validation="required">
							<option value="" selected>Pilih Layanan</option>
							<?php foreach($jenis_layanan->result() as $jl): ?>
								<option value="<?= $jl->id ?>"><?= strtoupper($jl->nama_jenis_layanan) ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="col-md-4">
						<label for="pendidikan" class="form-label fw-bold">Pendidikan Terakhir</label>
						<select name="pendidikan" class="form-select form-select-lg" id="pendidikan" aria-label=".form-select-lg" data-validation="required">
							<option value="" selected>Pilih Tingkat Pendidikan</option>
							<?php foreach($pendidikan->result() as $p): ?>
								<option value="<?= $p->id ?>"><?= strtoupper($p->tingkat_pendidikan) ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="col-md-4">
						<label for="pekerjaan" class="form-label fw-bold">Pekerjaan</label>
						<select name="pekerjaan" class="form-select form-select-lg" id="pekerjaan" aria-label=".form-select-lg" data-validation="required">
							<option value="" selected>Pilih Pekerjaan</option>
							<?php foreach($pekerjaan->result() as $pj): ?>
								<option value="<?= $pj->id ?>"><?= strtoupper($pj->jenis_pekerjaan) ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<h5 class="card-title fw-bold">II. Pendapat Responden Tentang Pelayanan</h5>
				<h6 class="card-subtitle mb-2 text-muted">Silahkan pilih jawaban yang tersedia.</h6>
				<hr>
				<ul class="list-group list-group-flush">
					<?php foreach($pertanyaan->result() as $p): ?>
					<li class="list-group-item py-4">
						<p class="fw-bold"><?= ucwords($p->jdl_pertanyaan) ?></p>
						<?php foreach($this->skm->skm_jawaban_pertanyaan($p->id)->result() as $j):  ?>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="jawaban_id[<?= $j->fid_pertanyaan ?>]" id="<?= $j->fid_pertanyaan ?>-<?= $j->id ?>" value="<?= $j->fid_pertanyaan ?>-<?= $j->id ?>" data-validation="required" data-validation-error-msg="Pilih salahsatu jawaban yang tersedia">
							<label class="form-check-label text-muted" for="<?= $j->fid_pertanyaan ?>-<?= $j->id ?>">
								<?= $j->jdl_jawaban ?> 
							</label>
						</div>
						<?php endforeach; ?>
					</li>
					<?php endforeach; ?>
				</ul>
				<hr>
				<p>
				    <input data-validation="recaptcha" data-validation-recaptcha-sitekey="6LfiM08bAAAAAJkf5geIEBau6f9-kMOEzxkxw06_">
				</p>
				<button type="submit" class="btn btn-primary btn-lg">Kirim Survei
				<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-up-right-square ms-3" viewBox="0 0 16 16">
					<path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5.854 8.803a.5.5 0 1 1-.708-.707L9.243 6H6.475a.5.5 0 1 1 0-1h3.975a.5.5 0 0 1 .5.5v3.975a.5.5 0 1 1-1 0V6.707l-4.096 4.096z"/>
				</svg>
				</button>
			</div>
		</div>
	</div>
	<?= form_close(); ?>
</section>