<section class="post-list mt-5 mb-4">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-8 col-lg-8 mt-5">
				<div class="p-3 border rounded">
				<a target="_blank" href="<?= $banner->url ?>">
				<img data-src="<?= $banner->path; ?>" class="lazy rounded mx-auto d-block shadow-sm img-fluid" alt="<?= $banner->judul; ?>">	
				<h3 class="mt-5 font-weight-bold"><?= ucwords($banner->judul); ?></h3>
				</a>
				<p>
					<?php echo nl2br($banner->keterangan); ?>
				</p>
				</div>
			</div>
			<div class="col-md-4 col-lg-4 mt-5">
				<div class="banner-list">
				<ul class="list-group list-group-flush shadow-sm" style="max-height: 540px; overflow-y: scroll;">
				  <?php foreach ($banner_all as $b): ?>
				  	<a href="<?= base_url('banner/'.encrypt_url($b->id_banner).'/'.url_title($b->judul)); ?>" class="list-group-item list-group-item-action">
				  	<img data-src="<?= $b->path; ?>" class="lazy rounded img-fluid">		
				  	<b>#<?php echo $b->judul; ?></b>
					</a>
				  <?php endforeach; ?>
				</ul>
				
				</div>
			</div>
		</div>
	</div>
</section>