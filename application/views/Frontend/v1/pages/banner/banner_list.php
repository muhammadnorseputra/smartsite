<section class="py-5">
	<div class="container pt-md-5">
		<div class="d-flex justify-content-between align-items-center">
			<div>
				<h3 class="font-weight-bold text-responsive">Daftar Banner</h3>
				<p class="text-dark small">Resources Tim BinaInfo BKPPD</p>
			</div>
			<div>
			</div>
		</div>
	</div>
</div>
</section>
<section class="mb-3 mt--8">
<div class="container">
	<div class="row">
		<div class="col-12" id="bannerList">
			<div class="d-flex justify-content-end mb-3">
				<div>
					<input type="text" class="fuzzy-search form-control" placeholder="Masukan judul banner"/>
				</div>
				<div class="ml-3">
					<button class="sort btn btn-primary" data-sort="title_banner">
				    Sort by title
				  </button>
				</div>
			</div>
			<ul class="card-columns pl-0 list">
				<?php 
					foreach ($banner as $b): 
					if($b->fid_jns_banner === '38'):
						$flexDir = 'flex-column';
					else:
						$flexDir = 'flex-row';
					endif;
				?>
				<div class="card">
				<a href="<?= base_url('b/'.$b->slug); ?>" class="">
					<div class="d-flex justify-content-lg-start align-items-center <?= $flexDir ?>">
						<img data-src="<?= $b->path; ?>" class="lazy card-img-top">
												<div class="ml-3">
							<b class="title_banner">#<?php echo $b->judul; ?></b>
							<p class="text-muted small"><?php echo word_limiter($b->keterangan, 10); ?></p>
						</div>
					</div>
				</a>
				</div>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</div>
</section>
<script src="<?= base_url('bower_components/list.js/dist/list.min.js') ?>"></script>
<script>
	var options = {
	    valueNames: [ 'title_banner' ]
	};
	var bn = new List('bannerList', options);
</script>
