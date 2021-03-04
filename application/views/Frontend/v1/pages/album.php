<section class="hero py-5">
	<div class="container py-5">
		<div class="d-flex justify-content-center justify-content-md-center align-items-center">
			<div class="mx-2"><span class="font-weight-bold display-3 text-white">Album photo</span>
		</div>
	</div>
</div>
</section>
<section class="mb-3 mt--9">
<div class="container">
	<?php if($album->num_rows() > 0): ?>
	<?php
	$kolom = 4;
	$i = 1;
	?>
	<?php foreach($album->result() as $a): ?>
	<?php
		if(($i) % $kolom==1) {
	echo '<div class="d-flex justify-content-between flex-column flex-md-row align-self-stretch">';
		}
		?>
		<a href="<?= base_url('album/'.encrypt_url($a->id_album_foto)) ?>" class="w-100 bg-white mx-md-3 h-100">
			<div class="card border-0 w-100 p-md-3 mx-auto">
				<img class="rounded lazy img-fluid" data-src="data:image/jpeg;base64,<?= base64_encode($a->gambar_blob) ?>" alt="Card image">
				<div class="card-body bg-transparent px-0">
					<?php if($a->tgl_publish === date('Y-m-d')): ?><span class="badge badge-pill badge-warning float-right">New!</span> <?php endif; ?>
					<h5 class="card-title"><?= $a->judul ?></h5>
					<span class="text-secondary label"><?= $this->album->jml_photo_in_album($a->id_album_foto) ?> Photo</span> 
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
		<p class="text-secondary">Album belum ada</p>
	</div>
	<?php endif; ?>
</div>
</section>