
<section class="my-5">
	<div class="container">
		<div class="row">
			<div class="col-md-6 mt-5">
				<?php if($this->session->flashdata('msg') == true): ?>
					<blockquote class="blockquote text-center">
					  <p class="mb-0"><i class="fas fa-check fa-3x text-success"></i> <br> Berhasil, saran anda telah dikirim</p>
					  <footer class="blockquote-footer mt-3">Isi saran lain? <a href="<?= base_url('frontend/v1/halaman/saran') ?>" class="btn btn-sm btn-primary">Kotak saran</a></footer>
					</blockquote>
				<?php else: ?>
					<div class="alert alert-danger" role="alert">
					  <h4 class="alert-heading">Oops!</h4>
					  <p>Sepertinya terjadi kesalahan dalam menyimpan saran kamu, coba refresh browser dan kembali lagi isi saran.</p>
					  <hr>
					  <p class="mb-0">
					  	<a href="<?= base_url('frontend/v1/halaman/saran') ?>" class="btn btn-sm btn-info">Kembali isi saran</a>
					  </p>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>