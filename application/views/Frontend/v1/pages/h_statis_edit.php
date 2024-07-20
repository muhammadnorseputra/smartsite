<section>
	<div class="container">
		<?php $token = $_GET['token']; ?>
		<?= form_open_multipart(base_url('frontend/v1/halaman/update/' . $token), ['id' => 'f_edit_halaman']) ?>
		<div class="row">
			<div class="col-md-12">
				<!-- form title halaman -->
				<div class="card rounded-0 bg-light border-0">
					<div class="card-header pb-0 bg-white border-bottom-0">
						<h5 class="card-title">
							Halaman Statis
							<span title="Dilihat" data-toggle="tooltip" data-placement="bottom" class="float-right px-3"><i class="fas fa-eye text-muted mr-2"></i> <small><?= $h->views ?></small></span>
						</h5>
					</div>
					<div class="card-body">
						<div class="form-group">
							<input type="title" name="title" value="<?= $h->title ?>" class="form-control form-control-lg" aria-describedby="titleHelp" placeholder="Masukan judul halaman kamu disini...">
							<small id="titleHelp" class="form-text text-muted small font-italic">Usahakan judul halaman menggunakan huruf kecil semua dan hanya menggukana spasi tanpa karakter lain</small>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-md-12">
				<!-- form cotent halaman -->
				<div class="card border-0 rounded-0">
					<div class="card-body py-2 px-0 border-right">
						<div class="form-group">
							<textarea class="form-control" name="content" id="content" rows="8">
						    	<?= $h->content ?>
						    </textarea>
						</div>
					</div>
					<div class="card-footer rounded-bottom bg-white">
						<?php
						if (!empty($h->filename)) :
							$path = $h->filename;
							$ext = pathinfo($path, PATHINFO_EXTENSION);
						?>
							<?php if ($ext === 'pdf') : ?>
								<object data="data:application/pdf;base64,<?= base64_encode($h->file) ?>" type="application/pdf" style="height:250px; width: 100%;"></object>
							<?php else : ?>
								<img src="data:image/jpeg;base64,<?= base64_encode($h->file) ?>" alt="<?= $h->filename ?>" class="mx-auto d-block w-100 mb-2">
							<?php endif; ?>
							<span class="badge badge-light">filename:</span>
							<span class="label">
								<?= $h->filename ?>
							</span>
							<button id="btn-hapus-lampiran" type="button" class="btn btn-default rounded-circle btn-sm float-right text-danger" data-toggle="tooltip" title="Hapus lampiran"><i class="fas fa-trash"></i></button>
							<button id="btn-upload-lampiran" type="button" class="btn btn-block btn-primary-old rounded-pill mt-2"><i class="fas fa-upload mr-2"></i> ganti-lampiran</button>
						<?php else : ?>
							<p class="text-info font-italic">Silahkan masukan lampiran berupa gambar atau pdf.</p>
							<button id="btn-upload-lampiran" type="button" class="btn btn-block btn-primary-old rounded-pill"><i class="fas fa-upload mr-2"></i> upload-lampiran</button>
						<?php endif; ?>
						<span class="filename badge badge-success"></span>
						<input type="file" name="lampiran" class="form-control d-none">
						<hr>
						<div class="custom-control custom-switch">
							<input type="checkbox" name="etoken" class="custom-control-input" id="updateToken">
							<label class="custom-control-label" for="updateToken">update token</label>
						</div>
						<hr>
						<button type="button" onclick="window.history.back(-1)" class="btn btn-outline-danger"><i class="fas fa-close mr-2"></i> Batal</button>
						<button type="submit" id="saveHalaman" class="btn btn-primary ml-1"><i class="fas fa-save mr-2"></i> Perbaharui</button>
					</div>
				</div>
			</div>
		</div>
		<?= form_close(); ?>
	</div>
</section>

<script defer src="<?= base_url('assets/js/jquery-3.3.1.min.js') ?>" crossorigin="anonymous"></script>
<script defer src="<?= base_url('files/tinymce/tinymce.min.js'); ?>" crossorigin="anonymous"></script>
<script defer src="<?= base_url('template/v1/js/route.js') ?>" crossorigin="anonymous"></script>
<script defer src="<?= base_url('template/v1/js_userportal/h_statis_edit.js'); ?>" crossorigin="anonymous"></script>