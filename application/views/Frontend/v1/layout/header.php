<!-- Navbar For Desktop -->
<nav id="navbar" class="navbar fixed-top navbar-expand-sm border-bottom border-light navbar-light d-none d-md-block d-lg-block py-0 bg-white">
	<div class="container">
		<a class="navbar-brand" href="<?= base_url('beranda') ?>">
			<?php echo '<img style="object-fit:contain;" src="' .img_blob($mf_beranda->site_logo) . '" alt="BKPPD Kab. Balangan 2021" width="150" height="45"/>'; ?>
		</a>
		<div class="collapse navbar-collapse">
			<button class="btn btn-outline-light rounded-pill bg-white py-2 pr-5 text-muted post-search">
				<i class="fas fa-search mr-3"></i> Cari sesuatu disini
			</button>
			<ul class="navbar-nav ml-auto p-0">
			<li class="nav-item text-muted">
				<a class="rounded mr-4 pr-2" href="<?= base_url('beranda'); ?>">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
					  <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
					  <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
					</svg>
				</a>
			</li>
			<li class="nav-item text-muted">
				<a class="rounded mr-4 pr-2" href="#">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-moon" viewBox="0 0 16 16">
					  <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278zM4.858 1.311A7.269 7.269 0 0 0 1.025 7.71c0 4.02 3.279 7.276 7.319 7.276a7.316 7.316 0 0 0 5.205-2.162c-.337.042-.68.063-1.029.063-4.61 0-8.343-3.714-8.343-8.29 0-1.167.242-2.278.681-3.286z"/>
					</svg>
				</a>
			</li>
			<?php if ($this->session->userdata('user_portal_log')['online'] === 'ON') { ?>
			<?php
			$idSes = $this->session->userdata('user_portal_log')['id'];
			$getImg = $this->mf_users->get_userportal_byid($idSes)->photo_pic;
			$u_name = ucfirst($this->session->userdata('user_portal_log')['nama_panggilan']);
			if(!empty($getImg)):
				$photo = 'data:image/jpeg;base64,' . base64_encode($getImg) . '';
			else:
			  	$photo = base_url('assets/images/no-profile-picture.jpg');
			endif;
			$img = '<img style="object-fit:cover; object-position: top;" class="rounded-circle" width="25" height="25" src="'.$photo.'" alt="Userportal - '.$u_name.'"/>';
			?>
			<div class="dropdown">
				<button type="button" class="btn btn-outline-light border-0 text-muted p-0 rounded bg-transparent" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?= $img ?>
				</button>
				<?php $this->load->view('Frontend/v1/function/f_menus.php'); ?>
			</div>
			<a class="badge badge-primary rounded p-2 ml-3" href="<?= base_url('frontend/v1/post/judul'); ?>">
				Buat Tulisan <i class="far fa-edit ml-3"></i>
			</a>
			<?php } else { ?>
			<a rel="noindex, nofollow" class="badge badge-primary rounded p-2" href="<?= base_url('login_web?urlRef='.curPageURL()); ?>">
				Masuk 
			</a>
			<a data-toggle="tooltip" title="Buat tulisan kamu sendiri dan bagikan manfaat ke yang lain" class="badge badge-primary rounded p-2 ml-2" href="<?= base_url('daftar'); ?>">
				Buat Tulisan
			</a>
			<?php } ?>
			</ul>
			<!-- <label class="switch mt-2">
							<input type="checkbox" id="darkSwitch">
							<div>
											<span></span>
							</div>
			</label> -->
		</div>
	</div>
	<div class="container">
		<ul class="navbar-nav px-0 w-100 d-flex justify-content-around">
				<?php
				$menu = $mf_menu;
				foreach ($menu as $m) :
					$submenu = $this->mf_beranda->get_submenu($m->id_menu);
					$submenu_jml = $this->mf_beranda->get_submenu_jml($m->id_menu);
					if ($submenu_jml > 0) {
					$skr = date('Y-m-d');
				?>
				<li class="nav-item dropdown d-flex">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" style="background-color: <?= $m->color ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<!-- <i class="material-icons mr-2"><?= $m->fid_icon; ?></i>  -->
						<?= $m->nama_menu; ?>
					</a>
					<ul class="dropdown-menu shadow-lg animate slideIn" aria-labelledby="navbarDropdown">
						<?php 
							foreach ($submenu as $s) :
							$create_submenu = substr($s->created_at,0,10); 
							// $besok = date($create_submenu, strtotime("+1 day", strtotime(date('Y-m-d'))));
						?>
						<!-- Level 1 -->
						<li>
							<a class="dropdown-item py-md-2" href="<?= base_url($s->link_sub); ?>">
								<?= $s->nama_sub; ?>
								<?php if(($create_submenu === $skr)): ?>
								<span class="badge badge-danger animated fadeIn infinite">
									<span class="small">New</span>
								</span>
								<?php endif; ?>
								<?php
									if($this->mf_beranda->parent_submenu($s->idsub)->num_rows() > 0):
								?>
								<i class="float-right text-secondary font-weight-bold animated fadeIn fas fa-caret-right mt-1"></i>
								<?php endif; ?>
							</a>
							<?php if($this->mf_beranda->parent_submenu($s->idsub)->num_rows() > 0): ?>
							<!-- Level 2 -->
							<ul class="submenu dropdown-menu animate slideIn">
								<?php 
									foreach ($this->mf_beranda->sub_submenu($s->idsub) as $key):
									$create_sub_submenu = substr($key->created_at,0,10); 
								?>
								<li>
									<a class="dropdown-item py-md-2 px-2" href="<?= base_url($key->link_sub); ?>"> 
										<?= $key->nama_sub ?>
										<?php if(($create_sub_submenu == $skr)): ?>
										<span class="badge badge-danger animated fadeIn infinite">
											<span class="small">New</span>
										</span>
										<?php endif; ?>
										<?php
											if($this->mf_beranda->parent_submenu($key->idsub)->num_rows() > 0):
										?>
										<i class="float-right text-secondary font-weight-bold animated fadeIn fas fa-caret-right mt-1"></i>
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
					<a class="nav-link" style="background-color: <?= $m->color ?>" href="<?= base_url($m->link); ?>">
						<?= ucwords($m->nama_menu); ?>
					</a>
				</li>
				<?php } ?>
				<?php endforeach; ?>
			</ul>
	</div>
</nav>
<?php $this->load->view('Frontend/v1/function/navbar-mobile.php'); ?>
<?php $this->load->view('Frontend/v1/function/modal-mobile-menu'); ?>
<?php $this->load->view('Frontend/v1/function/modal-search'); ?>
<?php $this->load->view('msg/modal-auth'); ?>

			
			