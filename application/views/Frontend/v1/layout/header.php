<!-- Navbar For Desktop -->
<nav id="navbar" class="navbar fixed-top navbar-expand-sm navbar-light">
	<div class="container">
		<a class="navbar-brand" href="<?= base_url('beranda') ?>">
			<?php echo '<img src="data:image/jpeg;base64,' . base64_encode($mf_beranda->site_logo) . '" width="110"/>'; ?>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto p-md-0 p-2 mr-md-auto">
				<?php
				$menu = $mf_menu;
				foreach ($menu as $m) :
					$submenu = $this->mf_beranda->get_submenu($m->id_menu);
					$submenu_jml = $this->mf_beranda->get_submenu_jml($m->id_menu);
					if ($submenu_jml > 0) {
				?>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle rounded py-md-3 px-3" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<!-- <i class="material-icons mr-2"><?= $m->fid_icon; ?></i>  -->
						<?= $m->nama_menu; ?>
					</a>
					<ul class="dropdown-menu border-light animate slideIn" aria-labelledby="navbarDropdown">
						<?php foreach ($submenu as $s) : ?>
						<!-- Level 1 -->
						<li>
							<a class="dropdown-item py-md-2 rounded" href="<?= base_url($s->link_sub); ?>"><?= $s->nama_sub; ?>
							<?php 
								if($this->mf_beranda->parent_submenu($s->idsub)->num_rows() > 0): 
							?>
								<i class="float-right text-light font-weight-bold animated fadeIn fas fa-caret-right mt-1"></i>
							<?php endif; ?>
							</a>
							<?php if($this->mf_beranda->parent_submenu($s->idsub)->num_rows() > 0): ?>
							<!-- Level 2 -->
							<ul class="submenu dropdown-menu animate slideIn">
								<?php foreach ($this->mf_beranda->sub_submenu($s->idsub) as $key):?>
									<li>
										<a class="dropdown-item py-md-2 rounded px-2 rounded-lg" href="<?= base_url($key->link_sub); ?>"> <?= $key->nama_sub ?>
										<?php 
											if($this->mf_beranda->parent_submenu($key->idsub)->num_rows() > 0): 
										?>
											<i class="float-right text-light font-weight-bold animated fadeIn fas fa-caret-right mt-1"></i>
										<?php endif; ?>
										</a>
										<?php if($this->mf_beranda->parent_submenu($key->idsub)->num_rows() > 0): ?>
										<!-- Level 3 -->
										<ul class="submenu dropdown-menu animate slideIn">
											<?php foreach ($this->mf_beranda->sub_submenu($key->idsub) as $key_sub):?>
												<li><a class="dropdown-item py-md-2 rounded px-2" href="<?= base_url("frontend/v1/" . $key_sub->link_sub); ?>"> <?= $key_sub->nama_sub ?></a></li>
											<?php endforeach; ?>
										</ul>
										<?php endif; ?>
									</li>
								<?php endforeach; ?>
							</ul>
							<?php endif; ?>
						</li>
						<?php endforeach; ?>
					</ul>
				</li>
				<?php
				}
				?>
				<?php endforeach; ?>
				
			</ul>
			
			<?php if ($this->session->userdata('user_portal_log')['online'] == 'ON') { ?>
			<?php
			$idSes = $this->session->userdata('user_portal_log')['id'];
			$getImg = $this->mf_users->get_userportal_byid($idSes)->photo_pic;
			$img = '<img class="rounded mr-1 shadow-sm" width="23" src="data:image/jpeg;base64,'.base64_encode( $getImg ).'"/>';
			?>
			<div class="dropdown">
				<button type="button" class="btn btn-outline-dark text-muted my-2 my-sm-0 mr-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?= $img ?> <?= ucfirst($this->session->userdata('user_portal_log')['nama_panggilan']) ?>
				<i class="fas fa-angle-down mx-2"></i>
				</button>
				<?php $this->load->view('Frontend/v1/function/f_menus.php'); ?>
			</div>
			<?php } else { ?>
			<a  class="btn shadow-none btn-outline-primary my-2 my-sm-0 mr-2 px-4" href="<?= base_url('login_web'); ?>">
				<i class="far fa-user mr-2"></i> Login
			</a>
			<?php } ?>
			<label class="switch mt-2">
				<input type="checkbox" id="darkSwitch">
				<div>
					<span></span>
				</div>
			</label>
		</div>
	</div>
</nav>
<!-- Modal -->
<div class="modal bd-example-modal-lg" id="mpostseacrh" tabindex="-1" role="dialog" aria-labelledby="mpostseacrhLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content border-0 shadow-lg">
			<div class="modal-header">
				<h5 class="modal-title" id="mpostseacrhLabel">Cari Postingan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?= form_open(base_url('frontend/v1/post/search'), ['id' => 'form_post_search','class' => 'form-inline']); ?>
				<div class="input-group mx-auto">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-search"></i></div>
					</div>
					<input type="text" name="q" class="form-control form-control-lg" id="search" placeholder="Masukan kata kunci...">
					<button type="submit" class="btn btn-outline-info ml-2">Cari</button>
					
				</div>
				<?= form_close() ?>
				<hr>
				<div id="search-result"></div>
			</div>
		</div>
	</div>
</div>
<!-- Navbar For Mobile -->
<!-- modal notice sigin-->
<div class="modal" id="noticeSigin" tabindex="-1" role="dialog" aria-labelledby="noticeSiginTitle" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
		<div class="modal-content border-0 shadow-lg p-0">
			<div class="modal-header border-light">
				<h6 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-lock"></i> Authentication</h6>
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
							<h3>Login dulu ya</h3>
							<p class="text-muted">
								Kamu harus login dahulu sebelum menggunakan fitur :
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
							<button type="button" class="btn btn-primary btn-block" data-dismiss="modal">OKE</button>
							<p class="d-block mx-auto text-center my-3">
								Belum punya akun? <a href="<?= base_url('daftar') ?>">daftar disini.</a>
							</p>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>