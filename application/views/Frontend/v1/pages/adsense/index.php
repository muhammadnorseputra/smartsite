<section class="hero py-2">
	<div class="container pt-md-3">
		<div class="d-flex justify-content-between align-items-center">
			<div>
				<h3 class="font-weight-bold text-responsive">Adsense Prop</h3>
				<p class="text-muted small">Resources <a href="https://propellerads.com" target="_blank">propaller</a></p>
			</div>
			<div>
			</div>
		</div>
	</div>
</div>
</section>
<section class="bg-light">
	<div class="container">
		<div class="row">
			<div class="col-12 py-3">
				<?php  
					$start = encrypt_url('0');
					$date = encrypt_url(date('Y-m-d'));
				?>
				<a href="<?= base_url('adsense/'.$start.'/'.$date) ?>" class="btn btn-lg btn-danger btn-pill">Start Earn <i class="fas fa-arrow-right ml-2"></i></a>
			</div>
		</div>
	</div>
</section>