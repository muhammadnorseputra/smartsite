<h5 class="px-3 py-4 border-bottom border-light">
<a href="<?= base_url('frontend/v1/ikm/ikm_add_periode') ?>" title="Buat Halaman Statis" data-toggle="tooltip" class="btn btn-sm btn-primary rounded-circle float-right"><i class="fas fa-plus"></i></a>
IKM - Periode
</h5>
<section class="py-2">
	<div class="container">
		<div class="panel-group" id="accordion">
			<?php foreach($ikm_tahun as $t): ?>
			<?php  
				$show = $t->tahun === date('Y') ? 'show' : '';
				$bg = $t->tahun === date('Y') ? 'bg-light' : '';
				$expanded = $t->tahun === date('Y') ? "true" : "false";
			?>
			<div class="panel panel-default mb-2">
				<div class="panel-heading mb-2">
					<div data-toggle="collapse" data-target="#collapse-<?= $t->tahun ?>" class="panel-title p-2 <?= $bg ?> text-muted border-0 rounded" aria-expanded="<?= $expanded ?>">
						<b class="d-block">Tahun <?= $t->tahun ?></b>
					</div>
				</div>
				<div id="collapse-<?= $t->tahun ?>" class="panel-collapse collapse <?= $show ?>">
					<div class="panel-body">
						<div class="row mx-1">
							<?php
								foreach($this->ikm->ikm_periode($t->tahun)->result() as $p):
							?>
							<div class="col-md-6 border-light border p-3 rounded gut">
								<div class="text-center">
									<i class="fas fa-poll fa-4x text-success"></i>
									<p class="my-3 font-weight-light text-muted">
										<?= mediumdate_indo($p->tgl_mulai) ?> - <?= mediumdate_indo($p->tgl_selesai) ?>
									</p>
									<button class="btn btn-sm rounded-circle btn-outline-success"><i class="fas fa-pen"></i></button>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>