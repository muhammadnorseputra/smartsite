<!-- Navbar For Desktop -->
<nav id="navbar" class="navbar fixed-top navbar-expand-sm bg-white shadow-sm navbar-light d-none d-md-block d-lg-block">
	<div class="container">
		<a class="navbar-brand" href="<?= base_url('beranda') ?>">
			<?php echo '<img src="data:image/jpeg;base64,' . base64_encode($mf_beranda->site_logo) . '" width="150"/>'; ?>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto mr-md-auto p-0">
				<?php
				$menu = $mf_menu;
				foreach ($menu as $m) :
					$submenu = $this->mf_beranda->get_submenu($m->id_menu);
					$submenu_jml = $this->mf_beranda->get_submenu_jml($m->id_menu);
					if ($submenu_jml > 0) {
				?>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle px-3 mx-1" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<!-- <i class="material-icons mr-2"><?= $m->fid_icon; ?></i>  -->
						<?= $m->nama_menu; ?>
					</a>
					<ul class="dropdown-menu animate slideIn" aria-labelledby="navbarDropdown">
						<?php foreach ($submenu as $s) : ?>
						<!-- Level 1 -->
						<li>
							<a class="dropdown-item py-md-2" href="<?= base_url($s->link_sub); ?>"><?= $s->nama_sub; ?>
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
									<a class="dropdown-item py-md-2 px-2" href="<?= base_url($key->link_sub); ?>"> <?= $key->nama_sub ?>
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
										<li><a class="dropdown-item py-md-2 px-2" href="<?= base_url($key_sub->link_sub); ?>"> <?= $key_sub->nama_sub ?></a></li>
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
				} else {
				?>
				<li class="nav-item">
					<a class="nav-link px-3 mr-md-1" href="<?= base_url($m->link); ?>">
						<?= ucwords($m->nama_menu); ?>
					</a>
				</li>
				<?php } ?>
				<?php endforeach; ?>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle px-3 mr-md-1" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Apps
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="width: 400px; max-height: 400px; overflow-y: auto;">
						<div class="d-flex flex-lg-column justify-content-start align-items-center ">
							<a target="_blank" href="https://ekinerja.bkppd-balangankab.info/" class="p-4">
								<div class="row">
									<div class="col-4">
										<?php echo '<img class="rounded w-100" src="'.base_url('assets/images/logo-ekinerja.png').'"/>' ; ?>
									</div>
									<div class="col-8">
										<b class="font-weight-bold text-dark">e-Kinerja</b>
										<p class="text-muted small">
											Mengukur dan memantau kinerja PNS secara periodic, <br> sebagai salah satu data acuan pemberian  tunjangan <br> kinerja yang  diterima pegawai
										</p>
									</div>
								</div>
							</a>
							<a target="_blank" href="http://silka.bkppd-balangankab.info/" class="p-4">
								<div class="row">
									<div class="col-4">
										<?php echo '<img class="rounded w-100" src="'.base_url('assets/images/logo-silka.png').'"/>'; ?>
									</div>
									<div class="col-8">
										<b class="font-weight-bold text-dark">SILKa Online</b>
										<p class="text-muted small">
											SILKa Online (Sistem Informasi Layanan Kepegawaian) <br> pengelolaan data kepegawaian kabupaten balangan
										</p>
									</div>
								</div>
							</a>
							<a target="_blank" href="https://eprilaku.bkppd-balangankab.info/" class="p-4">
								<div class="row">
									<div class="col-4">
										<?php echo '<img class="rounded w-100" src="'.base_url('assets/images/logo-eprilaku.png').'"/>'; ?>
									</div>
									<div class="col-8">
										<b class="font-weight-bold text-dark">e-Prilaku (360)</b>
										<p class="text-muted small">
											Aplikasi untuk Menilai dan Mengukur Perilaku yang dinilai<br> oleh Atasan, Teman/Peer dan Bawahan (360 Derajat) <br>dengan menggunakan survei tertutup sehingga lebih objektif.
										</p>
									</div>
								</div>
							</a>
						</div>
					</ul>
				</li>
			</ul>
			
			<?php if ($this->session->userdata('user_portal_log')['online'] === 'ON') { ?>
			<?php
			$idSes = $this->session->userdata('user_portal_log')['id'];
			$getImg = $this->mf_users->get_userportal_byid($idSes)->photo_pic;
			$img = '<img class="rounded mr-1 shadow-sm" width="23" src="data:image/jpeg;base64,'.base64_encode( $getImg ).'"/>';
			?>
			<div class="dropdown">
				<button type="button" class="btn btn-outline-light border-0 text-muted my-sm-0 mr-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?= $img ?> <?= ucfirst($this->session->userdata('user_portal_log')['nama_panggilan']) ?>
				<i class="fas fa-angle-down mx-2"></i>
				</button>
				<?php $this->load->view('Frontend/v1/function/f_menus.php'); ?>
			</div>
			<?php } else { ?>
			<a  class="btn shadow-sm btn-dark rounded-pill border-0 py-2 px-4" href="<?= base_url('login_web'); ?>">
				<i class="fas fa-lock mr-2"></i> Login
			</a>
			<a data-toggle="tooltip" title="Klik untuk mendaftar atau berkontribusi sebagai editor content website" class="btn btn-light shadow-sm border-0 rounded-circle ml-2" href="<?= base_url('daftar'); ?>">
				<i class="fas fa-user"></i>
			</a>
			<?php } ?>
			<span class="text-light ml-2">|</span>
			<button class="btn shadow-sm btn-primary rounded-pill py-2 ml-2" id="caripost">
			<i class="fas fa-search"></i>
			</button>
			<!-- <label class="switch mt-2">
							<input type="checkbox" id="darkSwitch">
							<div>
											<span></span>
							</div>
			</label> -->
		</div>
	</div>
