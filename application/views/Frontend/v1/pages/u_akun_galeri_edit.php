<?php $id = decrypt_url($this->uri->segment(5)) ?>
<section class="hero py-5">
	<div class="container py-5">
		<div class="col-md-8 offset-md-2 py-3 d-flex justify-content-between align-items-center">
			<div>
				<h5><span class="text-primary font-weight-bold"><?= $this->album->detail_photo($id)->judul ?></span></h5>
			</div>
			<div>
				<button onclick="window.history.back(-1)" class="btn btn-sm btn-danger"><i class="fas fa-arrow-left"></i> Kembali</button>
			</div>
		</div>
	</div>
</div>
</section>
<section class="mb-3 mt--8">
<div class="container">
	<div class="col-md-8 offset-md-2 bg-white rounded p-4">
		<?php var_dump($data) ?>
	</div>
</div>
</section>