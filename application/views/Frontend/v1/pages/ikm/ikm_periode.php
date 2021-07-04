<h5 class="px-3 py-4 border-bottom border-light">
<a href="<?= base_url('frontend/v1/ikm/ikm_add_periode') ?>" title="Buat Halaman Statis" data-toggle="tooltip" class="btn btn-sm btn-primary rounded-circle float-right"><i class="fas fa-plus"></i></a>
IKM - Periode
</h5>
<section class="py-2">
	<div class="container">
		<div class="row">
			<?php
				foreach($ikm_periode as $p):
			?>
			<div class="col-md-4">
				<div class="text-center">
					<i class="fas fa-check-circle fa-4x"></i>
					<p class="my-3">
						<?= mediumdate_indo($p->tgl_mulai) ?> - <?= mediumdate_indo($p->tgl_selesai) ?>
					</p>
					<div class="input-group mb-3">
						<input type="text" class="form-control" placeholder="Target" aria-label="Recipient's username" aria-describedby="basic-addon2" value="<?= $p->target ?>">
						<div class="input-group-append">
							<button class="btn btn-outline-secondary" type="button">Save</button>
						</div>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>