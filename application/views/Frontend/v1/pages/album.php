<div class="w-100">&nbsp;</div>
<section class="mt-5 bg-light">
	<div class="container py-3">
		<div class="d-flex justify-content-center justify-content-md-start align-items-center">
			<div class="mr-md-3 pr-md-3"><span class="font-weight-bold text-secondary display-4">Album photo</span>
		</div>
	</div>
</div>
</section>
<section class="my-3">
<div class="container">
	<?php if($album->num_rows() > 0): ?>
	<?php
	$kolom = 3;
	$i = 1;
	?>
	<?php foreach($album->result() as $a): ?>
	<?php
		if(($i) % $kolom==1) {
	echo '<div class="d-flex justify-content-between flex-column flex-md-row">';
		}
		?>
		<a href="<?= base_url('album/'.encrypt_url($a->id_album_foto)) ?>" class="w-100">
			<div class="card border-0 w-100 p-2 rounded-0 mx-auto bg-transparent">
				<img class="rounded-lg shadow lazy img-fluid" data-src="data:image/jpeg;base64,<?= base64_encode($a->gambar_blob) ?>" alt="Card image">
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