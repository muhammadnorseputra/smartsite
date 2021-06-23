<nav class="navbar navbar-expand-lg navbar-light bg-white" id="navbar">
	<div class="container">
		<a class="navbar-brand text-truncate d-block text-center" href="<?= base_url('skm') ?>">
			<img src="<?= base_url('assets/images/logo.png'); ?>" alt="Survey SKM" width="40">
			<span class="fw-bold">BKPPD</span>
		</a>
		<a class="btn btn-outline-danger btn-block px-5 ms-auto d-block d-sm-block d-md-block d-lg-none"  href="<?= base_url('survei') ?>">
		<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-ui-checks mr-2" viewBox="0 0 20 20">
			<path d="M7 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1zM2 1a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2zm0 8a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2H2zm.854-3.646a.5.5 0 0 1-.708 0l-1-1a.5.5 0 1 1 .708-.708l.646.647 1.646-1.647a.5.5 0 1 1 .708.708l-2 2zm0 8a.5.5 0 0 1-.708 0l-1-1a.5.5 0 0 1 .708-.708l.646.647 1.646-1.647a.5.5 0 0 1 .708.708l-2 2zM7 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1zm0-5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
		</svg>
		Isi Survei</a>
		<span class="text-secondary mx-2"></span>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarScroll">
			<ul class="navbar-nav ms-auto my-2 my-lg-0 navbar-nav-scroll gap-3" style="--bs-scroll-height: 100px;">
				<li class="nav-item">
					<a class="nav-link  fw-bold active" aria-current="page" href="<?= base_url('skm') ?>">Home</a>
				</li>
				<?php if($this->uri->segment(1) == 'skm'): ?>
				<li class="nav-item">
					<a class="nav-link fw-bold text-info" href="#apa-itu-ikm" tabindex="-1" aria-disabled="true">Apa itu IKM ?</a>
				</li>
				<li class="nav-item">
					<a class="nav-link fw-bold" href="#feedback" tabindex="-1" aria-disabled="true">Feedback</a>
				</li>
				<?php endif; ?>
				<li class="nav-item">
					<a class="nav-link fw-bold" href="#">Hasil IKM</a>
				</li>
				<li class="nav-item">
					<a class="nav-link fw-bold" href="#" tabindex="-1" aria-disabled="true">Isi Formulir Manual</a>
				</li>
				<a class="btn btn-outline-danger me-2 d-none d-md-block" href="<?= base_url('survei') ?>">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-ui-checks mr-2" viewBox="0 0 20 20">
					<path d="M7 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1zM2 1a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2zm0 8a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2H2zm.854-3.646a.5.5 0 0 1-.708 0l-1-1a.5.5 0 1 1 .708-.708l.646.647 1.646-1.647a.5.5 0 1 1 .708.708l-2 2zm0 8a.5.5 0 0 1-.708 0l-1-1a.5.5 0 0 1 .708-.708l.646.647 1.646-1.647a.5.5 0 0 1 .708.708l-2 2zM7 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1zm0-5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
				</svg>  Isi Survei</a>
			</ul>
		</div>
	</div>
</nav>