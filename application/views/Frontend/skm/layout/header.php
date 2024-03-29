<?php  
	$uri = $this->uri->segment(1);
	if($uri === 'ikm'):
		$nv = 'navbar-dark'; $bg = 'bg-dark bg-gradient';
	elseif($uri === 'skm'):
		$nv = 'navbar-dark'; $bg = 'bg-success bg-gradient';
	else:
		$nv = 'navbar-light'; $bg = 'bg-light bg-gradient';
	endif;
?>
<nav class="navbar navbar-expand-lg <?= $nv." ".$bg ?>" id="navbar">
	<div class="container">
		<a class="navbar-brand text-truncate d-block text-center" href="<?= base_url('skm') ?>">
			<img src="<?= base_url('assets/images/logo.png'); ?>" alt="Survey SKM" width="40">
			<span class="fw-bold">BKPPD</span>
		</a>
		<a class="btn btn-warning btn-block ms-auto d-block d-sm-block d-md-block d-lg-none"  href="<?= base_url('survei') ?>">
			<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-ui-checks mr-2" viewBox="0 0 20 20">
				<path d="M7 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1zM2 1a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2zm0 8a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2H2zm.854-3.646a.5.5 0 0 1-.708 0l-1-1a.5.5 0 1 1 .708-.708l.646.647 1.646-1.647a.5.5 0 1 1 .708.708l-2 2zm0 8a.5.5 0 0 1-.708 0l-1-1a.5.5 0 0 1 .708-.708l.646.647 1.646-1.647a.5.5 0 0 1 .708.708l-2 2zM7 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1zm0-5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
			</svg>
		Isi Survei</a>
		<span class="text-secondary mx-2"></span>
		<button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarScroll">
			<ul class="navbar-nav ms-auto my-2 my-lg-0 navbar-nav-scroll gap-4" style="--bs-scroll-height: 100px;">
				<li class="nav-item">
					<a class="nav-link fw-bold" href="<?= base_url('skm') ?>">Home</a>
				</li>
				<?php if($this->uri->segment(1) == 'skm'): ?>
				<li class="nav-item">
					<a class="nav-link fw-bold text-warning" href="#apa-itu-ikm" tabindex="-1" aria-disabled="true">Apa itu IKM ?
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link fw-bold" href="#feedback" tabindex="-1" aria-disabled="true">Feedback</a>
				</li>
				<?php endif; ?>
				<li class="nav-item">
					<a class="nav-link fw-bold" href="<?= base_url('ikm') ?>">
						IKM
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link fw-bold" target="_blank" href="//bit.ly/3q22H7Q">
						Panduan Pengguna
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link fw-bold" href="#cetak" tabindex="-1" aria-disabled="true" data-bs-toggle="offcanvas" role="button" aria-controls="offcanvasExample">Cetak Formulir</a>
				</li>
				<?php if(!empty($this->session->userdata('user_portal_log')['id'])): ?>
				<li class="nav-item">
					<a class="nav-link fw-bold" href="<?= base_url('laporan'); ?>" tabindex="-1" aria-disabled="true">Laporan</a>
				</li>
				<?php endif ?>
				<a class="btn btn-warning me-2 d-none d-md-block position-relative " href="<?= base_url('survei') ?>">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-ui-checks mr-2" viewBox="0 0 20 20">
						<path d="M7 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1zM2 1a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2zm0 8a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2H2zm.854-3.646a.5.5 0 0 1-.708 0l-1-1a.5.5 0 1 1 .708-.708l.646.647 1.646-1.647a.5.5 0 1 1 .708.708l-2 2zm0 8a.5.5 0 0 1-.708 0l-1-1a.5.5 0 0 1 .708-.708l.646.647 1.646-1.647a.5.5 0 0 1 .708.708l-2 2zM7 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1zm0-5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
					</svg>  Isi Survei
					<span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger rounded-circle animate__animated animate__flash animate__infinite">
							<span class="visually-hidden">New alerts</span>
						</span>
				</a>
				</ul>
			</div>
		</div>
	</nav>