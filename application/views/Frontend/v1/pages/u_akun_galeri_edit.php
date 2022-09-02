<?php
	$id = $this->uri->segment(5) ;
	$d  = $data;
?>
<section class="hero py-5">
	<div class="container py-5">
		<div class="col-md-8 offset-md-2 py-3 d-flex justify-content-between align-items-center">
			<div>
				<h5><span class="text-primary font-weight-bold"><?= $this->album->detail_photo(decrypt_url($id))->judul ?></span></h5>
			</div>
			<div>
				<button onclick="window.history.back(-1)" class="btn btn-sm btn-danger"><i class="fas fa-arrow-left"></i> Kembali</button>
			</div>
		</div>
	</div>
</div>
</section>
<section class="mb-3 mt--8">
<div class="container">
	<div class="col-md-8 offset-md-2 bg-white rounded p-4">
		<?php $this->load->view('msg/flashdata'); ?>
		<?= form_open_multipart(base_url('frontend/v1/album/update_foto')); ?>
		<input type="hidden" name="id_foto" value="<?= $id ?>">
		<div class="form-group">
			<h5>Ganti foto <span class="text-danger">*</span></h5>
			<div class="preview">
				<?php if(!empty($d->gambar)): ?>
				<img id="single-photo" src="<?= base_url('files/file_galeri/'.$d->gambar) ?>" class="img-fluid my-2" alt="noimage">
				<?php endif; ?>
			</div>
			<div class="alert alert-info" role="alert">
				Apabila gambar tidak di robah biarkan kosong!
			</div>
			<input type="file" name="foto" id="customFile">
			<small id="passwordHelpBlock" class="form-text text-muted">
			Jenis gambar yang diupload hanya bertipe <code>JPG, JPEG, PNG</code> dengan ukuran file sebesar <code>5MB</code>
			</small>
		</div>
		<div class="form-group">
			<label for="photo_judul">Judul photo<span class="text-danger">*</span></label>
			<input type="text" name="photo_judul" value="<?= $d->judul ?>" class="form-control" id="photo_judul" placeholder="Masukan judul photo disini.." required>
		</div>
		<div class="form-group">
			<label for="photo_keterangan">Deskripsi<span class="text-success">*</span></label>
			<textarea class="form-control" placeholder="Keterangan photo" name="photo_keterangan" id="photo_keterangan" cols="30" rows="4"><?= $d->keterangan ?></textarea>
		</div>
		<div class="form-group">
			<div class="form-check form-check-inline">
				<input class="form-check-input" name="publish_galeri" type="radio" id="inlineCheckbox1" value="Y" <?= $d->publish === 'Y' ? 'checked' : ''; ?>>
				<label class="form-check-label" for="inlineCheckbox1">Published</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" name="publish_galeri" type="radio" id="inlineCheckbox2" value="N" <?= $d->publish === 'N' ? 'checked' : ''; ?>>
				<label class="form-check-label" for="inlineCheckbox2">Not Publish</label>
			</div>
		</div>
		<button class="btn btn-primary"><i class="fas fa-save mr-2"></i> Simpan Perubahan</button>
		<?= form_close() ?>
	</div>
</div>
</section>
<script src="<?= base_url('bower_components/jquery/dist/jquery.min.js') ?>"></script>
<script>
/*Image Preview*/
function readURL(input, $element) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function(e) {
			$($element).attr('src', e.target.result);
		}
		reader.readAsDataURL(input.files[0]); /*convert to base64 string*/
	}
}
$("#customFile").on('change', function() {
	readURL(this, $('img#single-photo'));
});
</script>