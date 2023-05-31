<section>
	<div class="container pt-md-5">
		<div class="row offset-md-2">	
			<div class="d-flex justify-content-between align-items-start offset-lg-0">
				<div>
					<h3 class="font-weight-bold text-dark text-responsive">Daftar Album</h3>
					<p class="text-muted small">Resources Dokumentasi BKPPD</p>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<section class="mb-3">
<div class="container">
	<div class="row offset-md-2">
	<div class="card-columns">
		<?php if($album->num_rows() > 0): ?>
		<?php foreach($album->result() as $a): ?>
			<a href="<?= base_url('album/'.$a->slug) ?>">
					<div class="card bg-white border-0 shadow-sm">
							<?php if(!empty($a->gambar)): ?>
							<img style="object-fit:cover; height:160px; width;100%;" class="rounded-top lazy card-img-top img-fluid" data-src="<?= base_url('files/file_album/'.$a->gambar) ?>" alt="Card image">
							<?php else: ?>
							<img style="object-fit:cover; height:160px; width;100%;" class="rounded-top lazy card-img-top img-fluid" data-src="data:image/jpeg;base64,<?= base64_encode($a->gambar_blob) ?>" alt="Card image">
							<?php endif; ?>
						<div class="card-body bg-white">
							<?php if($a->tgl_publish === date('Y-m-d')): ?><span class="badge badge-pill badge-warning float-right">New!</span> <?php endif; ?>
							<h6><?= $a->judul ?></h6>
							<span class="text-secondary badge"><i class="fas fa-images mr-2"></i><?= $this->album->jml_photo_in_album($a->id_album_foto) ?> Photo</span>
						</div>
					</div>
			</a>
		<?php endforeach; ?>
		<?php else: ?>
		<div class="jumbotron bg-transparent text-center">
			<h1 class="display-4 text-danger">Opps!</h1>
			<p class="text-secondary">Album belum ada</p>
		</div>
		<?php endif; ?>
	</div>
</div>
</div>
</section>