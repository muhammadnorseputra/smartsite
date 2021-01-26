<?php $id = decrypt_url($this->uri->segment(5)) ?>
<section class="mt-5 pt-3">
	<div class="container border-top border-light pt-3">
		<div class="d-flex justify-content-start align-items-center">
			<div class="mr-md-3 pr-md-3"><span class="font-weight-bold display-4">Album</span> <br>
			<p class="font-weight-bold text-secondary">Photo <i class="fas fa-chevron-right mx-2"></i>
				<span class="text-success"><?= $this->album->judul_album_by_id($id) ?></span>
			</p>
		</div>
	</div>
</div>
</section>
<section class="my-md-3">
	<div class="container">
			<?php if($photos->num_rows() > 0): ?>
				<?php 
					$kolom = 2;
                    $i = 1;	
				?>
				<?php foreach($photos->result() as $photo): ?>
				<?php 
					if(($i) % $kolom==1) {
	                    echo '<div class="d-flex justify-content-between flex-column flex-md-row align-items-stretch">';
	                } 
                ?>
                	<a href="data:image/jpeg;base64,<?= base64_encode($photo->gambar_blob) ?>" data-lightbox="img_album" data-title="<?= $photo->keterangan ?>">
					<div class="card border-0 p-2 rounded-0 mx-auto bg-transparent">
						<img class="card-img rounded-lg shadow lazy" data-src="data:image/jpeg;base64,<?= base64_encode($photo->gambar_blob) ?>" alt="Card image">
						<div class="card-body bg-transparent">
							<span class="text-secondary small d-block mb-2"><i class="fas fa-calendar-alt mr-1"></i> Posted by <b class="text-info"><?= $photo->upload_by ?></b> | <?= mediumdate_indo($photo->tgl_publish) ?></span>
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
			<div class="jumbotron text-center">
				<h1 class="display-4 text-danger">Opps!</h1>
				<p class="lead">Album ini belum memiliki photo, album masih kosong.</p>
				<hr class="my-4 border-light">
				<p class="lead">
					<a class="btn btn-primary btn-lg" href="#" role="button"><i class="fas fa-arrow-left mr-2"></i>List album</a>
				</p>
			</div>
			<?php endif; ?>
	</div>
</section>