<?php $id = decrypt_url($this->uri->segment(2)) ?>
<div class="w-100">&nbsp;</div>
<section class="mt-5">
	<div class="container py-3">
		<div class="d-flex justify-content-center justify-content-md-start align-items-center">
			<p class="font-weight-bold text-secondary mx-2">Album <i class="fas fa-chevron-right mx-2"></i>
				<span class="text-success"><?= $this->album->judul_album_by_id($id) ?></span>
			</p>
		</div>
	</div>
</div>
</section>
<section>
	<div class="container">
			<?php if($photos->num_rows() > 0): ?>
				<?php 
					$kolom = 3;
                    $i = 1;	
				?>
				<?php foreach($photos->result() as $photo): ?>
				<?php 
					if(($i) % $kolom==1) {
	                    echo '<div class="d-flex justify-content-between align-items-stretch flex-no-wrap flex-column flex-md-row">';
	                } 
                ?>
                	<a href="data:image/jpeg;base64,<?= base64_encode($photo->gambar_blob) ?>" data-lightbox="img_album" class="w-100" data-title="<?= $photo->keterangan ?>">
					<div class="card border-0 p-2 rounded-0 mx-auto bg-transparent">
						<img class="rounded-lg shadow lazy img-fluid" data-src="data:image/jpeg;base64,<?= base64_encode($photo->gambar_blob) ?>" alt="Card image">
						<div class="card-body bg-transparent">
							<span class="text-secondary small d-block mb-2"><i class="fas fa-calendar-alt mr-1"></i> Posted by <b class="text-info"><?= $photo->upload_by ?></b> &bull; <?= mediumdate_indo($photo->tgl_publish) ?></span>
							<h5 class="card-title"><?= $photo->judul ?></h5>
							<p class="card-text text-secondary"><?= character_limiter($photo->keterangan, 50) ?></p>
						</div>
					</div>
					</a>
				<?php  
					if(($i) % $kolom==0) {
                        echo '</div>';
                    }
				?>
				<?php $i++; endforeach; ?>
			<?php else: ?>
			<div class="jumbotron bg-transparent text-center">
				<h1 class="display-4 text-danger">Opps!</h1>
				<p class="text-secondary">Album <b><?= $this->album->judul_album_by_id($id) ?></b> belum memiliki photo, album masih kosong.</p>
				<p class="lead">
					<a class="btn btn-primary btn-sm" href="<?= base_url('frontend/v1/album') ?>" role="button"><i class="fas fa-arrow-left mr-2"></i>List album</a>
				</p>
			</div>
			<?php endif; ?>
	</div>
</section>