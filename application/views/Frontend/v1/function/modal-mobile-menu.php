<!-- Modal Menus Mobile-->
<div class="modal fade bd-example-modal-lg" id="mobileMenu" tabindex="-1" role="dialog" aria-labelledby="mobileMenuLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content border-0 shadow-none bg-white">
			<div class="modal-body">
				<div class="text-light text-left font-weight-bold">Menu Utama</div>
				<div class="row">
					<div class="col-6">
						<a href="//ekinerja.balangankab.go.id" class="btn btn-outline-light text-dark w-100">
							<i class="fas fa-link"></i> <br>
							E-Kinerja
						</a>
					</div>
					<div class="col-6 mb-2">
						<a href="//silka.balangankab.go.id" class="btn btn-outline-light text-dark w-100">
							<i class="fas fa-link"></i> <br>
							SILKa Online
						</a>
					</div>
					<div class="col-6">
						<a href="//eprilaku.balangankab.go.id" class="btn btn-outline-light text-dark w-100">
							<i class="fas fa-link"></i> <br>
							E-Prilaku
						</a>
					</div>
					<div class="col-6">
						<a href="<?= base_url('widget-gpr-bkppdblg') ?>" class="btn btn-outline-light text-dark w-100">
							<i class="fas fa-link"></i> <br>
							GPR Public
						</a>
					</div>
				</div>
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
					<div id="heading<?= $m->id_menu ?>">
						<a href="<?= base_url($m->link); ?>" data-toggle="collapse" data-target="#collapse-<?= $m->id_menu ?>" aria-expanded="false" aria-controls="collapse-<?= $m->id_menu ?>" class="btn btn-block btn-light border text-left rounded collapsible-link px-2 my-1 py-2"><?= $m->nama_menu; ?> <i class="fas fa-folder float-right text-white"></i></a>
					</div>
					
					<div id="collapse-<?= $m->id_menu ?>" aria-labelledby="heading<?= $m->id_menu ?>" data-parent="#accordionParent" class="collapse">
						<?php foreach ($submenu as $s) : ?>
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
						<?php if($this->mf_beranda->parent_submenu($s->idsub)->num_rows() > 0): ?>
						<div id="accordionSub" class="accordion">
							<div id="heading2">
								<a href="<?= base_url($s->link_sub); ?>" data-toggle="collapse" data-target="#collapse-<?= $s->idsub ?>" aria-expanded="false" aria-controls="collapse-<?= $s->idsub ?>" class="<?= $display ?> bg-secondary rounded text-white collapsible-link px-2 my-1 py-2"><?= $s->nama_sub; ?> <i class="fas fa-folder float-right text-white"></i></a>
							</div>
							<div id="collapse-<?= $s->idsub ?>" aria-labelledby="heading2" data-parent="#accordionSub" class="collapse">
								<?php foreach ($this->mf_beranda->sub_submenu($s->idsub) as $ss):?>
								<?php  
								// Menampilan submenu berdasarkan tanggal yang ditentukan
								if (($ss->is_pub == 'Y') && (date('Y-m-d H:i:s') >= $ss->pub_end)): 
									$display = 'd-block';
								elseif($ss->is_pub == 'N'):
									$display = 'd-block';
								else:
									$display = 'd-none';
								endif;
								?>
								<?php if($this->mf_beranda->parent_submenu($ss->idsub)->num_rows() > 0): ?>
								<div id="accordionSubSub" class="accordion ml-2">
									<a href="<?= base_url($ss->link_sub); ?>" data-toggle="collapse" data-target="#collapse-<?= $ss->idsub ?>" aria-expanded="false" aria-controls="collapseFive" class="<?= $display ?> bg-info rounded text-white collapsible-link px-2 my-1 py-2"><?= $ss->nama_sub; ?> <i class="fas fa-folder float-right text-white"></i></a>
									<div id="collapse-<?= $ss->idsub ?>" aria-labelledby="heading3" data-parent="#accordionSubSub" class="collapse">
										<?php foreach ($this->mf_beranda->sub_submenu($ss->idsub) as $sss):?>
										<?php  
										// Menampilan submenu berdasarkan tanggal yang ditentukan
										if (($sss->is_pub == 'Y') && (date('Y-m-d H:i:s') >= $sss->pub_end)): 
											$display = 'd-block';
										elseif($sss->is_pub == 'N'):
											$display = 'd-block';
										else:
											$display = 'd-none';
										endif;
										?>
										<a href="<?= base_url($sss->link_sub); ?>" class="<?= $display ?> bg-info position-relative rounded text-white px-2 my-1 py-2 ml-2"><?= $sss->nama_sub; ?></a>
										<?php endforeach; ?>
									</div>
								</div>
								<?php else: ?>
								<a href="<?= base_url($ss->link_sub); ?>" class="<?= $display ?> bg-info position-relative rounded text-white px-2 my-1 py-2 ml-2"><?= $ss->nama_sub; ?></a>
								<?php endif; ?>
								<?php endforeach; ?>
							</div>
						</div>
						<?php else: ?>
						<a href="<?= base_url($s->link_sub); ?>" class="<?= $display ?> bg-secondary position-relative rounded text-white px-2 my-1 py-2"><?= $s->nama_sub; ?></a>
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
			<div class="modal-footer">
				<button type="button" class="btn btn-block btn-default" data-dismiss="modal">Sembuyikan</button>
			</div>
		</div>
	</div>
</div>