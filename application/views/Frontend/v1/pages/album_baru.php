<section class="py-5">
	<div class="container pb-5">
		<div class="col-md-4 offset-md-4 d-flex justify-content-center align-items-center">
			<div class="font-weight-bold text-center">
				<i class="fas fa-images fa-5x mb-3 text-dark"></i>
				<h4 class="text-dark">Create New Album</h4>
			</div>
		</div>
	</div>
</div>
</section>
<section class="mb-3 mt--8">
<div class="container">
	<div class="col-md-4 offset-md-4 bg-white rounded p-4">
		<?php $this->load->view('msg/flashdata'); ?>
		<?= form_open_multipart(base_url('frontend/v1/album/upload_album')); ?>
		<div class="form-group">
			<div class="preview">
				<img id="single-photo" src="<?= base_url('bower_components/SVG-Loaders/svg-loaders/undraw_folder_x4ft.svg') ?>" class="w-25 my-2" alt="noimage">
			</div>
			<small>Tambahkan foto Album <span class="text-danger">*</span></small>
			<input type="file" name="foto" id="customFile" required>
			<small id="passwordHelpBlock" class="form-text text-muted">
			Jenis gambar yang diupload hanya bertipe <code>JPG, JPEG, PNG</code> dengan ukuran file sebesar <code>3MB</code> dan dimensi <code>w:280 x h:280</code>
			</small>
		</div>
		<hr>
		<div class="form-group">
			<label for="photo_judul">Judul Album<span class="text-danger">*</span></label>
			<input type="text" name="photo_judul" class="form-control" id="photo_judul" placeholder="Masukan judul album disini.." required>
		</div>
		<div class="form-group">
			<label for="photo_keterangan">Deskripsi<span class="text-success">*</span></label>
			<textarea class="form-control" placeholder="Keterangan album" name="photo_keterangan" id="photo_keterangan" cols="30" rows="3"></textarea>
		</div>
		<div class="form-group">
			<div class="form-check form-check-inline">
				<input class="form-check-input" name="publish_album" type="radio" id="inlineCheckbox1" value="Y" checked>
				<label class="form-check-label" for="inlineCheckbox1">Published</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" name="publish_album" type="radio" id="inlineCheckbox2" value="N">
				<label class="form-check-label" for="inlineCheckbox2">Not Publish</label>
			</div>
		</div>
		<button class="btn btn-primary" type="submit"><i class="fas fa-save mr-2"></i> Simpan</button>
		<button onclick="window.history.back(-1)" type="button" class="btn btn-danger"> Kembali <i class="fas fa-arrow-right"></i></button>
		<?= form_close(); ?>
	</div>
</div>
</section>
<script src="<?= base_url('bower_components/jquery/dist/jquery.min.js') ?>"></script>
<script>
$("#customFile").on('change', function() {
	readURL(this, $('img#single-photo'));
});
</script>