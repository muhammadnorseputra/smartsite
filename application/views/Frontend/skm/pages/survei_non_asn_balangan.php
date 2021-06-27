<section class="survei-non-asn">
	<div class="py-3 px-2 bg-secondary bg-gradient text-center">
		<h3 class="text-light">Formulir Survei IKM (NON ASN Balangan)</h3>
	</div>
	<?php  
	$hidden = ['token_' => encrypt_url('@270599bkppd_balangan_'.date('dmYH')), 'nomor' => encrypt_url($nomor), 'card' => $_GET['card'], 'periode' => encrypt_url($periode->id)];
	echo form_open(base_url('frontend/skm/skmProses'), ['id' => 'f-survei-non-asn', 'class' => 'toggle-disabled'], $hidden);
	?>
	<div class="container">
		<div class="card my-3 bg-light shadow-sm">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-center">
					<div>
						<h5 class="card-title fw-bold">I. Data Responden</h5>
						<h6 class="card-subtitle mb-2 text-muted">Sebelum memulai survei, silahkan isi data diri responden</h6>
					</div>
					<div>
						<h5 class="text-muted d-none d-md-block"><abbr title="Ini adalah kode formulir anda.">F-<?= strtoupper($nomor) ?></abbr></h5>
					</div>
				</div>

				<hr>
				<div class="row mb-md-4 mb-3 g-3">
					<div class="col-md-4">
						<div class="form-floating">
							<input type="text" name="nama_lengkap" class="form-control" id="namalengkap" placeholder="Nama Lengkap" data-validation="required">
							<label for="namalengkap" class="form-label fw-bold">Nama Lengkap</label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-floating">
						<input type="text" data-validation="number" data-validation-allowing="range[18;60]" name="umur" data-validation-help="Batasan umur 18 - 60 tahun." class="form-control" id="umur" placeholder="Umur - only number" data-validation="required">
						<label for="umur" class="form-label fw-bold">Umur</label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-floating">
							<select name="jns_kelamin" class="form-select" id="jk" aria-label=".form-select-lg" data-validation="required">
								<option value="" selected>Pilih Jenis Kelamin</option>
								<option value="L">Laki - Laki (L)</option>
								<option value="P">Perempuan (P)</option>
							</select>
							<label for="jk" class="form-label fw-bold">Jenis Kelamin</label>
						</div>
					</div>
				</div>
				<div class="row mb-4 g-3">
					<div class="col-md-4">
						<div class="form-floating">
						<select name="jns_layanan" class="form-select" id="jenis-layanan" aria-label=".form-select-lg" data-validation="required">
							<option value="" selected>Pilih Layanan</option>
							<?php foreach($jenis_layanan->result() as $jl): ?>
								<option value="<?= $jl->id ?>"><?= strtoupper($jl->nama_jenis_layanan) ?></option>
							<?php endforeach; ?>
						</select>
						<label for="jenis-layanan" class="form-label fw-bold">Jenis Layanan</label>
					</div>
					</div>
					<div class="col-md-4">
						<div class="form-floating">
						<select name="pendidikan" class="form-select" id="pendidikan" aria-label=".form-select-lg" data-validation="required">
							<option value="" selected>Pilih Tingkat Pendidikan</option>
							<?php foreach($pendidikan->result() as $p): ?>
								<option value="<?= $p->id ?>"><?= strtoupper($p->tingkat_pendidikan) ?></option>
							<?php endforeach; ?>
						</select>
						<label for="pendidikan" class="form-label fw-bold">Pendidikan Terakhir</label>
					</div>
					</div>
					<div class="col-md-4">
						<div class="form-floating">
						<select name="pekerjaan" class="form-select" id="pekerjaan" aria-label=".form-select-lg" data-validation="required">
							<option value="" selected>Pilih Pekerjaan</option>
							<?php foreach($pekerjaan->result() as $pj): ?>
								<option value="<?= $pj->id ?>"><?= strtoupper($pj->jenis_pekerjaan) ?></option>
							<?php endforeach; ?>
						</select>
						<label for="pekerjaan" class="form-label fw-bold">Pekerjaan</label>
					</div>
					</div>
				</div>
				<h5 class="card-title fw-bold">II. Pendapat Responden Tentang Pelayanan</h5>
				<h6 class="card-subtitle mb-2 text-muted">Silahkan pilih jawaban yang tersedia.</h6>
				<hr>
				<ul class="list-group list-group-flush rounded-3">
					<?php foreach($pertanyaan->result() as $p): ?>
					<li class="list-group-item py-4  border-light">
						<p class="fw-bold user-select-none"><?= ucwords($p->jdl_pertanyaan) ?> ?</p>
						<?php foreach($this->skm->skm_jawaban_pertanyaan($p->id)->result() as $j):  ?>
						<div class="badge border-start border-danger rounded-0" id="msg-check-<?= $j->fid_pertanyaan  ?>"></div>
						<div class="d-flex justify-content-start gap-3">
							<input class="shadow" type="radio" name="jawaban_id[<?= $j->fid_pertanyaan ?>]" id="<?= $j->fid_pertanyaan ?>-<?= $j->id ?>" value="<?= $j->id ?>" data-validation="required" data-validation-error-msg-container="#msg-check-<?= $j->fid_pertanyaan ?>" data-validation-error-msg="Silahkan pilih salahsatu jawaban yang tersedia!">
							<label class="form-check-label text-muted" for="<?= $j->fid_pertanyaan ?>-<?= $j->id ?>">
								<?= $j->jdl_jawaban ?> 
							</label>
						</div>
						<?php endforeach; ?>
					</li>
					<?php endforeach; ?>
				</ul>
				<hr>
				<!-- <p>
				    <input data-validation="recaptcha" data-validation-recaptcha-sitekey="6LfiM08bAAAAAJkf5geIEBau6f9-kMOEzxkxw06_">
				</p> -->
				<button type="submit" class="btn btn-primary btn-lg px-5">Kirim Survei</button>
			</div>
		</div>
	</div>
	<?= form_close(); ?>
</section>