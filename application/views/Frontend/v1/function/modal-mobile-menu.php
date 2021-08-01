<!-- Modal Menus Mobile-->
<div class="modal bd-example-modal-lg" id="mobileMenu" tabindex="-1" role="dialog" aria-labelledby="mobileMenuLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content border-0 shadow-none bg-white">
			<div class="modal-body">
				<div class="text-light text-left font-weight-bold">Navigation Menus</div>
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