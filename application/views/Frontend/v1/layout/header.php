<!-- Navbar For Desktop -->
<nav id="navbar" class="navbar navbar-expand-sm d-none d-md-block py-1">
	<div class="container">
		<a class="navbar-brand d-flex justify-content-start align-items-center text-nowrap" href="<?= base_url('beranda') ?>">
			<?= '<img style="object-fit:contain;" src="' .base_url('assets/images/logo.png') . '" alt="BKPPD Kab. Balangan 2021" width="50" height="45"/>'; ?>
			<div class="d-flex flex-column align-items-start justify-content-center gap-0 space-0">
				<p style="font-size: 14px;margin:0; padding:0; line-height:0;">BKPSDM</p>
				<p style="font-size: 12px;margin:0; padding:0">Kab. Balangan</p>
			</div>
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
							<?php  
							// Menampilan submenu berdasarkan tanggal yang ditentukan
							if (($s->is_pub == 'Y') && (date('Y-m-d H:i:s') >= $s->pub_end)): 
								$display = 'd-block';
							elseif($s->is_pub == 'N'):
								$display = 'd-block';
							else:
								$display = 'd-none';
							endif;
							?>
							<a class="dropdown-item py-md-2 <?= $display ?>" href="<?= base_url($s->link_sub); ?>">
								<?= $s->nama_sub ?>
								<?php
									// Jika tgl created_at sama dengan tanggal sekarang 
									if(($create_submenu === $skr)): 
								?>
								<span class="badge badge-danger animated fadeIn infinite">
									<span class="small">New</span>
								</span>
								<?php endif; ?>
								<?php
									// Jika submenu memiliki child jadikan sebagai maka parent
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
								<?php  
								// Menampilan submenu berdasarkan tanggal yang ditentukan
								if (($key->is_pub == 'Y') && (date('Y-m-d H:i:s') >= $key->pub_end)): 
									$display = 'd-block';
								elseif($key->is_pub == 'N'):
									$display = 'd-block';
								else:
									$display = 'd-none';
								endif;
								?>
								<li>
									<a class="dropdown-item py-md-2 px-2 <?= $display ?>" href="<?= base_url($key->link_sub); ?>"> 
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
										<?php  
										// Menampilan submenu berdasarkan tanggal yang ditentukan
										if (($key_sub->is_pub == 'Y') && (date('Y-m-d H:i:s') >= $key_sub->pub_end)): 
											$display = 'd-block';
										elseif($key_sub->is_pub == 'N'):
											$display = 'd-block';
										else:
											$display = 'd-none';
										endif;
										?>
										<li><a class="dropdown-item py-md-2 px-2 <?= $display ?>" href="<?= base_url($key_sub->link_sub); ?>"> <?= $key_sub->nama_sub ?></a></li>
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
						Produk
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="width: 400px; max-height: 400px; overflow-y: auto;">
						<div class="d-flex flex-lg-column justify-content-start align-items-center ">
							<a rel="noreferrer" target="_blank" href="https://ekinerja.balangankab.go.id/" class="p-4">
							<b class="font-weight-bold text-dark">e-Kinerja</b>
							<p class="text-muted small text-reset">
								Mengukur dan memantau kinerja PNS secara periodic, sebagai salah satu data acuan pemberian tunjangan kinerja yang  diterima pegawai
							</p>
							</a>
							<a  rel="noreferrer" target="_blank" href="http://36.91.72.99/" class="p-4">
										<b class="font-weight-bold text-dark">SILKa Online</b>
										<p class="text-muted small">
											SILKa Online (Sistem Informasi Layanan Kepegawaian) pengelolaan data kepegawaian kabupaten balangan
										</p>
							</a>
							<a rel="noreferrer" target="_blank" href="https://eprilaku.bkppd-balangankab.info/" class="p-4">
										<b class="font-weight-bold text-dark">e-Prilaku (360)</b>
										<p class="text-muted small">
											Aplikasi untuk Menilai dan Mengukur Perilaku yang dinilai oleh Atasan, Teman/Peer dan Bawahan (360 Derajat) dengan menggunakan survei tertutup sehingga lebih objektif.
										</p>
							</a>
							<a rel="noreferrer" target="_blank" href="https://www.bkpsdm-skm.balangankab.go.id/" class="p-4">
										<b class="font-weight-bold text-dark">Indeks Kepuasan Masyarakat (IKM)</b>
										<p class="text-muted small">
											Indeks Kepuasan Masyarakat (IKM) adalah data dan informasi tentang tingkat kepuasan masyarakat yang diperoleh dari hasil pengukuran secara kuantitatif dan kualitatif atas pendapat masyarakat dalam memperoleh pelayanan dari aparatur penyelenggara pelayanan publik dengan membandingkan antara harapan dan kebutuhannya.
										</p>
							</a>
							<a rel="noreferrer" href="<?= base_url('widget-gpr-bkppdblg') ?>" class="p-4">
										<b class="font-weight-bold text-dark">Goverment Public Relation (GPR)</b>
										<p class="text-muted small">
											GPR (Government Public Relation) BKPPD Balangan merupakan alat bantu sosialisasi berita berupa widget yang dapat dipasang pada website/blog. Sumber berita didapatkan dari website resmi <kbd>https://bkpsdm.balangankab.go.id/</kbd>
										</p>
							</a>
							<div class="d-flex flex-column flex-md-row align-item-start justify-content-between">
								<div>
									<div>
										<a target="_blank" href="https://worldquran.com"><span><i class="fas fa-external-link-alt text-light mr-2"></i></span>World Quran</a>
									</div>
									<div>
										<a target="_blank" href="https://www.mediabalangan.com/"><span><i class="fas fa-external-link-alt text-light mr-2"></i></span>Media Balangan</a>
									</div>
								</div>
								<div>
									<div>
										<a target="_blank" href="https://satechainmedia.com/"><span><i class="fas fa-external-link-alt text-light mr-2"></i></span>Blockchain technology</a>
									</div>
									<div>
										<a target="_blank" href="https://sdn-haurgading.xyz"><span><i class="fas fa-external-link-alt text-light mr-2"></i></span>Berita Technology</a>
									</div>
									<div>
										<a target="_blank" href="https://www.soundoftext.co.id"><span><i class="fas fa-external-link-alt text-light mr-2"></i></span>Soundoftext</a>
									</div>
								</div>
								<div>
									<div>
										<a target="_blank" href="https://lokeridn.com"><span><i class="fas fa-external-link-alt text-light mr-2"></i></span>Lowongan Kerja</a>
									</div>
									<div>
										<a target="_blank" href="https://world-giveaways.com"><span><i class="fas fa-external-link-alt text-light mr-2"></i></span>Giveaway Gratis</a>
									</div>
									<div>
										<a target="_blank" href="https://www.ulastempat.com"><span><i class="fas fa-external-link-alt text-light mr-2"></i></span>UlasTempat </a>
									</div>
								</div>
							</div>
						</div>
					</ul>
				</li>
			</ul>
			
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
			<!-- 
			# Menu Register
			<a data-toggle="tooltip" title="Klik untuk mendaftar atau berkontribusi sebagai editor content website" class="btn btn-primary py-2 border-0 rounded mr-2" href="<?= base_url('daftar'); ?>">
				<i class="fas fa-user"></i>
			</a> 
			-->
			<a rel="noindex, nofollow" class="btn shadow-sm btn-primary rounded border-0 py-2 px-4" href="<?= base_url('login_web?urlRef='.curPageURL()); ?>">
				<i class="fas fa-lock ml-2"></i> Masuk 
			</a>
			
			<?php } ?>
			<span class="text-dark ml-2">|</span>
			<button class="btn rounded py-2 ml-2 post-search" data-toggle="tooltip" title="Klik untuk mencari artikel atau berita">
				<i class="fas fa-search"></i>
			</button>
		</div>
	</div>
</nav>
<?php $this->load->view('Frontend/v1/function/navbar-mobile.php'); ?>
<?php $this->load->view('Frontend/v1/function/modal-mobile-menu'); ?>
<?php $this->load->view('Frontend/v1/function/modal-search'); ?>
<?php $this->load->view('msg/modal-auth'); ?>