</nav>
<!-- Navbar For Mobile -->
<nav class="p-0 navbar navbar-light bg-white border-top navbar-expand fixed-bottom d-md-none d-lg-none d-xl-none">
	<ul class="navbar-nav nav-justified w-100">
		<li class="nav-item">
			<a href="<?= base_url('beranda') ?>" class="nav-link">
				<svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
					<path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
					<path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
				</svg>
				<span class="small d-block">Home</span>
			</a>
		</li>
		<li class="nav-item">
			<a href="javascript:void(0);" role="button" class="nav-link" id="caripost">
				<svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
					<path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
				</svg>
				<span class="small d-block">Search</span>
			</a>
		</li>
		<li class="nav-item dropup">
			<a href="javascript:void(0);" class="nav-link" id="mobileMenuNav">
				<svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-menu-app" viewBox="0 0 16 16">
					<path d="M0 1.5A1.5 1.5 0 0 1 1.5 0h2A1.5 1.5 0 0 1 5 1.5v2A1.5 1.5 0 0 1 3.5 5h-2A1.5 1.5 0 0 1 0 3.5v-2zM1.5 1a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 0-.5-.5h-2zM0 8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8zm1 3v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2H1zm14-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2h14zM2 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
					</svg><span class="small d-block">Menu</span>
				</a>
			</li>
			<li class="nav-item">
				<a href="<?= base_url('userlist') ?>" class="nav-link">
					<svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-person-badge" viewBox="0 0 16 16">
						<path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
						<path d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0h-7zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492V2.5z"/>
						</svg><span class="small d-block">User</span>
					</a>
				</li>
				<?php if ($this->session->userdata('user_portal_log')['online'] === 'ON'): ?>
					<?php
					$idSes = $this->session->userdata('user_portal_log')['id'];
					$getImg = $this->mf_users->get_userportal_byid($idSes)->photo_pic;
					$img = '<img class="rounded mr-1 shadow-sm" width="25" src="data:image/jpeg;base64,'.base64_encode( $getImg ).'"/>';
					?>
					<li class="nav-item dropup left">
			            <a href="#" class="nav-link text-center" role="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
			                <?= $img ?>
			                <span class="small d-block"><?= ucfirst($this->session->userdata('user_portal_log')['nama_panggilan']) ?></span>
			            </a>
			            <!-- Dropup menu for mobile -->
			            <?php $this->load->view('Frontend/v1/function/f_menus.php'); ?>
			        </li>
					<?php else: ?>
					<li class="nav-item">
						<a href="<?= base_url('login_web') ?>" class="nav-link">
							<svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
								<path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"/>
								</svg><span class="small d-block">Login</span>
						</a>
					</li>
					<?php endif; ?>
				</ul>
			</nav>
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
			<!-- Modal Menus Mobile-->
			<div class="modal bd-example-modal-lg" id="mobileMenu" tabindex="-1" role="dialog" aria-labelledby="mobileMenuLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content border-0 shadow-none bg-transparent">
						<div class="modal-body">
							<!-- <div class="text-light text-center font-weight-bold">Menu Navigasi</div> -->
							<!-- Body -->
							<div id="accordionParent" class="accordion">
								<?php
								$menu = $mf_menu;
								foreach ($menu as $m) :
									$submenu = $this->mf_beranda->get_submenu($m->id_menu);
									$submenu_jml = $this->mf_beranda->get_submenu_jml($m->id_menu);
									if ($submenu_jml > 0) {
								?>
								<!-- Accordion -->
								<div id="heading1">
								<a href="<?= base_url($m->link); ?>" data-toggle="collapse" data-target="#collapse-<?= $m->id_menu ?>" aria-expanded="false" aria-controls="collapse-<?= $m->id_menu ?>" class="btn btn-block btn-light border text-left rounded collapsible-link px-2 my-1 py-2"><?= $m->nama_menu; ?> <i class="fas fa-folder float-right text-white"></i></a>
								</div>
								
								<div id="collapse-<?= $m->id_menu ?>" aria-labelledby="heading1" data-parent="#accordionParent" class="collapse">
									<?php foreach ($submenu as $s) : ?>
										<?php if($this->mf_beranda->parent_submenu($s->idsub)->num_rows() > 0): ?>
										<div id="accordionSub" class="accordion">
											<div id="heading2">
											<a href="<?= base_url($s->link_sub); ?>" data-toggle="collapse" data-target="#collapse-<?= $s->idsub ?>" aria-expanded="false" aria-controls="collapse-<?= $s->idsub ?>" class="d-block bg-secondary rounded text-white collapsible-link px-2 my-1 py-2"><?= $s->nama_sub; ?> <i class="fas fa-folder float-right text-white"></i></a>
											</div>
											<div id="collapse-<?= $s->idsub ?>" aria-labelledby="heading2" data-parent="#accordionSub" class="collapse">
												<?php foreach ($this->mf_beranda->sub_submenu($s->idsub) as $ss):?>
													<?php if($this->mf_beranda->parent_submenu($ss->idsub)->num_rows() > 0): ?>
													<div id="accordionSubSub" class="accordion ml-2">
														<a href="<?= base_url($ss->link_sub); ?>" data-toggle="collapse" data-target="#collapse-<?= $ss->idsub ?>" aria-expanded="false" aria-controls="collapseFive" class="d-block bg-info rounded text-white collapsible-link px-2 my-1 py-2"><?= $ss->nama_sub; ?> <i class="fas fa-folder float-right text-white"></i></a>
														<div id="collapse-<?= $ss->idsub ?>" aria-labelledby="heading3" data-parent="#accordionSubSub" class="collapse">
															<?php foreach ($this->mf_beranda->sub_submenu($ss->idsub) as $sss):?>
																<a href="<?= base_url($sss->link_sub); ?>" class="d-block bg-info position-relative rounded text-white px-2 my-1 py-2 ml-2"><?= $sss->nama_sub; ?></a>
															<?php endforeach; ?>
														</div>
													</div>
													<?php else: ?>
														<a href="<?= base_url($ss->link_sub); ?>" class="d-block bg-info position-relative rounded text-white px-2 my-1 py-2 ml-2"><?= $ss->nama_sub; ?></a>
													<?php endif; ?>
												<?php endforeach; ?>
											</div>
										</div>
									<?php else: ?>
										<a href="<?= base_url($s->link_sub); ?>" class="d-block bg-secondary position-relative rounded text-white px-2 my-1 py-2"><?= $s->nama_sub; ?></a>
									<?php endif ?>
									<?php endforeach; ?>
								</div>
								<?php 
									} else {
								?>
								<a href="<?= base_url($m->link); ?>" class="btn btn-block btn-light border text-left rounded collapsible-link px-2 my-1 py-2"><?= $m->nama_menu; ?></a>
								<?php 
								}
								endforeach;	 
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal Search -->
			<div class="modal bd-example-modal-lg" id="mpostseacrh" tabindex="-1" role="dialog" aria-labelledby="mpostseacrhLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
					<div class="modal-content border-0 shadow-lg">
						<div class="modal-body">
							<?= form_open(base_url('frontend/v1/post/search'), ['id' => 'form_post_search','class' => 'form-inline']); ?>
							<div class="input-group mx-auto w-100">
								<div class="input-group-prepend">
									<div class="input-group-text"><i class="fas fa-search"></i></div>
								</div>
								<input type="text" name="q" class="form-control form-control-lg" id="search" placeholder="Masukan kata kunci, lalu tekan enter atau cari">
								<button type="submit" class="btn btn-outline-info ml-2">Cari</button>
								
							</div>
							<?= form_close() ?>
							<hr>
							<div id="search-result"></div>
						</div>
					</div>
				</div>
			</div>