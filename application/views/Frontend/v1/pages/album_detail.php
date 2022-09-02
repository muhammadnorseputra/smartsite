<section class="hero pt-md-5">
	<div class="container pt-md-5 pt-2">
		<div class="d-flex justify-content-center justify-content-md-center align-items-center">
			<p class="font-weight-bold mx-2">Album <i class="fas fa-chevron-right mx-2"></i>
				<span class="text-success"><?= $this->album->judul_album_by_id($id) ?></span>
			</p>
		</div>
	</div>
</div>
</section>
<section class="bg-dark">
<div class="container">
	<div class="row">
		<div class="col-md-8 offset-md-2">
			
	<?php if($photos->num_rows() > 0): ?>
	<?php
	$kolom = 3;
	$i = 1;
	?>
	<div id="carouselExampleIndicators" class="carousel slide shadow-lg" data-ride="carousel">
		<ol class="carousel-indicators">
			<?php foreach($photos->result() as $key => $value): $active = ($key == 0) ? 'active' : ''; ?>
			<li data-target="#carouselExampleIndicators" data-slide-to="<?= $key ?>" class="<?= $active ?>"></li>
			<?php endforeach; ?>
		</ol>
		<div class="carousel-inner">
			<?php foreach($photos->result() as $key => $value): $active = ($key == 0) ? 'active' : ''; ?>
			<div class="carousel-item <?= $active ?>">
				<!-- <img class="d-block w-100" src="..." alt="First slide"> -->
				<?php if(!empty($value->gambar)): ?>
				<img class="w-100 lazy d-block" data-src="<?= base_url('files/file_galeri/'.$value->gambar) ?>" alt="Card image">
				<?php else: ?>
				<img class="w-100 lazy d-block" data-src="data:image/jpeg;base64,<?= base64_encode($value->gambar_blob) ?>" alt="Card image">
				<?php endif; ?>
				<div class="carousel-caption d-none d-md-block">
				    <h5><?= $value->judul ?></h5>
				    <p class="small"><?= character_limiter($value->keterangan, 60) ?></p>
				</div>
			</div>
			<!-- <a href="data:image/jpeg;base64,<?= base64_encode($photo->gambar_blob) ?>" data-lightbox="img_album" class="w-100 bg-white mx-md-3 h-100 rounded" data-title="<?= $photo->keterangan ?>">
				<div class="card border-0 p-2 rounded-0 mx-auto bg-transparent">
					
					<div class="card-body bg-transparent">
						<span class="text-secondary small d-block mb-2"><i class="fas fa-calendar-alt mr-1"></i> Posted by <b class="text-info"><?= $photo->upload_by ?></b> &bull; <?= mediumdate_indo($photo->tgl_publish) ?></span>
						<h5 class="card-title"></h5>
						<p class="card-text text-secondary"></p>
					</div>
				</div>
			</a> -->
			<?php $i++; endforeach; ?>
		</div>
		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
	<?php else: ?>
	<div class="jumbotron bg-transparent text-center">
		<h1 class="display-4 text-danger">Opps!</h1>
		<p class="text-light">Album <b><?= $this->album->judul_album_by_id($id) ?></b> belum memiliki photo, album masih kosong.</p>
		<p class="lead">
			<a class="btn btn-primary btn-sm" href="<?= base_url('album') ?>" role="button"><i class="fas fa-arrow-left mr-2"></i>List album</a>
		</p>
	</div>
	<?php endif; ?>
		</div>
	</div>
</div>
</section>