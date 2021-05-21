<section class="hero py-5">
	<div class="container pt-md-5">
		<div class="d-flex justify-content-between align-items-center">
			<div>
				<div class="font-weight-bold text-responsive">Daftar Banner</div>
				<p class="text-muted small">Resources Tim BinaInfo BKPPD</p>
			</div>
		</div>
	</div>
</div>
</section>
<section class="mb-3 mt--7">
<div class="container">
	<div class="row">
		<div class="col-12">
			<ul class="list-group list-group-flush shadow" style="max-height: 540px; overflow-y: scroll;">
				<?php foreach ($banner as $b): ?>
				<a href="<?= base_url('banner/'.encrypt_url($b->id_banner).'/'.url_title($b->judul)); ?>" class="list-group-item list-group-item-action">
					<div class="d-flex justify-content-lg-start align-items-center flex-lg-row flex-column">
						<div class="w-25">
							<img data-src="<?= $b->path; ?>" class="lazy rounded img-fluid">
						</div>
						<div class="ml-3">
							<b>#<?php echo $b->judul; ?></b>
							<p class="text-muted small"><?php echo word_limiter($b->keterangan, 10); ?></p>
						</div>
					</div>
				</a>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</div>
</section>