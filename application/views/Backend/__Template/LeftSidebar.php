<section>
	<!-- Left Sidebar -->
	<aside id="leftsidebar" class="sidebar">
		<!-- User Info -->
		<div class="user-info">
			<div class="image">
				<img src="<?= site_url('assets/images/users/') ?><?= $this->session->userdata('gravatar') ?>" width="50" height="50" alt="User" />
			</div>
			<div class="info-container">
				<div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<?= $this->session->userdata('namalengkap') ?>
				</div>
				<div class="email"><?= $this->session->userdata('emailuser') ?></div>
				<!-- <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);" onclick="menu_link('<?= site_url('backend/admin/profile'); ?>')"><i class="material-icons">person</i>Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="javascript:void(0);" onclick="logout('<?= base_url('login/logout') ?>')"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div> -->
			</div>
		</div>
		<!-- #User Info -->
		<!-- Menu -->
		<div class="menu">
			<ul class="list">
				<?php foreach ($label as $m) { ?>

					<li class="header"><?= strtoupper($m->nama_label) ?></li>


					<?php
					if ($this->madmin->listmenu_jml($m->id_label)->num_rows() > 0) {
						foreach ($this->madmin->menu($m->id_label) as $key) {
					?>
							<?php
							//Untuk Kondisi Menu Aktif Saat Ini
							if ($key->link != '' || $key->link != '#') {
								$linkqu = substr($key->link, '15', '50');
							} else {
								$linkqu = 'javascript:void(0);';
							}
							$pecah_fid_module = explode("|", $key->fid_module);

							$allmodule  = $this->madmin->getallmodule();

							if (count($pecah_fid_module) > 1) {
								$modulebyid = $this->madmin->getmodulebyid($pecah_fid_module[1]);
							} else {
								$modulebyid = $this->madmin->getmodulebyid($key->fid_module);
							}

							if ($_GET['module'] == $modulebyid) {
								$active = 'active';
							} else {
								$active = '';
							}
							// var_dump(count($pecah_fid_module));

							?>

							<li class="<?= $active ?>" style="background-color: <?= $key->color ?>;">
								<?php
								//Untuk Kondisi Ada Submenu / Dropdown Menu
								if ($this->madmin->submenu($key->id_menu)->num_rows() > 0) {
									$toggle = 'menu-toggle';
								} else {
									$toggle = '';
								}
								?>
								<?php
								//Untuk Kondisi Link Menu Ada Submenu Atau Tidak Ada ?
								$access = $this->madmin->getAccess($this->session->userdata('user'));
								if (($key->fid_module != '')) {
									if (($key->link == '#')) {
										$link = 'javascript:void(0);';
									} else {
										$link = site_url($key->link) . "?module=" . $key->token . "&user=" . $access[0]->user_access;
									}

									$linkMenu = $link;
								} else {
									if (($key->link == '#')) {
										$out = 'javascript:void(0);';
									} else {
										$out = site_url('backend/c_admin/module_not_found');
									}
									$linkMenu = $out;
								}
								?>

								<a type="button" href="<?= $linkMenu ?>" class="<?= $toggle ?>">

									<!-- Gunakan untuk warna icon dinamis dan letakan pada class-->
									<!-- col-//$this->ma->aktifskin('t_skin','Y');-->
									<i class="material-icons"><?= $key->fid_icon ?></i>
									<span><?= ucwords($key->nama_menu) ?></span>
								</a>

								<?php
								$primary = $key->id_menu;
								$sub = $this->madmin->submenu($primary)->result();
								?>
								<ul class="ml-menu">
									<?php
									foreach ($sub as $s) {
										$linksub = $s->link_sub;
										$pecah_linksub = explode("/", $linksub);
										$uri_link = (@$pecah_linksub[2] != NULL) ? $pecah_linksub[2]  : $pecah_linksub[1];
										$uri_get  = (@$pecah_linksub[2] != NULL) ? $uri = $this->uri->segment(3)  : $uri = $this->uri->segment(2);
										if ($uri_link == $uri) {
											$ac = 'active';
											$i  = '';
										} else {
											$ac = '';
											$i  = '';
										}
									?>
										<li class="<?= $ac ?>">
											<a type="button" href="<?= site_url($s->link_sub . "?module=" . $s->token . "&user=" . $access[0]->user_access) ?>">
												<?= $i ?> <span class="m-t-1"><?= $s->nama_sub ?> </span>
											</a>
										</li>
									<?php } ?>
								</ul>

							</li>
					<?php
						}
					}
					?>


				<?php } ?>
			</ul>
		</div>
		<!-- #Menu -->
		<!-- Footer -->
		<div class="legal">
			<div class="copyright">
				&copy; 2018 - <?= date('Y') ?> <a href="javascript:void(0);"><?= $title ?></a>.
			</div>
			<div class="version">
				<b>Version: </b> 2.0.0 | Thameby: <a href="file:///D:/BAHAN%20WEB/AdminBSBMaterialDesign-master/index.html" target="_blank" title="Dokumentasi">AdminBSB</a>
			</div>
		</div>
		<!-- #Footer -->
	</aside>
	<!-- #END# Left Sidebar -->

</section>
