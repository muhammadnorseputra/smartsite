<section class="hero py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-8 offset-md-1 my-md-5 pt-md-4 text-left pb-md-3 pb-5">
      	<h3 class="text-white">Edit Profile</h3>
      	<div class="text-white">Edit your profile identity</div>
      </div>
    </div>
  </div>
</section>
<?php  
if(!empty($profile->photo_pic)):
	$photo_pic = 'data:image/jpeg;base64,'.base64_encode($profile->photo_pic);
else:
	$photo_pic = base_url('assets/images/no-profile-picture.jpg');
endif;

if(!empty($profile->photo_ktp)):
	$photo_ktp = 'data:image/jpeg;base64,'.base64_encode($profile->photo_ktp);
else:
	$photo_ktp = base_url('assets/images/noimage.gif');
endif;

?>
<section class="mt--9">
	<div class="container mb-5">
		<div class="row">
			<div class="col-md-10 offset-md-1">
				<div class="card mt-4 bg-white shadow border-0">
					<div class="card-header border-light bg-transparent p-4">
						<h5 class="p-0 m-0">#Identitas</h5>
					</div>
					<div class="card-body px-4 py-0">
						<div class="form-group m-0">
							<div class="row">
								<div class="col text-center py-5">
									<img src="<?= $photo_pic ?>" alt="pic" width="160" height="160" class="rounded-circle d-block mx-auto border border-light p-1 mb-3 photo_pic">
									<input name="photo_pic" id="file" type="file" required="required" data-jenis="photo_pic">
									<small id="customFile" class="form-text text-muted msg-pic">
										Photo Profile.
									</small>
								</div>
								<div class="col text-center border-left border-light py-5">
									<img src="<?= $photo_ktp ?>" alt="pic" width="260" height="160" class="photo_ktp d-block mx-auto border border-light p-1 mb-3">
									<input name="photo_ktp" id="file" type="file" required="required" data-jenis="photo_ktp">
									<small id="customFile" class="form-text text-muted msg-ktp">
										Photo KTP.
									</small>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php  
					if(!$this->session->csrf_token) {
						$this->session->csrf_token = hash('sha1', time());
					}
				?>
				<?= form_open_multipart(base_url('frontend/v1/users/update/'), ['id' => 'form_edit'], ['xtoken' => $this->session->csrf_token]); ?>

				<input type="hidden" name="id" value="<?= encrypt_url($profile->id_user_portal) ?>">
				<div class="card mt-5 bg-white shadow border-0">
					<div class="card-header border-light bg-transparent p-4">
						<h5 class="p-0 m-0">#Edit Profile</h5>
					</div>
					<div class="card-body p-4">
						<div class="form-row">
							<div class="col">
								<label for="nama_lengkap">Nama Lengkap</label>
								<input name="nama_lengkap" id="nama_lengkap" type="text" class="form-control" placeholder="Nama Lengkap" data-validation="alphanumeric" data-validation-allowing=". '" data-sanitize="capitalize" value="<?= decrypt_url($profile->nama_lengkap); ?>" required="required">
							</div>
							<div class="col">
								<label for="nama_panggilan">Nama Panggilan <small>(only a-z characters, no space!)</small></label>
								<input name="nama_panggilan" id="nama_panggilan" type="text" class="form-control" placeholder="Nama panggilan kamu" data-validation="custom,length" data-sanitize="trim lower strip" data-validation-length="min5" data-validation-regexp="^([a-z]+)$" value="<?= decrypt_url($profile->nama_panggilan); ?>" required="required">
							</div>
						</div>

						<div class="form-group mt-3">
							<label for="alamat">Alamat
								<small>History (<span id="maxlength">250</span> characters left)</small>
							</label>
							<textarea name="alamat" placeholder="Alamat sekarang ..." class="form-control" id="alamat" data-validation="length" data-validation-length="min5" rows="3" required="required"><?= decrypt_url($profile->alamat); ?></textarea>
						</div>

						<div class="form-group">
							<label for="pekerjaan">Pekerjaan</label>
							<textarea name="pekerjaan" class="form-control" id="pekerjaan" data-validation="length" data-validation-length="min5" rows="3" required="required"><?= decrypt_url($profile->pekerjaan); ?></textarea>
						</div>

						<div class="form-row">
							<div class="col">
								<label for="nohp">Nohp</label>
								<input name="nohp" type="text" id="nohp" class="form-control" value="<?= decrypt_url($profile->nohp); ?>" aria-describedby="nohpHelpBlock" data-validation-help="Masukan nohp / wa tanpa mengunakan +62.&nbsp; Contoh: 08215181****" data-validation="number" required="required">
							</div>
							<div class="col">
								<label for="tl">Tanggal Lahir</label>
								<input name="tanggal_lahir" id="tl" type="text" class="form-control" value="<?= $profile->tanggal_lahir; ?>" placeholder="Tanggal lahir" data-validation="date" data-validation-format="yyyy-mm-dd" required="required">
							</div>
						</div>
						<div class="form-row mt-3">
							<div class="col-6">
								<div class="form-group">
									<label for="pendidikan">Pendidikan Terkahir</label>
									<select class="custom-select" name="pendidikan" id="pendidikan" required="required">
										<option value="">-- Pilih Pendidikan --</option>
										<option value="SD" <?= decrypt_url($profile->pendidikan) == 'SD' ? 'selected' : ''; ?>>SD</option>
										<option value="SMP" <?= decrypt_url($profile->pendidikan) == 'SMP' ? 'selected' : ''; ?>>SMP
										</option>
										<option value="SMA" <?= decrypt_url($profile->pendidikan) == 'SMA' ? 'selected' : ''; ?>>SMA / SMK
										</option>
										<option value="D1" <?= decrypt_url($profile->pendidikan) == 'D1' ? 'selected' : ''; ?>>D-I</option>
										<option value="D2" <?= decrypt_url($profile->pendidikan) == 'D2' ? 'selected' : ''; ?>>D-II</option>
										<option value="D3" <?= decrypt_url($profile->pendidikan) == 'D3' ? 'selected' : ''; ?>>D-III
										</option>
										<option value="D4" <?= decrypt_url($profile->pendidikan) == 'D4' ? 'selected' : ''; ?>>D-IV</option>
										<option value="S1" <?= decrypt_url($profile->pendidikan) == 'S1' ? 'selected' : ''; ?>>S-I</option>
										<option value="S2" <?= decrypt_url($profile->pendidikan) == 'S2' ? 'selected' : ''; ?>>S-II</option>
										<option value="S3" <?= decrypt_url($profile->pendidikan) == 'S3' ? 'selected' : ''; ?>>S-III
										</option>
										<option value="TIDAK TAMAT SD" <?= decrypt_url($profile->pendidikan) == 'TIDAK TAMAT SD' ? 'selected' : ''; ?>>TIDAK TAMAT SD
										</option>
										<option value="BELUM SEKOLAH" <?= decrypt_url($profile->pendidikan) == 'BELUM SEKOLAH' ? 'selected' : ''; ?>>BELUM SEKOLAH
										</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="card my-5 bg-white shadow border-0">
					<div class="card-header border-light bg-transparent p-4">
						<h5 class="p-0 m-0">#Deskripsi</h5>
					</div>
					<div class="card-body py-2 px-4">
						<div class="form-group mt-3">
							<label for="deskripsi">Deskripsi akun</label>
							<textarea name="deskripsi" class="form-control" id="deskripsi" rows="3"><?= $profile->deskripsi; ?></textarea>
						</div>
					</div>
				</div>

				<div class="card mb-3 border-0 shadow">
					<div class="card-header border-light bg-transparent p-4">
						<h5 class="p-0 m-0">#Informasi masuk</h5>
					</div>
					<div class="card-body p-4">
						<div class="form-row">
							<div class="col">

								<label for="email">Email</label>
								<div class="input-group mb-2">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="fas fa-mail-bulk"></i></div>
									</div>
									<input name="email" value="<?= decrypt_url($profile->email); ?>" id="email" type="email" class="form-control" placeholder="Email" disabled="disabled" required="required">
								</div>
							</div>
							<div class="col">
								<label for="password">Password</label>
								<div class="input-group mb-2">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="fas fa-lock" aria-hidden="true"></i></div>
									</div>
									<input name="password" id="password" type="password" class="form-control" placeholder="Password" data-validation="alphanumeric" data-validation-allowing="@_" data-validation-optional="true">
								</div>
							</div>

						</div>
					</div>
				</div>

				<button type="submit" id="save" class="btn btn-lg btn-primary">
					<i class="fas fa-save mr-2"></i> Simpan perubahan
				</button>
				<button onclick="window.history.back(-1)" type="button" class="btn btn-link btn-lg">Batalkan</button>

				
				<?= form_close(); ?>
				<div class="card mt-5 border-danger">
					<div class="card-header border-danger bg-transparent p-4">
						<h5 class="p-0 m-0 text-danger">Hapus Akun</h5>
					</div>
					<div class="card-body p-4">
						<p class="text-muted">
							Saya ingin menghapus akun, semua data yang saya buat akan ikut terhapus secara permanen.
						</p>
						<a href="<?= base_url('frontend/v1/users/hapus_akun/'.$id) ?>" onclick="return confirm('Apakah anda yakin akan menghapus akun?')" id="hapus_akun" type="button" class="btn btn-danger">
						<i class="fas fa-trash mr-2"></i> Hapus akun saya!</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
