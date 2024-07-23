<?php  
	$title = !empty($d['title']) ? $d['title'] : 'Untitle';
	$desc  = !empty($d['description']) ? word_limiter($d['description'], 30) : 'Tanpa Deskripsi';
	$type = !empty($d['type']) ? $d['type'] : '-';
	$site_name = !empty($d['site_name']) ? $d['site_name'] : $type;
	$img = !empty($d['image']) ? $d['image'] : base_url('assets/images/noimage.gif');
?>
<section class="py-3">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-6 offset-md-3">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Mengalihkan</h5>
						<hr>
						<p class="card-text bg-warning border-left border-warning p-4"><b>Perhatian</b> <br>Halaman web di bawah ini tidak berafiliasi dengan kami, dan mungkin mengandung konten yang berbahaya.</p>
						<div class="d-flex justify-content-start align-content-center rounded bg-light border-light border my-3 flex-column">
							<div>
								<img src="<?= $img ?>" class="rounded-top mw-100" alt="<?= $title ?>">
							</div>
							<div class="p-3">
								<?php $domain = parse_url($url_decode, PHP_URL_HOST); ?>
								<h6 class="small font-weight-bold pl-3 border-left border-primary">
									<span class="text-muted"><?= $site_name ?></span> <br> <?= $title ?>
								</h6>
								<p class="small text-muted">
									<?= $desc ?>
								</p>
								<div class="small text-primary"><?= $domain ?></div>
							</div>
						</div>
						<div class="d-flex justify-content-between align-content-center">
							<div class="w-100">
								<a href="javascript:void(0);" onclick="window.history.back(-1)" class="btn btn-block btn-link text-muted"><i class="fas fa-arrow-left mr-3"></i> Kembali </a>
							</div>
							<div class="w-100">
								<a href="<?= $url_decode ?>?ref=bkppd_balangan" class="btn btn-block btn-primary">Lanjutkan <i class="fas fa-arrow-right ml-3"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>