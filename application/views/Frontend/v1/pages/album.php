<section class="hero py-5">
	<div class="container pt-md-5">
		<div class="d-flex justify-content-between align-items-start">
			<div>
				<h3 class="font-weight-bold text-dark text-responsive">Daftar Album</h3>
				<p class="text-muted small">Resources Dokumentasi BKPPD</p>
			</div>
		</div>
	</div>
</div>
</section>
<section class="mb-3 mt--7">
<div class="container">
	<div class="row">
		<?php if($album->num_rows() > 0): ?>
		<?php foreach($album->result() as $a): ?>
		<div class="col-6 col-sm-6 col-md-4 col-lg-4 shadow-lg">
		<a href="<?= base_url('album/'.encrypt_url($a->id_album_foto)) ?>" class="w-100 bg-white mx-md-3 h-100">
			<div class="card bg-white border-0 w-100 p-3 mx-auto">
				<div class="w-50 h-50 overflow-hidden">
				<?php if(!empty($a->gambar)): ?>
				<img class="rounded lazy img-fluid w-100" data-src="<?= base_url('files/file_album/'.$a->gambar) ?>" alt="Card image">
				<?php else: ?>
				<img class="rounded lazy img-fluid w-100" data-src="data:image/jpeg;base64,<?= base64_encode($a->gambar_blob) ?>" alt="Card image">
				<?php endif; ?>
				</div>
				<div class="card-body bg-transparent px-0">
					<?php if($a->tgl_publish === date('Y-m-d')): ?><span class="badge badge-pill badge-warning float-right">New!</span> <?php endif; ?>
					<div><?= $a->judul ?></div>
					<span class="text-secondary label"><?= $this->album->jml_photo_in_album($a->id_album_foto) ?> Photo</span>
				</div>
			</div>
		</a>
		</div>
		<?php endforeach; ?>
		<?php else: ?>
		<div class="jumbotron bg-transparent text-center">
			<h1 class="display-4 text-danger">Opps!</h1>
			<p class="text-secondary">Album belum ada</p>
		</div>
		<?php endif; ?>
	</div>
</div>
</section>