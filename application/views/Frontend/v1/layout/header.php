<!-- Navbar For Desktop -->
<nav id="navbar" class="navbar fixed-top navbar-expand-sm border-bottom border-light navbar-light d-none d-md-block d-lg-block py-0">
	<div class="container">
		<a class="navbar-brand" href="<?= base_url('beranda') ?>">
			<?php echo '<img style="object-fit:contain;" src="' .img_blob($mf_beranda->site_logo) . '" alt="BKPPD Kab. Balangan 2021" width="150" height="45"/>'; ?>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<button class="btn btn-outline-light rounded-pill bg-white py-2 pr-5 text-muted post-search">
				<i class="fas fa-search mr-3"></i> Cari sesuatu disini
			</button>
			<ul class="navbar-nav ml-auto p-0">
			<li class="nav-item text-muted">
				<a rel="noindex, nofollow" class="rounded mr-4" href="<?= base_url('beranda'); ?>">
					<i class="fas fa-home"></i>
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
			$img = '<img style="object-fit:cover; object-position: top;" class="rounded-circle mr-1 shadow-sm" width="40" height="40" src="'.$photo.'" alt="Userportal - '.$u_name.'"/>';
			?>
			<div class="dropdown">
				<button type="button" class="btn btn-outline-light border-0 text-muted my-sm-0 mr-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?= $img ?> <?= $u_name ?>
				<i class="fas fa-angle-down mx-2"></i>
				</button>
				<?php $this->load->view('Frontend/v1/function/f_menus.php'); ?>
			</div>
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
</nav>
<?php $this->load->view('Frontend/v1/function/navbar-mobile.php'); ?>
<?php $this->load->view('Frontend/v1/function/modal-mobile-menu'); ?>
<?php $this->load->view('Frontend/v1/function/modal-search'); ?>
<?php $this->load->view('msg/modal-auth'); ?>

			
			