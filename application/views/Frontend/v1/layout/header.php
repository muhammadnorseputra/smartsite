<!-- Navbar For Desktop -->
<nav id="navbar" class="navbar fixed-top navbar-expand-sm navbar-light">
	<div class="container">
		<a class="navbar-brand" href="#">
			<?php echo '<img class="lazy animated fadeIn" data-src="data:image/jpeg;base64,' . base64_encode($mf_beranda->site_logo) . '" width="25"/>'; ?>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto animated fadeIn">
				<?php
				$menu = $mf_menu;
				foreach ($menu as $m) :
					$submenu = $this->mf_beranda->get_submenu($m->id_menu);
					$submenu_jml = $this->mf_beranda->get_submenu_jml($m->id_menu);
					if ($submenu_jml > 0) {
				?>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle rounded-pill px-3" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<!-- <i class="material-icons mr-2"><?= $m->fid_icon; ?></i>  -->
						<?= $m->nama_menu; ?>
					</a>
					<div class="dropdown-menu border-light" aria-labelledby="navbarDropdown">
						<?php foreach ($submenu as $s) : ?>
						<a class="dropdown-item rounded-pill py-2" href="<?= base_url("frontend/v1/" . $s->link_sub); ?>"><?= $s->nama_sub; ?></a>
						<?php endforeach; ?>
					</div>
				</li>
				<?php
				} else {
				?>
				<li class="nav-item">
					<a class="nav-link rounded-pill px-3 active" href="<?= base_url($m->link); ?>">
						<!-- <i class="material-icons mr-2"><?= $m->fid_icon; ?></i> -->
					<?= $m->nama_menu; ?></a>
				</li>
				<?php
				} ?>
				<?php endforeach; ?>
				
			</ul>
			
			<?php if ($this->session->userdata('online') == 'ON') { ?>
			<?php
			$idSes = $this->session->userdata('id');
			$getImg = $this->mf_users->get_userportal_byid($idSes)->photo_pic;
			$img = '<img class="rounded mr-1 shadow-sm" width="23" src="data:image/jpeg;base64,'.base64_encode( $getImg ).'"/>';
			?>
			<button type="button" data-menus="<?= base_url('frontend/v1/beranda/f_menus'); ?>" class="btn btn-outline-light text-muted my-2 my-sm-0 mr-2 btn-menus animated fadeIn">
			<?= $img ?> <?= ucfirst($this->session->userdata('nama_panggilan')) ?>
			<i class="fas fa-angle-down mx-2"></i>
			</button>
			<?php } else { ?>
			<a  class="btn shadow btn-primary my-2 my-sm-0 mr-2 px-4" href="<?= base_url('frontend/v1/users/login'); ?>">
			<i class="far fa-user mr-2"></i> Login
			</button>
			<?php } ?>
			

			<a target="_blank" href="<?= $mf_beranda->fb; ?>" class="btn btn-primary-old my-2 ml-2 my-sm-0 animated fadeIn shadow-sm" data-toggle="tooltip" data-placement="bottom" title="Join group facebook">
                            <i class="fab fa-facebook"></i>
            </a>
            <a target="_blank" href="https://www.instagram.com/<?= $mf_beranda->ig; ?>" class="btn btn-danger my-2 my-sm-0 mx-2 btn-instagram animated fadeIn shadow-sm" data-toggle="tooltip" data-placement="bottom" title="Follow Me On Instagram" data-username="<?= $mf_beranda->ig; ?>">
                <i class="fab fa-instagram"></i>
            </a>

            <label class="switch mt-2">
			    <input type="checkbox" id="darkSwitch">
			    <div>
			        <span></span>
			    </div>
			</label>
		</div>
	</div>
</nav>


<!-- Navbar For Mobile -->
<!-- modal notice sigin-->
<div class="modal fade" id="noticeSigin" tabindex="-1" role="dialog" aria-labelledby="noticeSiginTitle" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
		<div class="modal-content border-0 shadow p-0">
			<div class="modal-header border-light">
				<h6 class="modal-title" id="exampleModalLongTitle">Authentication</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-6 p-0 my-auto d-none d-md-block">
							<img src="<?= base_url('bower_components/SVG-Loaders/svg-loaders/undraw_access_account_99n5.svg') ?>" alt="" class="d-block align-middle img-fluid mx-auto my-auto">
						</div>
						<div class="col-md-6">
							<h3>Login dulu ya!</h3>
							<p class="text-muted">
								Halo, selamat datang di websites kami. Badan Kepegawaian Pendidikan dan Pelatihan Daerah Kab. Balangan. Kamu harus login dahulu sebelum menggunakan fitur :
							</p>
							<ul class="list-unstyled">
								<li>
									<i class="far fa-check-circle text-primary mb-2 mr-2"></i> Like or Dislike
								</li>
								<li>
									<i class="far fa-check-circle text-primary mb-2 mr-2"></i> Simpan Postingan
								</li>
								<li>
									<i class="far fa-check-circle text-primary mb-2 mr-2"></i> Membuat Halaman
								</li>
								<li>
									<i class="far fa-check-circle text-primary mb-2 mr-2"></i> Membuat Postingan
								</li>
								<li>
									<i class="far fa-check-circle text-primary mb-2 mr-2"></i> Ikut diskusi publik
								</li>
							</ul>
							<button type="button" class="btn btn-primary rounded-0 btn-block" data-dismiss="modal">OKE</button>
							<p class="d-block mx-auto text-center my-3">
								Belum punya akun? <a href="<?= base_url('frontend/v1/daftar') ?>">daftar disini.</a>
							</p>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>