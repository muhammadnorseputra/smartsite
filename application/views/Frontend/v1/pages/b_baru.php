<section class="hero py-5">
	<div class="container py-5">
		<div class="col-md-4 offset-md-4 py-3 d-flex justify-content-center align-items-center">
			<div class="font-weight-bold text-center">
				<i class="fas fa-image fa-5x mb-3"></i>
				<h4 class="text-muted">Created New Banner</h4>
			</div>
		</div>
	</div>
</div>
</section>
<section class="mb-3 mt--8">
<div class="container">
	<?php $this->load->view('msg/flashdata'); ?>
	<?= form_open_multipart(base_url('frontend/v1/banner/upload')); ?>
	<div class="row mb-3">
		<div class="col-md-6 bg-white border-right p-4">
			<div class="form-group">
					<span class="text-info">Silahkan Pilih Gambar</span>
				<div class="custom-file">
					<input type="file" name="gambar" class="custom-file-input" id="customFile">
					<label class="custom-file-label" for="customFile">Choose file</label>
				</div>
				<div class="preview">
					<img id="single-photo" src="<?= base_url('bower_components/SVG-Loaders/svg-loaders/undraw_folder_x4ft.svg') ?>" class="w-50 d-block mx-auto my-2" alt="noimage">
				</div>
			</div>
		</div>
		<div class="col-md-6 bg-white p-4">
			<div class="form-group">
				<select class="custom-select" name="idjns_banner">
					<option value="0">-- Posisi Banner -- </option>
					<?php foreach ($jnsbanner as $b): ?>
						<?php if($idjns == $b->id_jns_banner): ?>
						<option value="<?= $b->id_jns_banner ?>" selected><?= $b->posisi ?></option>
						<?php else: ?>
						<option value="<?= $b->id_jns_banner ?>"><?= $b->posisi ?></option>
						<?php endif; ?>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group pt-1">
				<label for="judul"><span class="text-info">Judul Banner</span></label>
				<input class="form-control form-control-lg" id="judul" name="judul" type="text" placeholder="Masukan judul disini">
			</div>
			<div class="form-group pt-1">
				<label for="keterangan"><span class="text-info">Keterangan</span></label>
				<textarea class="form-control form-control-lg" name="keterangan" id="keterangan" rows="3" placeholder="Masukan keterangan gambar"></textarea>
			</div>
			<div class="form-group pt-1">
				<label for="url"><span class="text-info">Url</span></label>
				<input class="form-control form-control-lg" id="url" name="url" type="text" placeholder="Masukan url atau link banner">
			</div>
			<div class="form-group">
				<div class="custom-control custom-radio">
					<input type="radio" id="customRadio1" name="publish"  value="Y" class="custom-control-input">
					<label class="custom-control-label" for="customRadio1">Active (tampilkan banner)</label>
				</div>
				<div class="custom-control custom-radio">
					<input type="radio" id="customRadio2" name="publish"  value="N" class="custom-control-input">
					<label class="custom-control-label" for="customRadio2">Unactive (jangan tampilkan banner)</label>
				</div>
			</div>
			<hr>
			<button type="submit" class="btn btn-primary btn-block">Simpan</button>
		</div>
	</div>
	<?= form_close(); ?>
</div>
</section>
<script src="<?= base_url('bower_components/jquery/dist/jquery.min.js') ?>"></script>
<script>
$("#customFile").on('change', function() {
	readURL(this, $('img#single-photo'));
});
</script>