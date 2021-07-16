<!-- Navbar For Desktop -->
<nav id="navbar" class="navbar fixed-top navbar-expand-sm border-bottom border-light navbar-light d-none d-md-block d-lg-block">
	<div class="container">
		<a class="navbar-brand" href="<?= base_url('beranda') ?>">
			<?php echo '<img src="data:image/jpeg;base64,' .base64_encode($mf_beranda->site_logo) . '" alt="BKPPD Kab. Balangan" width="150"/>'; ?>
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
					$skr = date('Y-m-d');
				?>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle px-3 mx-1" href="#" id="navbarDropdown" role="button" style="background-color: <?= $m->color ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<!-- <i class="material-icons mr-2"><?= $m->fid_icon; ?></i>  -->
						<?= $m->nama_menu; ?>
					</a>
					<ul class="dropdown-menu animate slideIn" aria-labelledby="navbarDropdown">
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
					<a class="nav-link px-3 mr-md-1" style="background-color: <?= $m->color ?>" href="<?= base_url($m->link); ?>">
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
										<?php echo '<img class="rounded w-100" src="'.base_url('assets/images/logo-ekinerja.png').'" alt="e-Kinerja"/>' ; ?>
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
										<?php echo '<img class="rounded w-100" src="'.base_url('assets/images/logo-silka.png').'" alt="SILKa Online"/>'; ?>
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
										<?php echo '<img class="rounded w-100" src="'.base_url('assets/images/logo-eprilaku.png').'" alt="e-Prilaku"/>'; ?>
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
			$img = '<img class="rounded mr-1 shadow-sm" width="23" src="data:image/jpeg;base64,'.base64_encode( $getImg ).'" alt="Userportal"/>';
			?>
			<div class="dropdown">
				<button type="button" class="btn btn-outline-light border-0 text-muted my-sm-0 mr-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?= $img ?> <?= ucfirst($this->session->userdata('user_portal_log')['nama_panggilan']) ?>
				<i class="fas fa-angle-down mx-2"></i>
				</button>
				<?php $this->load->view('Frontend/v1/function/f_menus.php'); ?>
			</div>
			<?php } else { ?>
			<a  class="btn shadow-sm btn-dark rounded border-0 py-2 px-4" href="<?= base_url('login_web'); ?>">
				<i class="fas fa-lock mr-2"></i> Login 
			</a>
			<a data-toggle="tooltip" title="Klik untuk mendaftar atau berkontribusi sebagai editor content website" class="btn btn-outline-none border-0 rounded ml-2" href="<?= base_url('daftar'); ?>">
				<i class="fas fa-user"></i>
			</a>
			<?php } ?>
			<span class="text-light ml-2">|</span>
			<button class="btn btn-outline-none rounded-pill bg-white py-2 ml-2" id="caripost">
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
<?php $this->load->view('Frontend/v1/function/navbar-mobile.php'); ?>
<?php $this->load->view('Frontend/v1/function/modal-mobile-menu'); ?>
<?php $this->load->view('Frontend/v1/function/modal-search'); ?>
<?php $this->load->view('msg/modal-auth'); ?>

			
			